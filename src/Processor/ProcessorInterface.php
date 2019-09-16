<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Config\Processor
 * @link    https://github.com/pbraiders/config for the canonical source repository
 * @license https://github.com/pbraiders/config/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Config\Processor;

/**
 * The Processor interface declares a method for building the chain of handlers.
 * It also declares a method for executing a request.
 */
interface ProcessorInterface
{
    /**
     * Undocumented function
     *
     * @param \Pbraiders\Config\Processor\ProcessorInterface $processor
     * @return \Pbraiders\Config\Processor\ProcessorInterface
     */
    public function setNext(ProcessorInterface $processor): ProcessorInterface;

    /**
     * Process the config structure and call the next processor.
     *
     * @param mixed $config. Usely an array
     * @return mixed Returns the modified config.
     */
    public function process($config);
}
