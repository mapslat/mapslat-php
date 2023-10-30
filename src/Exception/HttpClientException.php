<?php

namespace Mapslat\Exception;

use Throwable;

class HttpClientException extends \Exception {
	function __construct(string $message = "", int $code = 0, ?Throwable $previous = null) {
		parent::__construct($message, $code, $previous);
	}
}