<?php

namespace App\Controllers\Auth;

use App\Core\Controller as Controller;
use App\Models\ListClass;

class SettingsController extends Controller
{
	protected $pageTitle;
	protected $pageUrl;
	protected $pageData;

	public function post()
	{
		$post = $this->filter_post();

		// Get user by session value
		$this->userModel->id = $this->session->getSessionValue("user_id");
		$this->userModel->role = $this->session->getSessionValue("role");
		$this->userModel->username = $this->session->getSessionValue(
			"username"
		);

		$this->session->authenticate($this->userModel->id);

		// Set CSRF token to be verified
		$this->session->csrf = $post["csrf"];

		// Verify CSRF token
		if ($this->session->validateCSRF()) {
			$this->userModel->forename = $post["forename"];
			$this->userModel->surname = $post["surname"];
			$this->userModel->phone = $post["phone"];
			$this->userModel->email = $post["email"];

			if ($this->userModel->validateUpdate()) {
				// Update settings
				if ($this->userModel->update()) {
					$this->flash->success("Settings updated successfully.");
					redirect("settings");
				} else {
					$this->flash->error("Unable to process update.");
					redirect("settings");
				}
			} else {
				$errors = $this->userModel->getErrors();
				foreach ($errors as $error) {
					$this->flash->error($error);
				}
				redirect("settings");
			}
		}
	}

	public function get()
	{
		$this->pageTitle = "Settings";
		$this->pageUrl = DOMAIN . "settings";

		// Get user by session value
		$this->userModel->id = $this->session->getSessionValue("user_id");
		$account = $this->userModel->readOne();

		// Set page data with variables
		$this->pageData = [
			"csrf" => $this->session->getSessionValue("csrf"),
			"account" => $account,
		];

		if (!$this->isUserLoggedIn()) {
			redirect("login");
		}

		$this->view("auth/settings", [
			"pageTitle" => $this->pageTitle,
			"pageUrl" => $this->pageUrl,
			"pageData" => $this->pageData,
		]);
	}
}
