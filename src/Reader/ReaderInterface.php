<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Config\Reader
 * @link    https://github.com/pbraiders/config for the canonical source repository
 * @license https://github.com/pbraiders/config/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Config\Reader;

/**
 * Config reader interface.
 */
interface ReaderInterface
{
    /**
     * Set the source to read
     *
     * @param string $source Usely, a filename.
     * @return void
     */
    public function setSource(string $source): void;

    /**
     * Read from a source and create an array.
     *
     * @return array<mixed>
     */
    public function read(): array;
}
