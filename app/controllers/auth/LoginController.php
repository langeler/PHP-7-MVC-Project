<?php

namespace App\Controllers\Auth;

use App\Core\Controller as Controller;

class LoginController extends Controller
{
	protected $pageTitle;
	protected $pageUrl;
	protected $pageData;
	protected $message;

	public function logout()
	{
		$this->session->logout();
		$this->redirect("");
	}

	public function post()
	{
		$post = $this->filter_post();

		$this->session->csrf = $post["csrf"];
		if ($this->session->validateCSRF()) {
			$this->userModel->username = clean($post["username"]);
			$this->userModel->password = clean($post["password"]);

			// Validate username, password, and email
			if ($this->userModel->validateLogin()) {
				if ($this->userModel->login()) {
					$this->redirect("dashboard");
				} else {
					$this->message = LOGIN_FAIL;

					echo $this->message;
					exit();
				}
			} else {
				$this->message = USERNAME_NOT_EXISTS;

				echo $this->message;
				exit();
			}
		}
	}

	public function get()
	{
		$this->pageTitle = "Login";
		$this->pageUrl = DOMAIN . "login";

		// Set page data with variables
		$this->pageData = [
			"csrf" => $this->session->getSessionValue("csrf"),
		];

		if ($this->isUserLoggedIn()) {
			$this->redirect("dashboard");
		}

		$this->view("auth/login", [
			"pageTitle" => $this->pageTitle,
			"pageUrl" => $this->pageUrl,
			"pageData" => $this->pageData,
		]);
	}
}
