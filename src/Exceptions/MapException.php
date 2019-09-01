<?php declare(strict_types=1);

namespace MapyCZ\Exceptions;

use Exception;

/**
 * Class MapException
 * @package MapyCZ\Exceptions
 */
class MapException extends Exception
{
    const INVALID_LATITUDE = 0001;
    const INVALID_LONGITUDE = 0002;
    const INVALID_VALUE = 0003;
}
