<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Config
 * @link    https://github.com/pbraiders/config for the canonical source repository
 * @license https://github.com/pbraiders/config/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Config;

/**
 * Config factory interface.
 */
interface FactoryInterface
{
    /**
     * Creates a config array or object implementing ArrayAccess.
     *
     * @return array|ArrayAccess
     */
    public function create();
}
