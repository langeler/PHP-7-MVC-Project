<?php

namespace App\Controllers\Auth;

use App\Core\Controller as Controller;

class LogoutController extends Controller
{
	public function get()
	{
		$this->session->logout();
		$this->redirect("");
	}
}
