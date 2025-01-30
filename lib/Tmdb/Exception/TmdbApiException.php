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

namespace Tmdb\Exception;

use Exception;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class TmdbApiException
 * @package Tmdb\Exception
 */
class TmdbApiException extends Exception
{
    public const STATUS_SUCCESS = 1;
    public const STATUS_INVALID_SERVICE = 2;
    public const STATUS_AUTHENTICATION_FAILED_NO_PERMISSION = 3;
    public const STATUS_INVALID_FORMAT = 4;
    public const STATUS_INVALID_PARAMETERS = 5;
    public const STATUS_INVALID_ID = 6;
    public const STATUS_INVALID_API_KEY = 7;
    public const STATUS_DUPLICATE_ENTRY = 8;
    public const STATUS_SERVICE_OFFLINE = 9;
    public const STATUS_SUSPENDED_API_KEY = 10;
    public const STATUS_INTERNAL_ERROR = 11;
    public const STATUS_UPDATE_SUCCESS = 12;
    public const STATUS_DELETE_SUCCESS = 13;
    public const STATUS_AUTHENTICATION_FAILED = 14;
    public const STATUS_FAILED = 15;
    public const STATUS_DEVICE_DENIED = 16;
    public const STATUS_SESSION_DENIED = 17;
    public const STATUS_VALIDATION_FAILED = 18;
    public const STATUS_INVALID_ACCEPT_HEADER = 19;
    public const STATUS_INVALID_DATE_RANGE = 20;
    public const STATUS_ENTRY_NOT_FOUND = 21;
    public const STATUS_INVALID_PAGE = 22;
    public const STATUS_INVALID_DATE = 23;
    public const STATUS_BACKEND_TIMEOUT = 24;
    public const STATUS_REQUEST_COUNT = 25;
    public const STATUS_USERNAME_PASSWORD_NOT_PROVIDED = 26;
    public const STATUS_TOO_MANY_APPEND_TO_RESPONSE = 27;
    public const STATUS_INVALID_TIMEZONE = 28;
    public const STATUS_CONFIRM_REQUIRED = 29;
    public const STATUS_INVALID_USERNAME_PASSWORD = 30;
    public const STATUS_ACCOUNT_DISABLED = 31;
    public const STATUS_EMAIL_NOT_VERIFIED = 32;
    public const STATUS_INVALID_REQUEST_TOKEN = 33;
    public const STATUS_RESOURCE_NOT_FOUND = 34;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * Create the exception
     *
     * @param int $code
     * @param string $message
     * @param RequestInterface|null $request
     * @param ResponseInterface|null $response
     * @param Exception|null $previous
     */
    public function __construct(
        int $code,
        string $message,
        ?RequestInterface $request = null,
        ?ResponseInterface $response = null,
        ?Exception $previous = null
    ) {
        parent::__construct($message, $code, $previous);

        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @return RequestInterface
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param RequestInterface $request
     * @return self
     */
    public function setRequest(RequestInterface $request): TmdbApiException
    {
        $this->request = $request;

        return $this;
    }

    /**
     * @return ResponseInterface
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param ResponseInterface $response
     * @return self
     */
    public function setResponse(ResponseInterface $response): TmdbApiException
    {
        $this->response = $response;

        return $this;
    }
}
