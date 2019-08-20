<?php
declare(strict_types=1);

namespace MapyCZ\Controls;

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
	 * render control
	 */
	public function render()
	{
		$this->template->settings = $this->settings;
		$this->template->setFile(self::TEMPLATE);
		$this->template->render();
	}
}
