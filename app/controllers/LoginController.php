<?php

namespace App\Controllers;

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
			
			$this->userModel->username = $post["username"];
			$this->userModel->password = $post["password"];
						
			// Retrieve the user account information for the given username
			$this->account = $this->userModel->getUserByUsername();

			// Could not find a user with that username
			if (!$this->account) {
		
				$this->message = USERNAME_NOT_EXISTS;

				echo $this->message;
				exit();
			}
			
			else {
							
				$this->userModel->passwordHash = $this->account["password"];
				
				if ($this->userModel->verifyPassword()) {
					
					// User login
					$this->session->login($this->account);

					$this->redirect("dashboard");
				}
				
				else {
				
					$this->message = LOGIN_FAIL;
					
					echo $this->message;
					exit();
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

		$this->view("login");
	}
}
