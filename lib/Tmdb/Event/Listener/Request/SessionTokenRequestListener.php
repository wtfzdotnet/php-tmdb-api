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

use Tmdb\Event\RequestEvent;
use Tmdb\Token\Session\GuestSessionToken;
use Tmdb\Helper\RequestQueryHelper;
use Tmdb\Token\Session\SessionBearerToken;
use Tmdb\Token\Session\SessionToken;

class SessionTokenRequestListener
{
    /**
     * @var SessionToken
     */
    private $token;

    /**
     * @var RequestQueryHelper
     */
    private $requestQueryHelper;

    /**
     * SessionTokenRequestListener constructor.
     * @param SessionToken $token
     */
    public function __construct(SessionToken $token)
    {
        $this->token = $token;
        $this->requestQueryHelper = new RequestQueryHelper();
    }

    /**
     * Set the token filter.
     *
     * @param RequestEvent $event
     */
    public function __invoke(RequestEvent $event): void
    {
        if ($this->token instanceof SessionBearerToken) {
            $event->setRequest(
                $event->getRequest()->withHeader('Authorization', sprintf('Bearer %s', (string)$this->token))
            );

            return;
        } elseif ($this->token instanceof GuestSessionToken) {
            $key = 'guest_session_id';
        } else {
            $key = 'session_id';
        }

        $event->setRequest(
            $this->requestQueryHelper->withQuery($event->getRequest(), $key, (string)$this->token)
        );
    }
}
