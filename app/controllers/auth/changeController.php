<?php

namespace App\Controllers\Auth;

use App\Core\Controller as Controller;
use App\Models\ListClass;

class changeController extends Controller
{
	protected $pageTitle;
	protected $pageUrl;
	protected $pageData;

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
			$this->userModel->password = $post["password"];
			$this->userModel->npassword = $post["npassword"];
			$this->userModel->cpassword = $post["cpassword"];

			if ($this->userModel->validateChange()) {
				// Update settings
				if ($this->userModel->updatePassword()) {
					$this->flash->success(
						"Password have successfully been changed."
					);
					redirect("change");
				} else {
					$this->flash->error("Unable to update password.");
					redirect("change");
				}
			} else {
				$errors = $this->userModel->getErrors();
				foreach ($errors as $error) {
					$this->flash->error($error);
				}
				redirect("change");
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
		];

		if (!$this->isUserLoggedIn()) {
			redirect("login");
		}

		$this->view("auth/change", [
			"pageTitle" => $this->pageTitle,
			"pageUrl" => $this->pageUrl,
			"pageData" => $this->pageData,
		]);
	}
}
