<?php

namespace App\Controllers;

use App\Core\Controller as Controller;

class NotFoundExceptionController extends Controller
{
	public $pageTitle = "404";

	public function get()
	{
		$this->view("Exceptions/404");
	}
}
