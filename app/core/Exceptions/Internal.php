<?php

namespace App\Core\Exceptions;

class InternalException extends \Exception
{
	public function __construct(
		$message = "Internal error",
		$code = 500,
		$previous = null
	) {
		parent::__construct($message, $code, $previous);

		redirect($code);
	}
}
