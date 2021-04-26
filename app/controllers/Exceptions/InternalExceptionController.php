<?php

namespace App\Controllers;

use App\Core\Controller as Controller;

class InternalExceptionController extends Controller
{
	public $pageTitle = "401";

	public function get()
	{
		$this->view("Exceptions/401");
	}
}
