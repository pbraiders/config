<?php

declare(strict_types=1);

namespace PbraidersTest\Config\Processor;

use Pbraiders\Config\Processor\Processor;

/**
 * Undocumented class
 */
class StringProcessor extends Processor
{

    /**
     * @var string Message to print.
     */
    private $sMessage;

    /**
     * Constructor.
     *
     * @param string Message to print.
     */
    public function __construct(string $message)
    {
        $this->sMessage = $message;
    }

    /**
     * Process the config structure and call the next processor.
     *
     * @param string $config. Usely, an array.
     * @return string Returns the modified config.
     */
    public function process($config)
    {
        $config .= $this->sMessage;
        return parent::process($config);
    }
}
