<?php

declare(strict_types=1);

namespace PbraidersTest\Config;

use Pbraiders\Config\Reader\JsonBuffer;
use Pbraiders\Config\ArrayFactory;

class ArrayFactoryTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Pbraiders\Config\ArrayFactory
     * @group specification
     */
    public function testCreate()
    {
        $aMain = [
            'main' => [
                'French' => [
                    'num' => 'Une',
                    'day' => 'Lundi'
                ],
                'English' => [
                    'day' => 'Sunday',
                    'num' => 'One'
                ]
            ]
        ];

        $aLocal = [
            'main' => [
                'French' => [
                    'num' => 'Un'
                ]
            ]
        ];

        $aExpected = [
            'main' => [
                'English' => [
                    'day' => 'Sunday',
                    'num' => 'One'
                ],
                'French' => [
                    'day' => 'Lundi',
                    'num' => 'Un'
                ]
            ],
            'processor' => 'ok'
        ];

        $pProcessor = new ArrayProcessor();
        $pReaderMandatory = new JsonBuffer();
        $pReaderOptional = new JsonBuffer();
        $pFactory = new ArrayFactory($pReaderMandatory, $pReaderOptional);
        $pFactory
            ->setSourceToReaderMain(json_encode($aMain))
            ->setSourceToReaderLocal(json_encode($aLocal))
            ->setProcessor($pProcessor);
        $aActual = $pFactory->create();
        $this->assertSame($aExpected, $aActual);
    }
}
