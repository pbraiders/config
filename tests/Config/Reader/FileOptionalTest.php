<?php

declare(strict_types=1);

namespace PbraidersTest\Config\Reader;

use Pbraiders\Config\Reader\FileOptional;

class FileOptionalTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Pbraiders\Config\Reader\FileOptional
     * @group specification
     */
    public function testRead()
    {
        $pReader = new FileOptional();
        $pReader->setSource(__DIR__ . \DIRECTORY_SEPARATOR . 'goodfile.php');
        $aActual = $pReader->read();
        $this->assertTrue(is_array($aActual));
        $this->assertFalse(empty($aActual));
    }

    /**
     * @covers \Pbraiders\Config\Reader\FileOptional
     * @group specification
     */
    public function testReadDoesNotExists()
    {
        $pReader = new FileOptional();
        $pReader->setSource('doesnotexists');
        $aActual = $pReader->read();
        $this->assertTrue(is_array($aActual));
        $this->assertTrue(empty($aActual));
    }

    /**
     * @covers \Pbraiders\Config\Reader\FileOptional
     * @group specification
     */
    public function testReadNotAnArray()
    {
        $pReader = new FileOptional();
        $pReader->setSource(__DIR__ . \DIRECTORY_SEPARATOR . 'badfile.php');
        $aActual = $pReader->read();
        $this->assertTrue(is_array($aActual));
        $this->assertTrue(empty($aActual));
    }
}
