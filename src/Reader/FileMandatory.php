<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Config\Reader
 * @link    https://github.com/pbraiders/config for the canonical source repository
 * @license https://github.com/pbraiders/config/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Config\Reader;

use Pbraiders\Config\Exception\FileDoNotExistNorReadableException;

/**
 * Read a file and returns an array.
 * Returns an exception if the file does not exist or is not readable.
 */
class FileMandatory extends Decorator
{
    /**
     * Source to read.
     *
     * @var string sSource.
     */
    protected string $sSource = '';

    /**
     * Set the source to read
     *
     * @param string $source Usely, a filename.
     * @return void
     */
    public function setSource(string $source): void
    {
        $this->sSource = trim($source);
    }

    /**
     * Read a file and returns an array.
     *
     * @throws FileDoNotExistNorReadableException if the file does not exist or is not readable.
     * @return array<mixed>
     */
    public function read(): array
    {
        // Init
        $aReturn = [];

        // File must exists
        if ((strlen($this->sSource) === 0) || ! is_file($this->sSource) || ! is_readable($this->sSource)) {
            throw new FileDoNotExistNorReadableException(sprintf(
                "File '%s' doesn't exist or not readable",
                $this->sSource
            ));
        }

        // Reads
        $this->pReader->setSource($this->sSource);
        $aReturn = $this->pReader->read();

        return $aReturn;
    }
}
