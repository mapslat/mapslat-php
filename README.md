# Maps.lat PHP client

This is a Maps.lat APi client written in PHP. This package contains methods for interacting with APi. Below are some usage examples. You can find more information about the APi in the [Maps.lat documentation](https://maps.lat/docs). 

## Installation

You must use [Composer](http://getcomposer.org/) to install this package. You can install Composer using the command.

```shell
curl -sS https://getcomposer.org/installer | php
```

Package supports PHP version 8.0 and higher. To install this package, run the following command.

```shell
composer require mapslat/mapslat-php
```

## Usage

The examples below assume that you are using Composer autoloader in your application. The autoloader is called by the following code.

```php
require 'vendor/autoload.php';
use Mapslat\Mapslat;
```

### Request structure

Create an instance of the class and pass one or two parameters. The first parameter is your API key. The second optional parameter is the ```$throw``` flag, which determines whether to throw exceptions on errors (defaults to true).

```php
$mapslat = new Mapslat($apiKey);
```

The request is built from an array or from a json string that you pass to the method you are calling.

```php
// array as input data
$geocoding = $mapslat->search([
	'query' => 'chicago',
	'limit' => 1
]);

// or json as input data
$geocoding = $mapslat->search('{
	"query": "london",
	"limit": 1
}');
```

### Response structure

The response is returned as an instance of ```Symfony\Contracts\HttpClient\ResponseInterface```. You can call interface methods that return headers, data, http status, etc. See the [Symfony HttpClient documentation](https://symfony.com/doc/current/http_client.html#processing-responses) for more details.

```php
// get response data
$isoline = $mapslat->isoline('{
	"lon": 13.37467722463873,
	"lat": 52.55351817997314,
	"costing": "auto",
	"polygons": true,
	"time": 5
}')->toArray();

// get status code
$statusCode = $mapslat->search([
	'query' => 'chicago',
	'limit' => 1
])->getStatusCode();

// get response headers
$reverse = $mapslat->reverse([
	'lon' => -73.99672895945677,
	'lat' => 40.72494710252593
]);
$headers = $reverse->getHeaders();

// get raw response
$rawResponse = $mapslat->search([
	'query' => 'miami beach',
	'limit' => 3
])->getContent();
```

## Requests to API

For each Maps.lat API endpoint, there is a method for interactions.

### Geocoding

```php
// forward geocoding
$data = $mapslat->search($payload)->toArray();

// reverse geocoding
$data = $mapslat->reverse($payload)->toArray();

// geocoding lookup
$data = $mapslat->lookup($payload)->toArray();
```

### Address autocomplete

```php
$data = $mapslat->autocomplete($payload)->toArray();
```

### Routing

```php
// routing
$data = $mapslat->route($payload)->toArray();

// optimal route
$data = $mapslat->optimal($payload)->toArray();

//routing locate
$data = $mapslat->locate($payload)->toArray();
```

### Isoline

```php
$data = $mapslat->isoline($payload)->toArray();
```

### Matrix

```php
$data = $mapslat->matrix($payload)->toArray();
```

### Map matching

```php
// matching routes
$data = $mapslat->match($payload)->toArray();

// matching attributes
$data = $mapslat->attributes($payload)->toArray();
```

## Contribute

This package is Open Source, published under the [MIT license](https://opensource.org/license/mit/). You can participate in its development and improvement.

We will be glad if you take part in the work on this package. Create issues if you find bugs, develop your own and review other people's pull requests, respond to other people's issues, and so on. 

## Support and feedback

Be sure to visit the [Maps.lat documentation](https://maps.lat/docs) for additional information about our API.

If you find a bug, please submit the issue in [Github directly](https://github.com/mapslat/mapslat-php/issues).

If you need further assistance email us at [support@maps.lat](support@maps.lat).