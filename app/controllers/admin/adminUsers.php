<?php

namespace App\Controllers\Admin;

use App\Core\Controller;

class adminUsers extends Controller
{
	protected $pageTitle;
	protected $pageUrl;
	protected $pageData;
	protected $message;
	protected $csrf;

	function access()
	{
		$isLoggedIn = $this->session->isUserLoggedIn();
		$role = $this->session->getSessionValue("role");

		//var_dump($isLoggedIn);
		//var_dump($this->role);
		//exit;

		if ($isLoggedIn && $role == "admin") {
			return true;
		} else {
			redirect("");
			exit();
		}
	}

	function index()
	{
		$this->access();
		$get = $this->filter_get();

		$this->pageTitle = "Read All User";
		$this->pageUrl = DOMAIN . "admin/users/";

		// Pagination
		$page = isset($get["page"]) ? $get["page"] : 1;
		$search = isset($get["search"]) ? $get["search"] : "";

		// Pagination settings
		$perPage = 10;
		$displayArrows = true;
		$fromRecords = $perPage * $page - $perPage;

		// If a search is made
		if ($search) {
			$records = $this->userModel->countAllBySearch($search);
			$accounts = $this->userModel->searchWithPaging(
				$search,
				$fromRecords,
				$perPage
			);
		}

		// If no search is made
		else {
			$records = $this->userModel->countAll();
			$accounts = $this->userModel->readAllWithPaging(
				$fromRecords,
				$perPage
			);
		}

		// Pagination variable
		$pagination = $this->pagination->paging(
			$records,
			$this->pageUrl,
			$page,
			$perPage,
			$displayArrows
		);

		$this->pageData = [
			"search" => $search,
			"accounts" => $accounts,
			"pagination" => $pagination,
		];

		$this->view("admin/users/read", [
			"pageTitle" => $this->pageTitle,
			"pageUrl" => $this->pageUrl,
			"pageData" => $this->pageData,
		]);
	}

	// Get create user view
	function create()
	{
		$this->access();
		$this->pageTitle = "Create User";
		$this->pageUrl = DOMAIN . "admin/user/create/";

		$this->pageData = [
			"csrf" => $this->session->getSessionValue("csrf"),
			"roles" => ["user", "admin"],
		];

		$this->view("admin/users/create", [
			"pageTitle" => $this->pageTitle,
			"pageUrl" => $this->pageUrl,
			"pageData" => $this->pageData,
		]);
	}

	// Post create user function
	function createUser()
	{
		$this->access();

		// Filter post fields
		$post = $this->filter_post();

		// Set CSRF token to be verified
		$this->session->csrf = $post["csrf"];

		// Verify CSRF token
		if ($this->session->validateCSRF()) {
			$this->userModel->forename = $post["forename"];
			$this->userModel->surname = $post["surname"];
			$this->userModel->phone = $post["phone"];
			$this->userModel->email = $post["email"];
			$this->userModel->username = $post["username"];
			$this->userModel->password = $post["password"];
			$this->userModel->cpassword = $post["cpassword"];
			$this->userModel->role = $post["role"];

			// Validate username, password, and email
			if ($this->userModel->validateCreate()) {
				// Register new user
				$this->userModel->create();

				// Redirect to profile
				redirect("admin/users/");
			} else {
				// Set error message
				$this->message = $this->userModel->errors;

				echo $this->message;
				exit();
			}
		}
	}

	function update($vars = null)
	{
		$this->access();

		if ($vars["id"]) {
			$this->userModel->id = $vars["id"];

			$this->pageTitle = "Update User";
			$this->pageUrl =
				DOMAIN . "admin/user/update/" . $this->userModel->id;

			$this->pageData = [
				"account" => $this->userModel->readOne(),
				"csrf" => $this->session->getSessionValue("csrf"),
				"roles" => ["user", "admin"],
			];

			$this->view("admin/users/update", [
				"pageTitle" => $this->pageTitle,
				"pageUrl" => $this->pageUrl,
				"pageData" => $this->pageData,
			]);
		}
	}

	// Post update user function
	function updateUser($vars = null)
	{
		$this->access();
		$post = $this->filter_post();

		if ($vars["id"]) {
			$this->userModel->id = $vars["id"];

			// Set CSRF token to be verified
			$this->session->csrf = $post["csrf"];

			// Verify CSRF token
			if ($this->session->validateCSRF()) {
				$this->userModel->forename = $post["forename"];
				$this->userModel->surname = $post["surname"];
				$this->userModel->phone = $post["phone"];
				$this->userModel->email = $post["email"];
				$this->userModel->role = $post["role"];

				if ($this->userModel->validateUpdate()) {
					// Update settings
					if ($this->userModel->update()) {
						// Redirect to profile
						redirect("admin/users/");
					}
				} else {
					// Set error message
					$this->message = $this->userModel->getErrors($this->errors);

					echo $this->message;
					exit();
				}
			}
		}
	}

	function delete($vars = null)
	{
		$this->access();

		if ($vars["id"]) {
			$this->userModel->id = $vars["id"];

			$this->pageTitle = "Delete User";
			$this->pageUrl =
				DOMAIN . "admin/user/delete/" . $this->userModel->id;

			$this->pageData = [
				"id" => $this->userModel->id,
				"csrf" => $this->session->getSessionValue("csrf"),
			];

			$this->view("admin/users/delete", [
				"pageTitle" => $this->pageTitle,
				"pageUrl" => $this->pageUrl,
				"pageData" => $this->pageData,
			]);
		}
	}

	function deleteUser($vars = null)
	{
		// Check logged in & permission
		$this->access();

		// If an id exist
		if ($vars["id"]) {
			// Set user id to be deleted
			$this->userModel->id = $vars["id"];

			// Delete user
			$this->userModel->delete();

			// Redirect to admin/users
			redirect("admin/users/");
		}
	}
}
