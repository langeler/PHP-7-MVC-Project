<?php

namespace App\Core\Exceptions;

class unauthorizedException extends \Exception
{
	public function __construct(
		$message = "You are not allowed to access this page",
		$code = 401,
		$previous = null
	) {
		parent::__construct($message, $code, $previous);

		redirect($code);
	}
}
