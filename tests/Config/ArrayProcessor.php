<?php

declare(strict_types=1);

namespace PbraidersTest\Config;

use Pbraiders\Config\Processor\Processor;

/**
 * Undocumented class
 */
class ArrayProcessor extends Processor
{
    /**
     * Process the config structure and call the next processor.
     *
     * @param array $config.
     * @return array Returns the modified config.
     */
    public function process($config)
    {
        $config['processor'] = 'ok';
        return parent::process($config);
    }
}
