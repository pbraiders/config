<?php

declare(strict_types=1);

namespace PbraidersTest\Config\Reader;

use Pbraiders\Config\Reader\JsonBuffer;

class JsonBufferTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Pbraiders\Config\Reader\JsonBuffer
     * @group specification
     */
    public function testRead()
    {
        $aExpected = [
            1 => [
                'English' => [
                    'One',
                    'January'
                ],
                'French' => [
                    'Une',
                    'Janvier'
                ]
            ]
        ];
        $sJson = json_encode($aExpected);
        $pReader = new JsonBuffer();
        $pReader->setSource($sJson);
        $aActual = $pReader->read();
        $this->assertEquals($aExpected, $aActual);
    }

    /**
     * @covers \Pbraiders\Config\Reader\JsonBuffer
     * @group specification
     */
    public function testReadError()
    {
        $pReader = new JsonBuffer();
        $pReader->setSource("{ 'bar': 'baz' }");
        $aActual = $pReader->read();
        $this->assertEquals([], $aActual);
    }
}
