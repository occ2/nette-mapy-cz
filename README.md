# Nette MAPY.CZ
Map coordinates picker and map control using mapy.cz API for Nette Framework

## Installation
`composer require occ2/nette-mapy-cz`

## Add MAPY.CZ loader javascript to your page heading
```
<head>
	<script src="https://api.mapy.cz/loader.js"></script>
	<script>Loader.load()</script>
</head>
```

## Create simple map control
Register control factory as service in your config.neon
```
services:
    -   MapyCZ\Controls\MapControl\Factories\IMapControlFactory
```

In your presenter
```
use MapyCZ\Controls\MapControl\Factories\IMapControlFactory;
use MapyCZ\Controls\MapControl;

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
        "htmlId" => "map", // HTML id of map element
        "width" => 400, // map width in pixels
        "height" => 300, // map height in pixels
        "mapType" => "DEF_BASE", // default map
        "center" => [ // default center of map
            "latitude" => 50,
            "longitude" => 15
        ],
        "zoom" => 13 // default zoom
    ];
    $this->addComponent($map, $name);
    return $map;
}
```
