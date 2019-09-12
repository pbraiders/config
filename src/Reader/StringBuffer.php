<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Config\Reader
 * @link    https://github.com/pbraiders/config for the canonical source repository
 * @license https://github.com/pbraiders/config/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Config\Reader;

/**
 * Builds an array from a string.
 */
class StringBuffer implements ReaderInterface
{
    /**
     * Source to read.
     *
     * @var string sSource.
     */
    protected $sSource = '';

    /**
     * Set the source to read.
     *
     * @param string $source
     * @return self
     */
    public function setSource(string $source): self
    {
        $this->sSource = trim($source);
        return $this;
    }

    /**
     * Read the buffer and returns an array.
     * Returns an empty array if the buffer do not contains a valid array.
     *
     * @return array
     */
    public function read(): array
    {
        $aReturn = [];

        if (is_array($this->sSource)) {
            $aReturn = $this->sSource;
        }

        return $aReturn;
    }
}
