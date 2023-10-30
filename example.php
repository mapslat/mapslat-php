<?php

require "vendor/autoload.php";

use Dotenv\Dotenv;
use Mapslat\Mapslat;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$mapslat = new Mapslat($_ENV['API_KEY']);

$geocoding = $mapslat->geocoding([
	'query' => 'chicago',
	'limit' => 1
])->getHeaders();
//print_r($geocoding);


$reverse = $mapslat->geocodingReverse([
	'lon' => -73.99672895945677,
	'lat' => 40.72494710252593
])->getStatusCode();
//print_r($reverse);


$lookup = $mapslat->geocodingLookup([
	'osm_ids' => 'W1111'
])->toArray();
//print_r($lookup);

$routing = $mapslat->routing('{
  "costing": "auto",
  "locations": [
	{
	  "type": "break",
	  "lon": 12.505198514285922,
	  "lat": 41.91423082178753
	},
	{
	  "type": "break",
	  "lon": 12.483054196658486,
	  "lat": 41.891297181607655
	}
  ]
}')->toArray();
//print_r($routing);

$isoline = $mapslat->isoline('{
  "lon": 13.37467722463873,
  "lat": 52.55351817997314,
  "costing": "auto",
  "polygons": true,
  "time": 5
}')->toArray();
//print_r($isoline);