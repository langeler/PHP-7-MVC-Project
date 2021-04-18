<?php

namespace App\Controllers;

use App\Core\Controller as Controller;
use App\Models\ListClass;

class ProfileController extends Controller
{
	protected $pageTitle = "Profile";
	protected $account;

	public function get()
	{
		$this->userModel->id = $this->session->getSessionValue("user_id");
		$this->session->authenticate($this->userModel->id);

		// Get user by session value
		$this->account = $this->userModel->readOne();

		$this->view("profile");
	}
}
