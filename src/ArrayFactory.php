<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Config
 * @link    https://github.com/pbraiders/Config for the canonical source repository
 * @license https://github.com/pbraiders/Config/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Config;

use Pbraiders\Config\Reader\ReaderInterface;
use Pbraiders\Config\Processor\ProcessorInterface;
use function Pbraiders\Stdlib\sortArrayByKey;

/**
 * Array config factory.
 *
 * Reads the main mandatory config file and return it as a sorted array.
 * If the optional config file exists, its content replace the main config file content.
 */
class ArrayFactory implements FactoryInterface
{

    /**
     * Reader for the mandatory main config file.
     *
     * @var \Pbraiders\Config\Reader\ReaderInterface
     */
    protected $pReaderMandatory;

    /**
     * Reader for the optional local config file.
     *
     * @var \Pbraiders\Config\Reader\ReaderInterface
     */
    protected $pReaderOptional;

    /**
     * Chain of processor.
     *
     * @var \Pbraiders\Config\Processor\ProcessorInterface
     */
    protected $pProcessorChain;

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
     * Set the first processor.
     *
     * @param \Pbraiders\Config\Processor\ProcessorInterface $processor
     * @return self
     */
    public function setProcessor(ProcessorInterface $processor): self
    {
        $this->pProcessorChain = $processor;
        return $this;
    }

    /**
     * Build an array from php file.
     *
     * @throws \RuntimeException If file does not exist.
     * @return array
     */
    public function create()
    {
        /** @var array $aSettings Contains main mandotary settings.*/
        $aSettings = $this->pReaderMandatory->read();

        /** @var array $aLocalSettings Contains optional local settings */
        $aLocalSettings = $this->pReaderOptional->read();

        // Replace main settings with local settings.
        if (count($aLocalSettings) > 0) {
            $aSettings = array_replace_recursive($aSettings, $aLocalSettings);
        }

        // Transforms
        if (isset($this->pProcessorChain)) {
            $aSettings = $this->pProcessorChain->process($aSettings);
        }

        // Sorts
        sortArrayByKey($aSettings);

        return $aSettings;
    }
}
