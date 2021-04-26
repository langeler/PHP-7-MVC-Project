<?php

namespace App\Controllers\Auth;

use App\Core\Controller as Controller;

class RegisterController extends Controller
{
	protected $pageTitle = "Register";
	protected $message;
	protected $account;
	protected $csrf;

	public function post()
	{
		// Filter post fields
		$post = $this->filter_post();
		
		// Set CSRF token to be verified
		$this->session->csrf = $post["csrf"];

		// Verify CSRF token
		if ($this->session->validateCSRF()) {
			
			$this->userModel->forename = $this->clean($post["forename"]);
			$this->userModel->surname = $this->clean($surname = $post["surname"]);
			$this->userModel->phone = $this->clean($post["phone"]);		
			$this->userModel->email = $this->clean($post["email"]);
			$this->userModel->username = $this->clean($post["username"]);
			$this->userModel->password = $this->clean($post["password"]);
			$this->userModel->cpassword = $this->clean($post["cpassword"]);
			$this->userModel->role = DEFAULT_ROLE; // Default role definied
			
			// Validate username, password, and email
			if ($this->userModel->validateCreate()) {
				
				// Register new user
				$this->userModel->create();
			
				// Redirect to profile
				$this->redirect('login');
			}
			
			else {
				// Set error message
				$this->message = $this->userModel->errors;

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

		$this->view("auth/register");
	}
}
