<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Config\Reader
 * @link    https://github.com/pbraiders/config for the canonical source repository
 * @license https://github.com/pbraiders/config/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Config\Reader;

/**
 * Read a file and returns an array.
 * Returns an empty array if the file does not exist or is not readable.
 */
class FileOptional implements ReaderInterface
{
    /**
     * Source to read.
     *
     * @var string sSource.
     */
    protected $sSource = '';

    /**
     * Set the source to read
     *
     * @param string $source Usely, a filename.
     * @return self
     */
    public function setSource(string $source): self
    {
        $this->sSource = trim($source);
        return $this;
    }

    /**
     * Read a file and returns an array.
     * Returns an empty array if the file does not exist or is not readable.
     *
     * @return array
     */
    public function read(): array
    {
        // Init
        $aReturn = [];

        if ((strlen($this->sSource) > 0) && is_file($this->sSource) && is_readable($this->sSource)) {
            $aReturn = require $this->sSource;
        }

        return $aReturn;
    }
}