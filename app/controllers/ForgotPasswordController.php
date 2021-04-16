<?php

namespace App\Controllers;

use App\Core\Controller as Controller;
use Laconia\Database;

class ForgotPasswordController extends Controller
{
	protected $pageTitle = "Forgot Password";
	protected $message;
	protected $account;
	protected $success = false;

	public function post()
	{
		$post = $this->filter_post();
		$this->session->csrf = $post["csrf"];
		
		if ($this->session->validateCSRF()) {

			$this->userModel->email = filter_var($post["email"], FILTER_VALIDATE_EMAIL);
			$this->userModel->email = filter_var($this->userModel->email, FILTER_SANITIZE_EMAIL);

			$this->account = $this->userModel->getUserByEmail();

			// Email doesn't exist
			if (empty($this->account)) {
				
				$this->message = EMAIL_NOT_EXISTS;

				echo $this->message;
				exit();
			}
		
			// Email exists, proceed
			else {
			
				$this->success = true;

				// Create a secure token for this forgot password request.
				$token = openssl_random_pseudo_bytes(16);
				$token = bin2hex($token);

				$request = $this->userModel->createPasswordRequest(
					$this->account["id"],
					$token
				);
			
				$passwordRequestId = $db->lastInsertId();

				// Create URL for password script
				$url = PROTOCOL + "{$_SERVER["HTTP_HOST"]}/reset-password";
				$passwordResetLink = "{$url}?uid={$this->account["id"]}&id={$passwordRequestId}&t={$token}";

			// @mail(
			//     $email,
			//     'Password Reset',
			//     "Here is your password reset link: {$passwordResetLink}",
			//     'From: no-reply@laconia.site' . "\r\n" .
			//         'Reply-To: no-reply@laconia.dev' . "\r\n" .
			//         'X-Mailer: PHP/' . phpversion(),
			//     null
			// );

				$this->message = PASSWORD_EMAIL_SENT;

				echo $this->message;
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

		$this->view("forgot-password");
	}
}
