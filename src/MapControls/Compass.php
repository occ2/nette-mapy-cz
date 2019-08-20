<?php

namespace MapyCZ\MapControls;

class Compass implements IMapControl
{
	/**
	 * @var int
	 */
	public $left = 10;

	/**
	 * @var int
	 */
	public $top = 10;

	/**
	 * @var int
	 */
	public $panAmount = 1;

	/**
	 * @var string
	 */
	public $title = "Kompas";

	/**
	 * @var int
	 */
	public $moveThreshold = 300;

	/**
	 * @return string
	 */
	public function __toString(): string
	{
		return '
			let compass = new SMap.Control.Compass({
				title: ' . $this->title . ',
				panAmount: ' . $this->panAmount . ',
				moveThreshold: ' . $this->moveThreshold . '
			});
			__map.addControl(compass, {
				left:' . $this->left . '"px",
				top:' . $this->top . '"px"
			});
		';
	}
}
