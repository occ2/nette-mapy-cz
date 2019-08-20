<?php

namespace MapyCZ;

use MapyCZ\Exceptions\MapException;
use MapyCZ\MapControls\IMapControl;
use Nette\SmartObject;

/**
 * Trait TMap
 * @package MapyCZ
 *
 * @property-write array $settings
 * @property-write string $htmlId
 * @property-write int $width
 * @property-write int $height
 * @property-write string $mapBase
 * @property-write int $zoom
 * @property-write float $centerLatitude
 * @property-write float $centerLongitude
 * @property-write bool|array $controls
 */
trait TMap
{
	use SmartObject;

	/**
	 * @var array
	 */
	protected $settings = [
		"htmlId" => "map",
		"width" => 400,
		"height" => 300,
		"mapType" => "DEF_BASE",
		"center" => [
			"latitude" => 50,
			"longitude" => 15
		],
		"zoom" => 13,
		"controls" => true
	];

	/**
	 * @param bool|array $controls
	 * @return $this
	 */
	public function setControls($controls)
	{
		$this->settings["controls"] = $controls;
		return $this;
	}

	/**
	 * @param array $settings
	 * @return $this
	 */
	public function setSettings(array $settings)
	{
		$this->settings = $settings;
		return $this;
	}

	/**
	 * @param float $latitude
	 * @param float $longitude
	 * @return $this
	 * @throws MapException
	 */
	public function setCenter(float $latitude, float $longitude)
	{
		$this->setCenterLatitude($latitude)
			 ->setCenterLongitude($longitude);
		return $this;
	}

	/**
	 * @param float $latitude
	 * @return $this
	 * @throws MapException
	 */
	public function setCenterLatitude(float $latitude)
	{
		if ($latitude < -90 || $latitude > 90) {
			throw new MapException(
				"ERROR: Invalid latitude",
				MapException::INVALID_LATITUDE
			);
		}
		$this->settings["center"]["latitude"] = $latitude;
		return $this;
	}

	/**
	 * @param float $longitude
	 * @return $this
	 * @throws MapException
	 */
	public function setCenterLongitude(float $longitude)
	{
		if ($longitude < -180 || $longitude > 180) {
			throw new MapException(
				"ERROR: Invalid longitude",
				MapException::INVALID_LONGITUDE
			);
		}
		$this->settings["center"]["longitude"] = $longitude;
		return $this;
	}

	/**
	 * @param int $zoom
	 * @return $this
	 */
	public function setZoom(int $zoom)
	{
		$this->settings["zoom"] = $zoom;
		return $this;
	}

	/**
	 * @param string $htmlId
	 * @return $this
	 */
	public function setHtmlId(string $htmlId)
	{
		$this->settings["htmlId"] = $htmlId;
		return $this;
	}

	/**
	 * @param int $width
	 * @return $this
	 */
	public function setWidth(int $width)
	{
		$this->settings["width"] = $width;
		return $this;
	}

	/**
	 * @param int $height
	 * @return $this
	 */
	public function setHeight(int $height)
	{
		$this->settings["height"] = $height;
		return $this;
	}

	/**
	 * @param string $mapType
	 * @return $this
	 */
	public function setMapType(string $mapType)
	{
		$this->settings["mapType"] = $mapType;
		return $this;
	}

	/**
	 * @param IMapControl $control
	 * @return $this
	 */
	public function addControl(IMapControl $control)
	{
		$this->settings["controls"][] = $control;
		return $this;
	}
}
