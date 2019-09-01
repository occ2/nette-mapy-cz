<?php declare(strict_types=1);

namespace MapyCZ\Controls;

use MapyCZ\MapControls\Marker;
use MapyCZ\TMap;
use Nette\Application\UI\Control;

/**
 * Class MapControl
 * @package MapyCZ\Controls
 */
class MapControl extends Control
{
    use TMap;

    const TEMPLATE = __DIR__ . '/../templates/mapControl.latte';

    /**
     * @var Marker[]
     */
    protected $markers = [];

    /**
     * @param Marker $marker
     * @return $this
     */
    public function addMarker(Marker $marker)
    {
        $this->markers[] = (string) $marker;
        return $this;
    }

    /**
     * render control
     */
    public function render()
    {
        if (count($this->markers) > 0) {
            $this->settings["markers"] = $this->markers;
        }
        $this->template->settings = $this->settings;
        $this->template->setFile(self::TEMPLATE);
        $this->template->render();
    }
}
