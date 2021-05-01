<?php

namespace App\Controllers\Auth;

use App\Core\Controller as Controller;
use App\Models\ListClass;

class DashboardController extends Controller
{
	protected $pageTitle;
	protected $pageUrl;
	protected $pageData;
	protected $message;

	public function get()
	{
		$this->pageTitle = "Dashboard";
		$this->pageUrl = DOMAIN . "dashboard";

		// Get user by session value
		$this->userModel->id = $this->session->getSessionValue("user_id");
		$account = $this->userModel->readOne();

		// Set page data with variables
		$this->pageData = [
			"account" => $account,
		];

		if (!$this->isUserLoggedIn()) {
			$this->redirect("login");
		}

		$this->view("auth/dashboard", [
			"pageTitle" => $this->pageTitle,
			"pageUrl" => $this->pageUrl,
			"pageData" => $this->pageData,
		]);
	}
}
