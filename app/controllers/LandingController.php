<?php
namespace App\Controllers;

use App\Core\Controller as Controller;

class LandingController extends Controller
{
	public $pageTitle = "Landing";

	public function get()
	{
		$this->view("landing");
	}
}
