<?php

namespace App\Controllers\Auth;

use App\Core\Controller as Controller;

class resetController extends Controller
{
	protected $pageTitle;
	protected $pageUrl;
	protected $pageData;
	protected $message;

	public function post()
	{
		$post = $this->filter_post();

		$this->session->csrf = $post["csrf"];
		if ($this->session->validateCSRF()) {
			$this->userModel->username = $post["username"];
			$this->userModel->access = $post["access"];
			$this->userModel->npassword = $post["npassword"];
			$this->userModel->cpassword = $post["cpassword"];

			// Validate username, password, and email
			if ($this->userModel->validateResetPassword()) {
				if ($this->userModel->recover()) {
					redirect("login");
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

	public function get($vars = null)
	{
		if ($vars["username"] && $vars["access"]) {
			$this->pageTitle = "Reset Password";
			$this->pageUrl =
				DOMAIN . "reset/" . $vars["username"] . "/" . $vars["access"];

			$this->userModel->username = $vars["username"];
			$this->userModel->access = $vars["access"];

			if ($this->userModel->validateReset()) {
				// Set page data with variables
				$this->pageData = [
					"csrf" => $this->session->getSessionValue("csrf"),
					"access" => $vars["access"],
					"username" => $vars["username"],
				];

				if ($this->isUserLoggedIn()) {
					redirect("dashboard");
				}

				$this->view("auth/reset", [
					"pageTitle" => $this->pageTitle,
					"pageUrl" => $this->pageUrl,
					"pageData" => $this->pageData,
				]);
			}
		}
	}
}
