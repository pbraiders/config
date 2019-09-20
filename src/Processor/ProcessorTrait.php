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
 * Processor trait.
 *
 * Add processor stuff to your class.
 */
trait ProcessorTrait
{

    /**
     * Chain of processor.
     *
     * @var \Pbraiders\Config\Processor\ProcessorInterface
     */
    protected $pProcessorChain;

    /**
     * Set the first processor.
     *
     * @param \Pbraiders\Config\Processor\ProcessorInterface $processor
     * @return mixed
     */
    public function setProcessor(ProcessorInterface $processor)
    {
        $this->pProcessorChain = $processor;
        return $this;
    }

    /**
     * Transforms the settings using the processor chain.
     *
     * @param mixed $config The settings to transform.
     * @return mixed
     */
    protected function transform($config)
    {
        if (isset($this->pProcessorChain)) {
            $config = $this->pProcessorChain->process($config);
        }
        return $config;
    }
}
