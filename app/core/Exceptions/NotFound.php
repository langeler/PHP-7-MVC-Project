<?php

namespace App\Core\Exceptions;

class NotFoundException extends \Exception
{
	public function __construct(
		$message = "Page not found",
		$code = 404,
		$previous = null
	) {
		parent::__construct($message, $code, $previous);

		redirect($code);
	}
}
