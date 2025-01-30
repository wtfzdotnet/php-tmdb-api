<?php

/**
 * This file is part of the Tmdb PHP API created by Michael Roterman.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package Tmdb
 * @author Michael Roterman <michael@wtfz.net>
 * @copyright (c) 2013, Michael Roterman
 * @version 4.0.0
 */

namespace Tmdb\HttpClient;

use InvalidArgumentException;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use RuntimeException;
use Tmdb\Event\Listener\RequestListener;
use Tmdb\Event\RequestEvent;
use Tmdb\Token\Session\GuestSessionToken;
use Tmdb\Token\Session\SessionToken;

/**
 * Class HttpClient
 * @package Tmdb\HttpClient
 */
class HttpClient
{
    /**
     * @var array
     */
    protected $options;

    /**
     * @var ResponseInterface
     */
    private $lastResponse;

    /**
     * @var RequestInterface
     */
    private $lastRequest;

    /**
     * @var null|SessionToken|GuestSessionToken
     */
    private $sessionToken;

    /**
     * Constructor
     *
     * @param array $options
     */
    public function __construct(
        array $options = []
    ) {
        $this->options = $options;
    }

    /**
     * Create the request object and send it out to listening events.
     *
     * @param $path
     * @param $method
     * @param array $parameters
     * @param array $headers
     * @param null $body
     *
     * @return ResponseInterface
     */
    public function send(string $path, string $method, array $parameters = [], array $headers = [], $body = null)
    {
        $request = $this->createRequest(
            $path,
            $method,
            $parameters,
            $headers,
            $body
        );

        $event = new RequestEvent($request, $this->sessionToken ?? null);
        $this->getPsr14EventDispatcher()->dispatch($event);

        $this->lastResponse = $event->getResponse();

        if ($this->lastResponse instanceof ResponseInterface) {
            return $this->lastResponse;
        }

        throw new RuntimeException(
            sprintf(
                'Expected an instance of a "%s", have you configured the event dispatcher for listener "%s" correctly for handling the "%s" event?',
                ResponseInterface::class,
                RequestListener::class,
                RequestEvent::class
            )
        );
    }

    /**
     * Create the PSR-7 request object by making use of the PSR-17 factories.
     *
     * @param string $path
     * @param string $method
     * @param array $parameters
     * @param array $headers
     * @param string|null $body
     * @return RequestInterface
     */
    private function createRequest(
        string $path,
        string $method,
        array $parameters = [],
        array $headers = [],
        $body = null
    ) {
        if (!empty($parameters)) {
            ksort($parameters);
        }

        $uri = empty($parameters) ?
            sprintf('%s/%s', $this->options['base_uri'], $path) :
            sprintf('%s/%s?%s', $this->options['base_uri'], $path, http_build_query($parameters));

        $request = $this->getPsr17RequestFactory()->createRequest(
            $method,
            $this->getPsr17UriFactory()->createUri($uri)
        );

        if (!empty($headers)) {
            ksort($headers);
        }

        foreach ($headers as $key => $value) {
            $request = $request->withHeader($key, $value);
        }

        if ($body) {
            if (in_array($method, $this->getHttpMethodsWithoutBody())) {
                throw new InvalidArgumentException(
                    sprintf(
                        'Trying to create a request with body with invalid method "%s", it should not contain a body.',
                        $method
                    )
                );
            }

            $stream = $this->getPsr17StreamFactory()->createStream($body);
            $request = $request->withBody($stream);
        }

        return $this->lastRequest = $request;
    }

    /**
     * @return RequestFactoryInterface
     */
    public function getPsr17RequestFactory(): RequestFactoryInterface
    {
        return $this->options['http']['request_factory'];
    }

    /**
     * @return UriFactoryInterface
     */
    public function getPsr17UriFactory(): UriFactoryInterface
    {
        return $this->options['http']['uri_factory'];
    }

    /**
     * @return StreamFactoryInterface
     */
    public function getPsr17StreamFactory(): StreamFactoryInterface
    {
        return $this->options['http']['stream_factory'];
    }

    /**
     * @return EventDispatcherInterface
     */
    public function getPsr14EventDispatcher(): EventDispatcherInterface
    {
        return $this->options['event_dispatcher']['adapter'];
    }

    /**
     * @param string|null $key
     * @return array|mixed
     */
    public function getOptions(?string $key = null)
    {
        if ($key) {
            return isset($this->options[$key]) ? $this->options[$key] : null;
        }

        return $this->options;
    }

    /**
     * @param array $options
     * @return self
     */
    public function setOptions(array $options): HttpClient
    {
        $this->options = $options;

        return $this;
    }

    /**
     * @return EventDispatcherInterface
     */
    public function getEventDispatcher(): EventDispatcherInterface
    {
        return $this->getPsr14EventDispatcher();
    }

    /**
     * @return RequestInterface|null
     */
    public function getLastRequest(): ?RequestInterface
    {
        return $this->lastRequest;
    }

    /**
     * @return ResponseInterface|null
     */
    public function getLastResponse(): ?ResponseInterface
    {
        return $this->lastResponse;
    }

    /**
     * @return ClientInterface
     */
    public function getPsr18Client(): ClientInterface
    {
        return $this->options['http']['client'];
    }

    /**
     * @return ResponseFactoryInterface
     */
    public function getPsr17ResponseFactory(): ResponseFactoryInterface
    {
        return $this->options['http']['response_factory'];
    }

    /**
     * @return string[]
     */
    private function getHttpMethodsWithoutBody(): array
    {
        return [
            'GET',
            'DELETE',
            'TRACE',
            'OPTIONS',
            'HEAD'
        ];
    }
}
