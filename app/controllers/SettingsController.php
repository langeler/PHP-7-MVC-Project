<?php

namespace App\Controllers;

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
		$this->session->csrf = $post["csrf"];
		$this->session->validateCSRF();
		
		if ($this->session->validateCSRF()) {
			
			if (isset($post["delete_user"])) {
			
				$this->userModel->deleteUser();
			
				$this->session->logout();

				$this->message = USER_DELETED;

				echo $this->message;
				exit();
			}
		
			$this->userModel->forename = $post['forename'];
			$this->userModel->surname = $post['surname'];
			$this->userModel->phone = $post['phone'];
			$this->userModel->email = $post['email'];
				
			$this->userModel->validateUserSettings();
		
			// Show errors if any tests failed
			if (!empty($this->userModel->errors)) {
			
				$this->message = $this->userModel->getErrors($this->errors);

				echo $this->message;
				exit();
			}
			
			else {
				
				// Update settings
				$this->userModel->updateUserSettings();
				
				// Get new user data
				$this->account = $this->userModel->getUser();
			
				$this->redirect("dashboard");
			}
		}
	}

	public function get()
	{
		$this->userModel->id = $this->session->getSessionValue("user_id");
		$this->session->authenticate($this->userModel->id);
		$this->csrf = $this->session->getSessionValue("csrf");

		// Get user by session value
		$this->account = $this->userModel->getUser();

		$this->view("settings");
	}
}
