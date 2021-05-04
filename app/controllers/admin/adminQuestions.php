<?php

namespace App\Controllers\Admin;

use App\Core\Controller;

class adminQuestions extends Controller
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

	function index($vars = null)
	{
		$this->access();
		$get = $this->filter_get();
		if ($vars["tid"]) {
			$this->typeModel->id = (int) $vars["tid"];
			$this->questionModel->tid = (int) $vars["tid"];

			$this->pageTitle = "Read All Product Questions";
			$this->pageUrl = DOMAIN . "admin/product/questions/" . $vars["tid"];

			// Pagination
			$page = isset($get["page"]) ? $get["page"] : 1;

			// Pagination settings
			$perPage = 5;
			$displayArrows = true;
			$fromRecords = $perPage * $page - $perPage;

			$type = $this->typeModel->readOne();
			$records = $this->questionModel->countAll();
			$questions = $this->questionModel->readAllWithPaging(
				$fromRecords,
				$perPage
			);

			// Pagination variable
			$pagination = $this->pagination->paging(
				$records,
				$this->pageUrl,
				$page,
				$perPage,
				$displayArrows
			);

			$this->pageData = [
				"tid" => $this->questionModel->tid,
				"type" => $type,
				"questions" => $questions,
				"pagination" => $pagination,
			];

			$this->view("admin/questions/read", [
				"pageTitle" => $this->pageTitle,
				"pageUrl" => $this->pageUrl,
				"pageData" => $this->pageData,
			]);
		}
	}

	// Get create user view
	function create($vars = null)
	{
		$this->access();

		if ($vars["tid"]) {
			$this->typeModel->id = (int) $vars["tid"];
			$this->questionModel->tid = (int) $vars["tid"];

			$this->pageTitle = "Create Product Question";
			$this->pageUrl =
				DOMAIN . "admin/product/question/create/" . $vars["pid"];

			$this->pageData = [
				"tid" => $this->questionModel->tid,
				"csrf" => $this->session->getSessionValue("csrf"),
			];

			$this->view("admin/questions/create", [
				"pageTitle" => $this->pageTitle,
				"pageUrl" => $this->pageUrl,
				"pageData" => $this->pageData,
			]);
		}
	}

	// Post create user function
	function createQuestion($vars = null)
	{
		$this->access();

		if ($vars["tid"]) {
			$this->typeModel->id = (int) $vars["tid"];
			$this->questionModel->tid = (int) $vars["tid"];

			// Filter post fields
			$post = $this->filter_post();

			// Set CSRF token to be verified
			$this->session->csrf = $post["csrf"];

			// Verify CSRF token
			if ($this->session->validateCSRF()) {
				$this->questionModel->name = $post["name"];
				$this->questionModel->description = $post["description"];

				// Validate username, password, and email
				if ($this->questionModel->validateCreate()) {
					// Register new user
					$this->questionModel->create();

					// Redirect to profile
					redirect("admin/products/");
				} else {
					// Set error message
					$this->message = $this->questionModel->errors;

					echo $this->message;
					exit();
				}
			}
		}
	}

	function update($vars = null)
	{
		$this->access();

		if ($vars["id"]) {
			$this->questionModel->id = $vars["id"];

			$this->pageTitle = "Update Product Question";
			$this->pageUrl =
				DOMAIN .
				"admin/product/question/update/" .
				$this->questionModel->id;

			$this->pageData = [
				"question" => $this->questionModel->readOne(),
				"csrf" => $this->session->getSessionValue("csrf"),
			];

			$this->view("admin/questions/update", [
				"pageTitle" => $this->pageTitle,
				"pageUrl" => $this->pageUrl,
				"pageData" => $this->pageData,
			]);
		}
	}

	// Post update user function
	function updateQuestion($vars = null)
	{
		$this->access();
		$post = $this->filter_post();

		if ($vars["id"]) {
			// Set CSRF token to be verified
			$this->session->csrf = $post["csrf"];

			// Verify CSRF token
			if ($this->session->validateCSRF()) {
				$this->questionModel->id = $vars["id"];
				$this->questionModel->name = $post["name"];
				$this->questionModel->description = $post["description"];

				if ($this->questionModel->validateUpdate()) {
					// Update settings
					if ($this->questionModel->update()) {
						// Redirect to profile
						redirect("admin/products/");
					}
				} else {
					// Set error message
					$this->message = $this->questionModel->errors;

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
			$this->questionModel->id = $vars["id"];

			$this->pageTitle = "Delete Product Type";
			$this->pageUrl =
				DOMAIN .
				"admin/product/question/delete/" .
				$this->productModel->id;

			$this->pageData = [
				"id" => $this->questionModel->id,
				"csrf" => $this->session->getSessionValue("csrf"),
			];

			$this->view("admin/questions/delete", [
				"pageTitle" => $this->pageTitle,
				"pageUrl" => $this->pageUrl,
				"pageData" => $this->pageData,
			]);
		}
	}

	function deleteQuestion($vars = null)
	{
		// Check logged in & permission
		$this->access();

		// If an id exist
		if ($vars["id"]) {
			// Set user id to be deleted
			$this->questionModel->id = $vars["id"];

			// Delete user
			$this->questionModel->delete();

			// Redirect to admin/users
			redirect("admin/products/");
		}
	}
}
