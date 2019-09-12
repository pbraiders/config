<?php

declare(strict_types=1);

/**
 * Config factory.
 *
 * Reads the main config file and return it as a sorted array.
 * If the local.config.php file exists, its content replace the main config file content.
 *
 * @package Pbraiders\Service\Config
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Config;

use Pbraiders\Service\Exception;
use Pbraiders\Service\Utils\Stdlib\sortArrayByKey;
use League\Uri\Parser;

/**
 * Creates a config array from files.
 */
class ArrayFactory implements FactoryInterface
{

    /**
     * Reader for the local config file.
     *
     * @var \Pbraiders\Config\ReaderInterface
     */
    protected $pLocalFileReader = null;

    /**
     * Reader for the main config file.
     *
     * @var \Pbraiders\Config\ReaderInterface
     */
    protected $pMainFileReader = null;

    /**
     * Constructor.
     *
     * @param \Pbraiders\Config\Reader\ReaderInterface $sMainReader Reader for main config file.
     * @param \Pbraiders\Config\Reader\ReaderInterface $sLocalReader Reader for local config file.
     */
    public function __construct(ReaderInterface $sMainReader, ReaderInterface $sLocalReader)
    {
        $this->pMainFileReader = $sMainReader;
        $this->pLocalFileReader = $sLocalReader;
    }



    /** @var string Main config filename. */
    const DEFAULT_FILENAME_MAIN = \PBR_PATH . \DIRECTORY_SEPARATOR . 'config' . \DIRECTORY_SEPARATOR . 'config.php';

    /** @var string Local config filename. */
    const DEFAULT_FILENAME_LOCAL = \PBR_PATH . \DIRECTORY_SEPARATOR . 'config'
        . \DIRECTORY_SEPARATOR . 'local.config.php';

    /**
     * Build an array from php file.
     *
     * @param array $files A key paired array. Must contains ['main' => 'main config filename',
     *                                           'local' => 'local config filename'
     * @throws Exception\InvalidArgumentException If settings are not valid.
     * @throws Exception\RuntimeException If file does not exist.
     * @throws \Exception if the URI contains invalid characters.
     * @return array
     */
    public function create()
    {
        /** @var array $aSettings Contains main settings. */
        $aSettings = $this->pMainFileReader->read();

        /** @var array $aLocalSettings Contains local settings */
        $aLocalSettings = $this->pLocalFileReader->read();

        // Replace main settings with local settings.
        if (!empty($aLocalSettings)) {
            $aSettings = array_replace_recursive($aSettings, $aLocalSettings);
        }

        // Update many settings
        $this->updateWebsiteSettings($aSettings);
        $this->updateSessionSettings($aSettings);

        // Sorts
        sortArrayByKey($aSettings);

        return $aSettings;
    }

    /**
     * Update the application wabsite settings
     *
     * @param array $aSettings The settings
     * @throws Exception\RuntimeException If settings is missing.
     * @throws \Exception if the URI contains invalid characters
     * @return void
     */
    protected function updateWebsiteSettings(array &$aSettings): void
    {
        // Parse the url according to RFC3986
        if (
            !isset($aSettings['application'])
            || !is_array($aSettings['application'])
            || !isset($aSettings['application']['website'])
            || !is_array($aSettings['application']['website'])
            || !isset($aSettings['application']['website']['url'])
            || empty($aSettings['application']['website']['url'])
        ) {
            throw new Exception\RuntimeException('The application.website.url setting is missing in the config file.');
        }
        $aWebsite = &$aSettings['application']['website'];
        $pParser = new Parser();
        $aWebsite = array_merge($aWebsite, $pParser($aWebsite['url']));
    }

    /**
     * Update the php session settings
     *
     * @param array $aSettings The settings
     * @throws Exception\RuntimeException If settings is missing.
     * @return void
     */
    protected function updateSessionSettings(array &$aSettings): void
    {
        // Mandatory settings
        if (
            !isset($aSettings['application'])
            || !is_array($aSettings['application'])
            || !isset($aSettings['application']['temporary_path'])
            || empty($aSettings['application']['temporary_path'])
        ) {
            throw new Exception\RuntimeException(
                'The application.temporary_path setting is missing in the config file.'
            );
        }
        // Update
        $aSettings['php']['session.cookie_domain'] = $aSettings['application']['website']['host'];
        $aSettings['php']['session.save_path'] = $aSettings['application']['temporary_path'];
        if ('https' === $aSettings['application']['website']['scheme']) {
            $aSettings['php']['session.cookie_secure'] = '1';
        }
    }
}
