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

namespace Tmdb\Event\Listener\Logger;

use Psr\Log\LoggerInterface;
use Tmdb\Event\TmdbExceptionEvent;
use Tmdb\Formatter\TmdbApiException\SimpleTmdbApiExceptionFormatter;
use Tmdb\Formatter\TmdbApiExceptionFormatterInterface;

/**
 * Class LogApiErrorListener
 * @package Tmdb\Event
 */
class LogApiErrorListener
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var TmdbApiExceptionFormatterInterface
     */
    private $formatter;

    /**
     * LogApiErrorListener constructor.
     * @param LoggerInterface $logger
     * @param TmdbApiExceptionFormatterInterface|null $formatter
     */
    public function __construct(LoggerInterface $logger, ?TmdbApiExceptionFormatterInterface $formatter = null)
    {
        $this->logger = $logger;
        $this->formatter = $formatter ?: new SimpleTmdbApiExceptionFormatter();
    }

    /**
     * @param TmdbExceptionEvent $event
     * @return void
     */
    public function __invoke(TmdbExceptionEvent $event): void
    {
        $this->logger->critical(
            sprintf(
                'Critical API exception:' . PHP_EOL . '%s',
                $this->formatter->formatApiException($event->getException())
            )
        );
    }
}
