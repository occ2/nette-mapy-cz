<?php

namespace MapyCZ\Controls\MapControl\Factories;

use MapyCZ\Controls\MapControl;

/**
 * Interface IMapControlFactory
 * @package MapyCZ
 */
interface IMapControlFactory
{
	/**
	 * @return MapControl
	 */
	public function create(): MapControl;
}
