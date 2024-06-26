<?php

namespace App\Controllers\Auth;

use App\Core\Controller as Controller;

class RegisterController extends Controller
{
	protected $pageTitle;
	protected $pageUrl;
	protected $pageData;

	public function post()
	{
		// Filter post fields
		$post = $this->filter_post();

		// Set CSRF token to be verified
		$this->session->csrf = $post["csrf"];

		// Verify CSRF token
		if ($this->session->validateCSRF()) {
			$this->userModel->forename = $post["forename"];
			$this->userModel->surname = $post["surname"];
			$this->userModel->phone = $post["phone"];
			$this->userModel->email = $post["email"];
			$this->userModel->username = $post["username"];
			$this->userModel->password = $post["password"];
			$this->userModel->cpassword = $post["cpassword"];
			$this->userModel->role = DEFAULT_ROLE; // Default role definied

			// Validate username, password, and email
			if ($this->userModel->validateCreate()) {
				// Register new user

				if ($this->userModel->create()) {
					$this->flash->success(
						"Your account is successfully registered."
					);
					redirect("login");
				} else {
					$this->flash->error("Unable to process update.");
					redirect("register");
				}
			} else {
				$errors = $this->userModel->getErrors();
				foreach ($errors as $error) {
					$this->flash->error($error);
				}
				redirect("register");
			}
		}
	}

	public function get()
	{
		$this->pageTitle = "Register";
		$this->pageUrl = DOMAIN . "register";

		// Set page data with variables
		$this->pageData = [
			"csrf" => $this->session->getSessionValue("csrf"),
		];

		if ($this->isUserLoggedIn()) {
			redirect("dashboard");
		}

		$this->view("auth/register", [
			"pageTitle" => $this->pageTitle,
			"pageUrl" => $this->pageUrl,
			"pageData" => $this->pageData,
		]);
	}
}
