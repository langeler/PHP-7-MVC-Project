<?php

namespace App\Controllers;

use App\Core\Controller as Controller;

class ExceptionNotFoundController extends Controller
{
	public $pageTitle = "404";

	public function get()
	{
		$this->view("404");
	}
}
