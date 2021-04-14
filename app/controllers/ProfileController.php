<?php

namespace App\Controllers;

use App\Core\Controller as Controller;
use App\Models\ListClass;

class ProfileController extends Controller
{
	public $pageTitle;
	public $user;

	public function get()
	{
		$userId = $this->session->getSessionValue("user_id");
		$this->session->authenticate($userId);
		$this->csrf = $this->session->getSessionValue("csrf");

		// Get user by session value
		$this->user = $this->userControl->getUser($userId);

		$this->view("profile");
	}
}
