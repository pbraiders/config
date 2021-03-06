<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Config
 * @link    https://github.com/pbraiders/config for the canonical source repository
 * @license https://github.com/pbraiders/config/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Config;

use Pbraiders\Config\Exception\FileDoNotExistNorReadableException;
use Pbraiders\Config\Reader\ReaderInterface;
use Pbraiders\Config\Processor\ProcessorAwareInterface;
use Pbraiders\Config\Processor\ProcessorTrait;
use function Pbraiders\Stdlib\ksort_recursive;

/**
 * Array config factory.
 *
 * Reads the main mandatory config file and return it as a sorted array.
 * If the optional config file exists, its content replace the main config file content.
 */
class ArrayFactory implements FactoryInterface, ProcessorAwareInterface
{
    use ProcessorTrait;

    /**
     * Reader for the mandatory main config file.
     *
     * @var \Pbraiders\Config\Reader\ReaderInterface
     */
    protected \Pbraiders\Config\Reader\ReaderInterface $pReaderMandatory;

    /**
     * Reader for the optional local config file.
     *
     * @var \Pbraiders\Config\Reader\ReaderInterface
     */
    protected \Pbraiders\Config\Reader\ReaderInterface $pReaderOptional;

    /**
     * Constructor.
     *
     * @param \Pbraiders\Config\Reader\ReaderInterface $readerMain Reader for mandoatory main config file.
     * @param \Pbraiders\Config\Reader\ReaderInterface $readerLocal Reader for optional local config file.
     */
    public function __construct(ReaderInterface $readerMain, ReaderInterface $readerLocal)
    {
        $this->pReaderMandatory = $readerMain;
        $this->pReaderOptional = $readerLocal;
    }

    /**
     * Set the source to read by the mandatory reader.
     *
     * @param string $source Usely, a filename.
     * @return self
     */
    public function setSourceToReaderMain(string $source): self
    {
        $this->pReaderMandatory->setSource($source);
        return $this;
    }

    /**
     * Set the source to read by the optional reader.
     *
     * @param string $source Usely, a filename.
     * @return self
     */
    public function setSourceToReaderLocal(string $source): self
    {
        $this->pReaderOptional->setSource($source);
        return $this;
    }

    /**
     * Build an array from php file.
     *
     * @throws FileDoNotExistNorReadableException If file does not exist.
     * @return array<mixed>
     */
    public function create()
    {
        $aSettings = $this->pReaderMandatory->read();

        $aLocalSettings = $this->pReaderOptional->read();

        // Replace main settings with local settings.
        if (is_countable($aLocalSettings) && count($aLocalSettings) > 0) {
            $aSettings = array_replace_recursive($aSettings, $aLocalSettings);
        }

        // Transforms
        $aSettings = $this->transform($aSettings);

        // Sorts
        ksort_recursive($aSettings);

        return $aSettings;
    }
}
