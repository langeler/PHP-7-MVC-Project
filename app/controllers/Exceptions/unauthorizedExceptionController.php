<?php

namespace App\Controllers;

use App\Core\Controller as Controller;

class unauthorizedExceptionController extends Controller
{
	public $pageTitle = "500";

	public function get()
	{
		$this->view("Exceptions/500");
	}
}
