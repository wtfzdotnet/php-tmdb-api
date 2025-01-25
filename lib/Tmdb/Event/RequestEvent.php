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

namespace Tmdb\Event;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Tmdb\Token\Session\SessionToken;

/**
 * Class RequestEvent
 * @package Tmdb\Event
 */
class RequestEvent extends StoppableEvent implements LoggableHttpEventInterface
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var ?ResponseInterface
     */
    private $response;

    /**
     * @var ?SessionToken
     */
    private $sessionToken;

    /**
     * Construct the request event
     *
     * @param RequestInterface $request
     * @param SessionToken|null $sessionToken
     */
    public function __construct(RequestInterface $request, ?SessionToken $sessionToken = null)
    {
        $this->request = $request;
        $this->sessionToken = $sessionToken;
    }

    /**
     * @return RequestInterface
     */
    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    /**
     * @param RequestInterface $request
     * @return self
     */
    public function setRequest(RequestInterface $request): RequestEvent
    {
        $this->request = $request;

        return $this;
    }

    /**
     * @return ?ResponseInterface
     */
    public function getResponse(): ?ResponseInterface
    {
        return $this->response;
    }

    /**
     * @param ResponseInterface $response
     * @return self
     */
    public function setResponse(ResponseInterface $response): RequestEvent
    {
        $this->response = $response;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasResponse()
    {
        return $this->response instanceof ResponseInterface;
    }

    /**
     * @return ?SessionToken
     */
    public function getSessionToken(): ?SessionToken
    {
        return $this->sessionToken;
    }

    /**
     * @param SessionToken|null $sessionToken
     * @return self
     */
    public function setSessionToken(?SessionToken $sessionToken = null): RequestEvent
    {
        $this->sessionToken = $sessionToken;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasSessionToken(): bool
    {
        return $this->sessionToken instanceof SessionToken;
    }
}
