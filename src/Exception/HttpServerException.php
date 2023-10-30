<?php

namespace Mapslat\Exception;

use Throwable;

class HttpServerException extends \Exception {
	function __construct(string $message = "", int $code = 0, ?Throwable $previous = null) {
		parent::__construct($message, $code, $previous);
	}
}