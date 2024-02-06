<?php

namespace Mapslat;


use Mapslat\HttpClient\HttpClient;
use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Contracts\HttpClient\ResponseInterface;

class Mapslat {

	protected HttpClient $httpClient;

	public function __construct(
		protected string $apiKey,
		protected bool $throw = true) {
		$this->httpClient = new HttpClient(
			new CurlHttpClient(),
			$this->apiKey,
			$this->throw
		);
	}

	public function search(array|string $payload): ResponseInterface {
		return $this->httpClient->fetch('search', $payload);
	}

	public function reverse(array|string $payload): ResponseInterface {
		return $this->httpClient->fetch('reverse', $payload);
	}

	public function lookup(array|string $payload): ResponseInterface {
		return $this->httpClient->fetch('lookup', $payload);
	}

	public function autocomplete(array|string $payload): ResponseInterface {
		return $this->httpClient->fetch('autocomplete', $payload);
	}

	public function route(array|string $payload): ResponseInterface {
		return $this->httpClient->fetch('route', $payload);
	}

	public function optimal(array|string $payload): ResponseInterface {
		return $this->httpClient->fetch('optimal', $payload);
	}

	public function locate(array|string $payload): ResponseInterface {
		return $this->httpClient->fetch('locate', $payload);
	}

	public function isoline(array|string $payload): ResponseInterface {
		return $this->httpClient->fetch('isoline', $payload);
	}

	public function matrix(array|string $payload): ResponseInterface {
		return $this->httpClient->fetch('matrix', $payload);
	}

	public function match(array|string $payload): ResponseInterface {
		return $this->httpClient->fetch('match', $payload);
	}

	public function attributes(array|string $payload): ResponseInterface {
		return $this->httpClient->fetch('attributes', $payload);
	}

}