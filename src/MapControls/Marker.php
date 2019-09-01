<?php declare(strict_types=1);

namespace MapyCZ\MapControls;

use MapyCZ\Exceptions\MapException;
use Nette\Utils\ArrayHash;
use Nette\Utils\Json;
use Nette\Utils\JsonException;

/**
 * Class Marker
 * @package MapyCZ\MapControls
 */
class Marker implements IMapControl
{
    private $data = [];

    /**
     * Marker constructor.
     * @param float $latitude
     * @param float $longitude
     * @param string|null $title
     * @param string|null $id
     * @param int|null $size
     * @param string|null $url
     * @throws MapException
     */
    public function __construct(
        float $latitude,
        float $longitude,
        ?string $title = null,
        ?string $id = null,
        ?int $size = null,
        ?string $url = null
    ) {
        $this->data = new ArrayHash();
        $this->setLatitude($latitude);
        $this->setLongitude($longitude);
        $this->setId($id);
        $this->setTitle($title);
        $this->setSize($size);
        $this->setUrl($url);
    }

    /**
     * @param float $latitude
     * @return $this
     * @throws MapException
     */
    public function setLatitude(float $latitude)
    {
        if ($latitude < -90 || $latitude > 90) {
            throw new MapException(
                "ERROR: Invalid latitude",
                MapException::INVALID_LATITUDE
            );
        }
        $this->data->latitude = $latitude;
        return $this;
    }

    /**
     * @param float $longitude
     * @return $this
     * @throws MapException
     */
    public function setLongitude(float $longitude)
    {
        if ($longitude < -180 || $longitude > 180) {
            throw new MapException(
                "ERROR: Invalid longitude",
                MapException::INVALID_LONGITUDE
            );
        }
        $this->data->longitude = $longitude;
        return $this;
    }

    /**
     * @param string|null $id
     * @return $this
     */
    public function setId(?string $id)
    {
        $id == null ?: $this->data->id = $id;
        return $this;
    }

    /**
     * @param string|null $title
     * @return $this
     */
    public function setTitle(?string $title)
    {
        $title == null ?: $this->data->title = $title;
        return $this;
    }

    /**
     * @param int|null $size
     * @return $this
     */
    public function setSize(?int $size)
    {
        $size == null ?: $this->data->size = $size;
        return $this;
    }

    /**
     * @param string|null $url
     * @return $this
     */
    public function setUrl(?string $url)
    {
        $url == null ?: $this->data->url = $url;
        return $this;
    }

    /**
     * @return string
     * @throws JsonException
     */
    public function __toString(): string
    {
        return Json::encode($this->data);
    }
}
