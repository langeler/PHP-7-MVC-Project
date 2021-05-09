<?php

namespace App\Controllers\Auth;

use App\Core\Controller as Controller;

class LoginController extends Controller
{
	protected $pageTitle;
	protected $pageUrl;
	protected $pageData;

	public function logout()
	{
		$this->session->logout();
		redirect("");
	}

	public function post()
	{
		$post = $this->filter_post();

		$this->session->csrf = $post["csrf"];
		if ($this->session->validateCSRF()) {
			$this->userModel->username = $post["username"];
			$this->userModel->password = $post["password"];

			// Validate username, password, and email
			if ($this->userModel->validateLogin()) {
				if ($this->userModel->login()) {
					redirect("dashboard");
				} else {
					$this->flash->error("Username or password is invalid.");
					redirect("login");
				}
			} else {
				$errors = $this->userModel->getErrors();
				foreach ($errors as $error) {
					$this->flash->error($error);
				}
				redirect("login");
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
			redirect("dashboard");
		}

		$this->view("auth/login", [
			"pageTitle" => $this->pageTitle,
			"pageUrl" => $this->pageUrl,
			"pageData" => $this->pageData,
		]);
	}
}
