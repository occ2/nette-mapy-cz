# Nette MAPY.CZ
Map coordinates picker and map control using mapy.cz API for Nette Framework

## Installation
`composer require occ2/nette-mapy-cz`

## Install JS file
Add assets/mapycz.js into your web directory (www/js etc.)

## Add MAPY.CZ loader and project javascript files to your page heading
```
<head>
	<script src="https://api.mapy.cz/loader.js"></script>
	<script>Loader.load()</script>
	<script src="_your_js_directory_/mapycz.js"></script>
</head>
```

## Setup config
Register control factory as service in your config.neon register extension add picker to you forms
```
latte.latteFactory:
	# add filter json to your latte engine 
    setup:
        - addFilter(json, Filters::json)

# register method addGpsPicker to youe forms
extensions:
	mapycz: MapyCZ\DI\GPSPickerExtension

# create map control factory service
services:
    -   MapyCZ\Controls\MapControl\Factories\IMapControlFactory
```

## Usage 
In your presenter
```
use MapyCZ\Controls\MapControl\Factories\IMapControlFactory;
use MapyCZ\Controls\MapControl;
use Nette\Application\UI\Form;

/**
 * @var IMapControlFactory
 * @inject
 */
public $mapControlFactory;

...

/**
 * @return MapControl
 * @param string $name
 */
protected function createComponentMap(string $name): MapControl
{
    $map = $this->mapControlFactory->create();
    $map->settings = [
        "mapId" => "map", // HTML id of map element
        "width" => 400, // map width in pixels
        "height" => 300, // map height in pixels
        "units" => "px", // units of map dimensiosns 
        "mapType" => 1, // default map
        "center" => [ // default center of map
            "latitude" => 50,
            "longitude" => 15
        ],
        "defaultZoom" => 13 // default zoom
        "controls" => true // show controls
    ];
    $this->addComponent($map, $name);
    return $map;
}

...

/**
 * @return Form
 * @param string $name
 */
protected function createComponentForm(string $name): Form
{
	$form = new Form();
	
	...
	$form->addGpsPicker('gps', 'Vyberte polohu')
             ->setSettings([
                "mapId" => "map",
                "width" => 400,
                "height" => 300,
                "mapType" => 1,
                "units" =>  "px",
                "center" => [
                    "latitude" => 50,
                    "longitude" => 15
                ],
                "defaultZoom" => 12,
                "controls" => true
             ]);
	..
	
	$this-addComponent($form, $name);
	return $form;
}
```

GPS picker validate coordinates (latitude -90 - 90, longitude -180 - 180) on server side.
and returns ArrayHash with latitude and longitude properties
```
	 $values = $form->getValues();
	 $latitude = $values->gps->latitude;
	 $longitude = $values->gps->longitude;
```
