<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Config\Processor
 * @link    https://github.com/pbraiders/config for the canonical source repository
 * @license https://github.com/pbraiders/config/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Config\Processor;

/**
 * The default chaining behavior is implemented inside this base processor class.
 */
abstract class Processor implements ProcessorInterface
{
    /**
     * @var \Pbraiders\Config\Processor\ProcessorInterface The next processor.
     */
    private $pNextProcessor;

    /**
     * Chain the next processor.
     *
     * @param \Pbraiders\Config\Processor\ProcessorInterface $processor
     * @return \Pbraiders\Config\Processor\ProcessorInterface
     */
    public function setNext(ProcessorInterface $processor): ProcessorInterface
    {
        $this->pNextProcessor = $processor;
        // Returning a processor from here will let us link processors in a
        // convenient way like this:
        // $one->setNext($two)->setNext($three);
        return $processor;
    }

    /**
     * Process the config structure and call the next processor.
     *
     * @param mixed $config. Usely, an array.
     * @return mixed Returns the modified config.
     */
    public function process($config)
    {
        if (isset($this->pNextProcessor)) {
            return $this->pNextProcessor->process($config);
        }
        return $config;
    }
}
