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
 * Class RequestToken
 * @package Tmdb
 */
class RequestToken
{
    /**
     * The token for obtaining a session
     *
     * @var string|null
     */
    private $token;

    /**
     * Expiry date UTC
     *
     * @var \DateTime
     */
    private $expiresAt;

    /**
     * @var bool
     */
    private $success;

    /**
     * Token bag
     *
     * @param string|null $requestToken
     */
    public function __construct($requestToken = null)
    {
        $this->token = $requestToken;
    }

    /**
     * @return string|null
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string|null $token
     * @return self
     */
    public function setToken(?string $token = null)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getExpiresAt()
    {
        return $this->expiresAt;
    }

    /**
     * @param DateTime|string $expiresAt
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
    public function setSuccess(bool $success)
    {
        $this->success = $success;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->token;
    }
}
