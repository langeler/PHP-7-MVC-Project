<?php

namespace App\Controllers\Admin;

use App\Core\Controller;

class adminOptions extends Controller
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

		if ($vars["qid"]) {
			$this->questionModel->id = (int) $vars["qid"];
			$this->optionModel->qid = (int) $vars["qid"];

			$this->pageTitle = "Read All Product Options";
			$this->pageUrl = DOMAIN . "admin/product/options/" . $vars["pid"];

			// Pagination
			$page = isset($get["page"]) ? $get["page"] : 1;

			// Pagination settings
			$perPage = 5;
			$displayArrows = true;
			$fromRecords = $perPage * $page - $perPage;

			$question = $this->questionModel->readOne();
			$records = $this->optionModel->countAll();
			$options = $this->optionModel->readAllWithPaging(
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
				"qid" => $this->optionModel->qid,
				"question" => $question,
				"options" => $options,
				"pagination" => $pagination,
			];

			$this->view("admin/options/read", [
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

		if ($vars["qid"]) {
			$this->questionModel->id = (int) $vars["qid"];
			$this->optionModel->qid = (int) $vars["qid"];

			$this->pageTitle = "Create Product Option";
			$this->pageUrl =
				DOMAIN . "admin/product/option/create/" . $vars["pid"];

			$this->pageData = [
				"qid" => $this->optionModel->qid,
				"csrf" => $this->session->getSessionValue("csrf"),
			];

			$this->view("admin/options/create", [
				"pageTitle" => $this->pageTitle,
				"pageUrl" => $this->pageUrl,
				"pageData" => $this->pageData,
			]);
		}
	}

	// Post create user function
	function createOption($vars = null)
	{
		$this->access();

		if ($vars["qid"]) {
			$this->questionModel->id = (int) $vars["qid"];
			$this->optionModel->qid = (int) $vars["qid"];

			// Filter post fields
			$post = $this->filter_post();

			// Set CSRF token to be verified
			$this->session->csrf = $post["csrf"];

			// Verify CSRF token
			if ($this->session->validateCSRF()) {
				$this->optionModel->name = $post["name"];
				$this->optionModel->description = $post["description"];

				// Validate username, password, and email
				if ($this->optionModel->validateCreate()) {
					// Register new user
					$this->optionModel->create();

					// Redirect to profile
					redirect("admin/products/");
				} else {
					// Set error message
					$this->message = $this->optionModel->errors;

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
			$this->optionModel->id = $vars["id"];

			$this->pageTitle = "Update Product Question";
			$this->pageUrl =
				DOMAIN .
				"admin/product/option/update/" .
				$this->optionModel->id;

			$this->pageData = [
				"option" => $this->optionModel->readOne(),
				"csrf" => $this->session->getSessionValue("csrf"),
			];

			$this->view("admin/options/update", [
				"pageTitle" => $this->pageTitle,
				"pageUrl" => $this->pageUrl,
				"pageData" => $this->pageData,
			]);
		}
	}

	// Post update user function
	function updateOption($vars = null)
	{
		$this->access();
		$post = $this->filter_post();

		if ($vars["id"]) {
			// Set CSRF token to be verified
			$this->session->csrf = $post["csrf"];

			// Verify CSRF token
			if ($this->session->validateCSRF()) {
				$this->optionModel->id = $vars["id"];
				$this->optionModel->name = $post["name"];
				$this->optionModel->description = $post["description"];

				if ($this->optionModel->validateUpdate()) {
					// Update settings
					if ($this->optionModel->update()) {
						// Redirect to profile
						redirect("admin/products/");
					}
				} else {
					// Set error message
					$this->message = $this->optionModel->errors;

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
			$this->optionModel->id = $vars["id"];

			$this->pageTitle = "Delete Product Option";
			$this->pageUrl =
				DOMAIN .
				"admin/product/option/delete/" .
				$this->productModel->id;

			$this->pageData = [
				"id" => $this->optionModel->id,
				"csrf" => $this->session->getSessionValue("csrf"),
			];

			$this->view("admin/options/delete", [
				"pageTitle" => $this->pageTitle,
				"pageUrl" => $this->pageUrl,
				"pageData" => $this->pageData,
			]);
		}
	}

	function deleteOption($vars = null)
	{
		// Check logged in & permission
		$this->access();

		// If an id exist
		if ($vars["id"]) {
			// Set user id to be deleted
			$this->optionModel->id = $vars["id"];

			// Delete user
			$this->optionModel->delete();

			// Redirect to admin/users
			redirect("admin/products/");
		}
	}
}
