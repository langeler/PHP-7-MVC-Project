<?php

namespace App\Controllers;

use App\Core\Controller as Controller;

class RegisterController extends Controller
{
	protected $pageTitle = "Register";
	protected $message;
	protected $account;
	protected $csrf;

	public function post()
	{
		$post = $this->filter_post();
		$this->session->csrf = $post["csrf"];
		$this->session->validateCSRF();
		
		if ($this->session->validateCSRF()) {
			
			$this->userModel->forename = $post["forename"];
			$this->userModel->surname = $surname = $post["surname"];
			$this->userModel->phone = $post["phone"];		
			$this->userModel->username = $post["username"];
			$this->userModel->password = $post["password"];
			$this->userModel->email = $post["email"];

			// Validate username, password, and email
			$this->userModel->validateNewUser();

			// Show errors if any tests failed
			if (!empty($this->userModel->errors)) {
		
				$this->message = $this->userModel->getErrors($this->errors);

				echo $this->message;
				exit();
			}
		
			else {
			
				// Hash the password
				$this->userModel->hashPassword();
			
				$result = $this->userModel->registerNewUser();

				// User registration successful
				if ($result) {
				
					$this->account = $this->userModel->getUserByUsername();
					$this->session->login($this->account);
				
					$this->redirect("dashboard");
				}
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

		$this->view("register");
	}
}
