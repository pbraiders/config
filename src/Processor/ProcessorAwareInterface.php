<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Config\Processor
 * @link    https://github.com/pbraiders/config for the canonical source repository
 * @license https://github.com/pbraiders/config/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Config\Processor;

use Pbraiders\Config\Processor\ProcessorInterface;

/**
 * The Processor interface declares the setProcessor method.
 */
interface ProcessorAwareInterface
{
    /**
     * Set the first processor.
     *
     * @param \Pbraiders\Config\Processor\ProcessorInterface $processor
     * @return mixed
     */
    public function setProcessor(ProcessorInterface $processor);
}
