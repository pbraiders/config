<?php

declare(strict_types=1);

namespace PbraidersTest\Config\Reader;

use PbraidersTest\Utils\ReflectionTrait;
use Pbraiders\Config\Reader\FileOptional;
use Pbraiders\Config\Reader\FileMandatory;

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
        $pProperty = $this->getPrivateProperty('\Pbraiders\Config\Reader\FileMandatory', 'pReader');
        $pActual = $pProperty->getValue($pReaderFileMandatory);
        $this->assertSame($pReaderFileOptional, $pActual);
    }
}
