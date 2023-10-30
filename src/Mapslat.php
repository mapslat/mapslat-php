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

	public function geocoding(array|string $payload): ResponseInterface {
		return $this->httpClient->fetch('geocoding', $payload);
	}

	public function geocodingReverse(array|string $payload): ResponseInterface {
		return $this->httpClient->fetch('geocoding/reverse', $payload);
	}

	public function geocodingLookup(array|string $payload): ResponseInterface {
		return $this->httpClient->fetch('geocoding/lookup', $payload);
	}

	public function routing(array|string $payload): ResponseInterface {
		return $this->httpClient->fetch('routing', $payload);
	}

	public function routingLocate(array|string $payload): ResponseInterface {
		return $this->httpClient->fetch('routing/locate', $payload);
	}

	public function isoline(array|string $payload): ResponseInterface {
		return $this->httpClient->fetch('isoline', $payload);
	}

	public function matrix(array|string $payload): ResponseInterface {
		return $this->httpClient->fetch('matrix', $payload);
	}

	public function matching(array|string $payload): ResponseInterface {
		return $this->httpClient->fetch('matching', $payload);
	}

	public function matchingAttributes(array|string $payload): ResponseInterface {
		return $this->httpClient->fetch('matching/attributes', $payload);
	}

}