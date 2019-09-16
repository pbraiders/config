<?php

declare(strict_types=1);

namespace PbraidersTest\Config\Processor;

class ProcessorTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Pbraiders\Config\Processor\Processor
     * @group specification
     */
    public function testProcess()
    {
        $pProcessorOne = new StringProcessor('ProcessorOne');
        $pProcessorTwo = new StringProcessor('ProcessorTwo');
        $pProcessorOne->setNext($pProcessorTwo);
        $sActual = $pProcessorOne->process('Start');
        $this->assertEquals('StartProcessorOneProcessorTwo', $sActual);
    }
}
