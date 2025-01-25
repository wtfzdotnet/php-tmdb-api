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
use Tmdb\Event\BeforeHydrationEvent;
use Tmdb\Formatter\HttpMessageFormatterInterface;
use Tmdb\Formatter\Hydration\SimpleHydrationFormatter;
use Tmdb\Formatter\HydrationFormatterInterface;

/**
 * Class LogHydrationListener
 * @package Tmdb\Event
 */
class LogHydrationListener
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var HydrationFormatterInterface
     */
    private $formatter;

    /**
     * @var bool
     */
    private $withData;

    /**
     * RequestListener constructor.
     * @param LoggerInterface $logger
     * @param HydrationFormatterInterface|null $formatter
     * @param bool $withData If true the context will contain the data used.
     */
    public function __construct(
        LoggerInterface $logger,
        ?HydrationFormatterInterface $formatter = null,
        bool $withData = false
    ) {
        $this->logger = $logger;
        $this->formatter = $formatter ?: new SimpleHydrationFormatter();
        $this->withData = $withData;
    }

    /**
     * @param BeforeHydrationEvent $event
     * @return void
     */
    public function __invoke(BeforeHydrationEvent $event): void
    {
        $context = [];

        if ($this->withData) {
            $context['data'] = $event->getData();
            $context['data_size'] = \mb_strlen(\GuzzleHttp\Utils::jsonEncode($event->getData()), 'UTF-8');
        }

        $this->logger->debug(
            $this->formatter->formatBeforeEvent($event),
            $context
        );
    }
}
