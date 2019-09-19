<?php

declare(strict_types=1);

namespace PbraidersTest\Config\Reader;

use Pbraiders\Config\Reader\FileOptional;
use Pbraiders\Config\Reader\FileMandatory;
use Pbraiders\Stdlib\ReflectionTrait;

class DecoratorTest extends \PHPUnit\Framework\TestCase
{

    use ReflectionTrait;

    /**
     * @covers \Pbraiders\Config\Reader\Decorator
     * @group specification
     */
    public function testDecorator()
    {
        $pReaderFileOptional = new FileOptional();
        $pReaderFileMandatory = new FileMandatory($pReaderFileOptional);
        $pProperty = $this->getProperty('\Pbraiders\Config\Reader\FileMandatory', 'pReader');
        $pActual = $pProperty->getValue($pReaderFileMandatory);
        $this->assertSame($pReaderFileOptional, $pActual);
    }
}
