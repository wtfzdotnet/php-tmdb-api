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

namespace Tmdb\Event\Listener\Request;

use Tmdb\Client;
use Tmdb\Event\RequestEvent;

class UserAgentRequestListener
{
    /**
     * @var string|null
     */
    private $userAgent;

    /**
     * UserAgentRequestListener constructor.
     * @param string|null $userAgent
     */
    public function __construct(?string $userAgent = null)
    {
        $this->userAgent = $userAgent ?? sprintf('php-tmdb/api/%s', Client::VERSION);
    }

    /**
     * Add the API token to the headers.
     *
     * @param RequestEvent $event
     */
    public function __invoke(RequestEvent $event): void
    {
        $event->setRequest(
            $event->getRequest()->withHeader('User-Agent', $this->userAgent)
        );
    }
}
