<?php

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
}
