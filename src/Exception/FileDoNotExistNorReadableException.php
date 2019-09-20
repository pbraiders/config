<?php

/**
 * @package Pbraiders\Config\Exception
 * @link    https://github.com/pbraiders/config for the canonical source repository
 * @license https://github.com/pbraiders/config/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Config\Exception;

/**
 * Exception thrown if an error which can only be found on runtime occurs.
 */
class FileDoNotExistNorReadableException extends \RuntimeException implements ExceptionInterface
{
}
