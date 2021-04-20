<?php

namespace App\Controllers\Auth;

use App\Core\Controller as Controller;
use App\Models\ListClass;

class SettingsController extends Controller
{
	protected $pageTitle = "Settings";
	protected $message;
	protected $account;
	protected $csrf;

	public function post()
	{
		$post = $this->filter_post();

		// Get user by session value
		$this->userModel->id = $this->session->getSessionValue("user_id");
		$this->session->authenticate($this->userModel->id);
		
		// Set CSRF token to be verified
		$this->session->csrf = $post["csrf"];
		
		// Verify CSRF token
		if ($this->session->validateCSRF()) {
		
			$this->userModel->forename = $this->clean($post['forename']);
			$this->userModel->surname = $this->clean($post['surname']);
			$this->userModel->phone = $this->clean($post['phone']);
			$this->userModel->email = $this->clean($post['email']);
			$this->userModel->role = DEFAULT_ROLE // Default role definied
			
			if ($this->userModel->validateUpdate()) {
	
				// Update settings
				if ($this->userModel->update()) {
					// Redirect to profile
					$this->redirect("profile");	
				}
			}
			
			else {
				// Set error message
				$this->message = $this->userModel->getErrors($this->errors);

				echo $this->message;
				exit();	
			}
		}
	}

	public function get()
	{
		$this->userModel->id = $this->session->getSessionValue("user_id");
		$this->session->authenticate($this->userModel->id);
		$this->csrf = $this->session->getSessionValue("csrf");

		// Get user by session value
		$this->account = $this->userModel->readOne();

		$this->view("settings");
	}
}
