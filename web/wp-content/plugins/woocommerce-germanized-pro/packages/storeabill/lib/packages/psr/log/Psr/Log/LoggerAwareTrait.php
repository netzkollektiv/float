<?php
/**
 * @license MIT
 *
 * Modified by storeabill on 31-March-2023 using Strauss.
 * @see https://github.com/BrianHenryIE/strauss
 */

namespace Vendidero\StoreaBill\Vendor\Psr\Log;

/**
 * Basic Implementation of LoggerAwareInterface.
 */
trait LoggerAwareTrait
{
    /**
     * The logger instance.
     *
     * @var LoggerInterface|null
     */
    protected $logger;

    /**
     * Sets a logger.
     *
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}
