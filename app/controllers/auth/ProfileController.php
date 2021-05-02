<?php

namespace App\Controllers\Auth;

use App\Core\Controller as Controller;
use App\Models\ListClass;

class ProfileController extends Controller
{
	protected $pageTitle;
	protected $pageUrl;
	protected $pageData;
	protected $message;

	public function get()
	{
		$this->pageTitle = "Profile";
		$this->pageUrl = DOMAIN . "profile";

		// Get user by session value
		$this->userModel->id = $this->session->getSessionValue("user_id");
		$account = $this->userModel->readOne();

		// Set page data with variables
		$this->pageData = [
			"account" => $account,
		];

		if (!$this->isUserLoggedIn()) {
			redirect("login");
		}

		$this->view("auth/profile", [
			"pageTitle" => $this->pageTitle,
			"pageUrl" => $this->pageUrl,
			"pageData" => $this->pageData,
		]);
	}
}
