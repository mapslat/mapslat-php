<?php

namespace Mapslat\HttpClient;

use Composer\InstalledVersions;


use Mapslat\Exception\HttpClientException;
use Mapslat\Exception\HttpServerException;
use Mapslat\Exception\HttpTransportException;
use Mapslat\Exception\UnknownErrorException;
use Symfony\Component\HttpClient\Exception\ClientException;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Throwable;

class HttpClient {

	public function __construct(
		private HttpClientInterface $client,
		protected string $apiKey,
		protected bool $throw) { }


	public function fetch(string $endpoint, array|string $payload): ?ResponseInterface {
		if (!is_array($payload)) $payload = json_decode($payload, true);
		try {
			$response = $this->client->request(
				'POST',
				$endpoint,
				[
					'headers' => [
						'User-Agent' => 'mapslat-php '. InstalledVersions::getRootPackage()['pretty_version']
					],
					'auth_bearer' => $this->apiKey,
					'base_uri' => 'https://api.maps.lat',
					'json' => $payload
				]
			);
			if (isset($response->toArray($this->throw)['error'])) throw new ClientException($response);
			return $response;
		} catch (TransportExceptionInterface $e) {
			if ($this->throw) throw new HttpTransportException("Mapslat server is currently unreachable.");
			return null;
		} catch (ClientException) {
			$statusCode = $response->getStatusCode();
			if ($statusCode >= 500) throw new HttpServerException("An unexpected error occurred at Mapslat server.", $statusCode);

			$message = json_decode($response->getContent(false), true)['error'] ?? "Unknown client error occurred.";
			if ($this->throw) throw new HttpClientException($message);

			return null;
		} catch (Throwable $e) {
			if ($this->throw) throw new UnknownErrorException("", "", $e);
			return null;
		}
	}



}