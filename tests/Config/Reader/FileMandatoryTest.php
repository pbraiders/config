<?php

declare(strict_types=1);

namespace PbraidersTest\Config\Reader;

use Pbraiders\Config\Reader\FileMandatory;
use Pbraiders\Config\Reader\FileOptional;

class FileMandatoryTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Pbraiders\Config\Reader\FileMandatory
     * @group specification
     */
    public function testRead()
    {
        $pReader = new FileMandatory(new FileOptional());
        $pReader->setSource(__DIR__ . \DIRECTORY_SEPARATOR . 'goodfile.php');
        $aActual = $pReader->read();
        $this->assertTrue(is_array($aActual));
        $this->assertFalse(empty($aActual));
    }

    /**
     * @covers \Pbraiders\Config\Reader\FileMandatory
     * @group specification
     */
    public function testReadDoesNotExists()
    {
        $pReader = new FileMandatory(new FileOptional());
        $pReader->setSource('doesnotexists');
        $this->expectException(\RuntimeException::class);
        $pReader->read();
    }

    /**
     * @covers \Pbraiders\Config\Reader\FileMandatory
     * @group specification
     */
    public function testReadNotAnArray()
    {
        $pReader = new FileMandatory(new FileOptional());
        $pReader->setSource(__DIR__ . \DIRECTORY_SEPARATOR . 'badfile.php');
        $aActual = $pReader->read();
        $this->assertTrue(is_array($aActual));
        $this->assertTrue(empty($aActual));
    }
}
