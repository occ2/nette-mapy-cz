<?php declare(strict_types=1);

namespace MapyCZ\Factories;

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
