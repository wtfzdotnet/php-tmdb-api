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
use Symfony\Contracts\EventDispatcher\Event;
use Tmdb\Model\AbstractModel;

class HydrationEvent extends Event
{
    /**
     * @var AbstractModel
     */
    private $subject;

    /**
     * @var array
     */
    private $data;

    /**
     * @var RequestInterface|null
     */
    private $lastRequest;

    /**
     * @var ResponseInterface|null
     */
    private $lastResponse;

    /**
     * Constructor
     *
     * @param AbstractModel $subject
     * @param array $data
     */
    public function __construct(AbstractModel $subject, array $data = [])
    {
        $this->subject = $subject;
        $this->data = $data;
    }

    /**
     * @return AbstractModel
     */
    public function getSubject(): AbstractModel
    {
        return $this->subject;
    }

    /**
     * @param AbstractModel $subject
     * @return self
     */
    public function setSubject(AbstractModel $subject): HydrationEvent
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     * @return self
     */
    public function setData(array $data = []): HydrationEvent
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasData(): bool
    {
        return !empty($this->data);
    }

    /**
     * @return RequestInterface|null
     */
    public function getLastRequest(): ?RequestInterface
    {
        return $this->lastRequest;
    }

    /**
     * @param RequestInterface|null $lastRequest
     * @return self
     */
    public function setLastRequest(?RequestInterface $lastRequest = null): HydrationEvent
    {
        $this->lastRequest = $lastRequest;

        return $this;
    }

    /**
     * @return ResponseInterface|null
     */
    public function getLastResponse(): ?ResponseInterface
    {
        return $this->lastResponse;
    }

    /**
     * @param ResponseInterface|null $lastResponse
     * @return self
     */
    public function setLastResponse(?ResponseInterface $lastResponse = null): HydrationEvent
    {
        $this->lastResponse = $lastResponse;

        return $this;
    }
}
