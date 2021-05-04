<?php

namespace App\Controllers\Auth;

use App\Core\Controller as Controller;

class recoverController extends Controller
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
			$this->userModel->email = $post["email"];

			// Validate username, password, and email
			if ($this->userModel->validateRecovery()) {
				$this->userModel->access = $this->random();

				$ResetLink =
					DOMAIN .
					"reset/" .
					$this->userModel->username .
					"/" .
					$this->userModel->access;

				// send reset link
				$body = "Hi there.<br /><br />";
				$body .= "Please click the following link to reset your password: {$$ResetLink}";
				$subject = "Reset Password";
				$send_to_email = $this->userModel->email;

				// if($this->sendEmailViaPhpMailerLibrary($send_to_email, $subject, $body)){
				$from_name = "XYZ Webstore";
				$from_email = "admin@example.com";

				if ($this->userModel->updateAccess()) {
					$this->sendEmailViaPhpMail(
						$from_name,
						$from_email,
						$to_email,
						$subject,
						$body
					);
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

	public function get()
	{
		$this->pageTitle = "Recover Password";
		$this->pageUrl = DOMAIN . "recover";

		// Set page data with variables
		$this->pageData = [
			"csrf" => $this->session->getSessionValue("csrf"),
		];

		if ($this->isUserLoggedIn()) {
			redirect("dashboard");
		}

		$this->view("auth/recover", [
			"pageTitle" => $this->pageTitle,
			"pageUrl" => $this->pageUrl,
			"pageData" => $this->pageData,
		]);
	}
}
