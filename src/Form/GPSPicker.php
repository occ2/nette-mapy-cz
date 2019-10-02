<?php declare(strict_types=1);

namespace MapyCZ\Form;

use MapyCZ\Exceptions\MapException;
use MapyCZ\TMap;
use Nette\Forms\Container;
use Nette\Forms\Controls\TextInput;
use Nette\Utils\ArrayHash;
use Nette\Utils\Html;
use Nette\Utils\Json;
use Nette\Utils\JsonException;

/**
 * Class MapPicker
 * @package MapyCZ\Form
 */
class GPSPicker extends TextInput
{
    use TMap;

    /**
     * GPSPicker constructor.
     * @param null $label
     * @param null $maxLength
     */
    public function __construct($label = null, $maxLength = null)
    {
        parent::__construct($label, $maxLength);
    }

    /**
     * register extension method
     */
    public static function register()
    {
        Container::extensionMethod(
            'addGPSPicker',
            function ($container, $name, $label = null, $maxLength = null) {
                return $container[$name] = new GPSPicker($label, $maxLength);
            }
        );
    }

    /**
     * @return Html
     * @throws JsonException
     */
    public function getControl(): Html
    {
        $control = parent::getControl();
        $map = Html::el("div", ["id" => $this->settings["mapId"]]);
        $this->settings["formControlId"] = $this->getHtmlId();
        if (!empty($this->value)) {
            $v = explode(" ", $this->value);
            $this->settings["valueLatitude"] = $v[0];
            $this->settings["valueLongitude"] = $v[1];
        }
        $script = $js = Html::el("script");
        $js->type = "text/javascript";
        $js->addText(
            '
            const settings = ' . Json::encode($this->settings) . ';
            console.log(settings);
            const mapPicker = MapyCZ.Factory.createMapPicker(document, settings);
            mapPicker.init();
            '
        );
        return (Html::el("div"))->addHtml($map)->addHtml($control)->addHtml($script);
    }

    /**
     * @return ArrayHash
     * @throws MapException
     */
    public function getValue(): ArrayHash
    {
        $a = explode(" ", $this->value);
        if (count($a) != 2) {
            throw new MapException(
                "ERROR: Invalid value",
                MapException::INVALID_VALUE
            );
        }
        $this->value = ArrayHash::from([
            "latitude" => $this->validateLatitude((float) $a[0]),
            "longitude" => $this->validateLongitude((float) $a[1]),
        ]);
        return parent::getValue();
    }

    /**
     * @param $value
     */
    public function setValue($value)
    {
        if (is_object($value)) {
            $lat = $value->latitude;
            $lon = $value->longitude;
            $value = $lat . " " . $lon;
        }
        parent::setValue($value);
    }

    /**
     * @param float $latitude
     * @return float
     * @throws MapException
     */
    protected function validateLatitude(float $latitude): float
    {
        if ($latitude < -90 || $latitude > 90) {
            throw new MapException(
                "ERROR: Latitude must be interval between -90 and 90",
                MapException::INVALID_LATITUDE
            );
        }
        return $latitude;
    }

    /**
     * @param float $longitude
     * @return float
     * @throws MapException
     */
    protected function validateLongitude(float $longitude): float
    {
        if ($longitude < -180 || $longitude > 180) {
            throw new MapException(
                "ERROR: Longitude must be interval between -180 and 180",
                MapException::INVALID_LONGITUDE
            );
        }
        return $longitude;
    }
}
