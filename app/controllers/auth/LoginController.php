<?php

namespace App\Controllers\Auth;

use App\Core\Controller as Controller;

class LoginController extends Controller
{
	protected $pageTitle = "Login";
	protected $account;
	protected $message;
	protected $csrf;

	public function post()
	{
		$post = $this->filter_post();

		$this->session->csrf = $post["csrf"];
		if ($this->session->validateCSRF()) {
			$this->userModel->username = $this->clean($post["username"]);
			$this->userModel->password = $this->clean($post["password"]);

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
		$isLoggedIn = $this->session->isUserLoggedIn();
		$this->csrf = $this->session->getSessionValue("csrf");

		if ($isLoggedIn) {
			$this->redirect("dashboard");
		}

		$this->view("auth/login");
	}
}
