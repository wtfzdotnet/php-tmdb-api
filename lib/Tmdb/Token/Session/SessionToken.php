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

namespace Tmdb\Token\Session;

use DateTime;

/**
 * Class SessionToken
 * @package Tmdb
 */
class SessionToken
{
    /**
     * @var string|null
     */
    private $sessionToken;

    /**
     * @var ?DateTime
     */
    private $expiresAt;

    /**
     * @var boolean
     */
    private $success;

    /**
     * Token bag
     *
     * @param string|null $sessionToken
     */
    public function __construct(?string $sessionToken = null)
    {
        $this->sessionToken = $sessionToken;
    }

    /**
     * @param null $sessionToken
     * @return self
     */
    public function setToken($sessionToken)
    {
        $this->sessionToken = $sessionToken;

        return $this;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->sessionToken;
    }

    /**
     * @return ?DateTime
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * @param string|DateTime $expiresAt
     * @return self
     */
    public function setExpiresAt($expiresAt)
    {
        if (!$expiresAt instanceof DateTime) {
            $expiresAt = new DateTime($expiresAt);
        }

        $this->expiresAt = $expiresAt;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getSuccess()
    {
        return $this->success;
    }

    /**
     * @param boolean $success
     * @return self
     */
    public function setSuccess($success)
    {
        $this->success = $success;

        return $this;
    }

    public function __toString()
    {
        return (string)$this->sessionToken;
    }
}
