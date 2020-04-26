<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Config\Reader
 * @link    https://github.com/pbraiders/config for the canonical source repository
 * @license https://github.com/pbraiders/config/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Config\Reader;

/**
 * Builds an array from a json encoded string.
 */
class JsonBuffer implements ReaderInterface
{
    /**
     * JSON encoded string.
     *
     * @var string sSource.
     */
    protected string $sSource = '';

    /**
     * Set the source to read.
     *
     * @param string $source
     * @return void
     */
    public function setSource(string $source): void
    {
        $this->sSource = trim($source);
    }

    /**
     * Read the buffer and returns an array.
     * Returns an empty array if the buffer do not contains a valid array.
     *
     * @throws \JsonException If an error occures while decoding the json.
     * @return array<mixed>
     */
    public function read(): array
    {
        if (strlen($this->sSource) > 0) {
            $aReturn = json_decode($this->sSource, true, 512, \JSON_THROW_ON_ERROR);
        } else {
            $aReturn = [];
        }

        return is_array($aReturn) ? $aReturn : [];
    }
}
