<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Config\Reader
 * @link    https://github.com/pbraiders/config for the canonical source repository
 * @license https://github.com/pbraiders/config/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Config\Reader;

/**
 * The Decorator class follows the same interface as the other readers.
 * The primary purpose of this class is to define the wrapping interface for all
 * concrete decorators. The default implementation of the wrapping code might
 * include a field for storing a wrapped component and the means to initialize
 * it.
 */
abstract class Decorator implements ReaderInterface
{
    /**
     * @var \Pbraiders\Config\Reader\ReaderInterface
     */
    protected $pReader;

    /**
     * Constructor.
     *
     * @param \Pbraiders\Config\Reader\ReaderInterface $reader
     */
    public function __construct(ReaderInterface $reader)
    {
        $this->pReader = $reader;
    }
}
