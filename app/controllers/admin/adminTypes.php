<?php

namespace App\Controllers\Admin;

use App\Core\Controller;

class adminTypes extends Controller
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

		if ($vars["pid"]) {
			$this->productModel->id = (int) $vars["pid"];
			$this->typeModel->pid = (int) $vars["pid"];

			$this->pageTitle = "Read All Product Types";
			$this->pageUrl = DOMAIN . "admin/product/types/" . $vars["pid"];

			// Pagination
			$page = isset($get["page"]) ? $get["page"] : 1;

			// Pagination settings
			$perPage = 5;
			$displayArrows = true;
			$fromRecords = $perPage * $page - $perPage;

			$product = $this->productModel->readOne();
			$records = $this->typeModel->countAll();
			$types = $this->typeModel->readAllWithPaging(
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
				"pid" => $this->typeModel->pid,
				"types" => $types,
				"types" => $types,
				"pagination" => $pagination,
			];

			$this->view("admin/types/read", [
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

		if ($vars["pid"]) {
			$this->productModel->id = (int) $vars["pid"];
			$this->typeModel->pid = (int) $vars["pid"];

			$this->pageTitle = "Create Product Type";
			$this->pageUrl =
				DOMAIN . "admin/product/type/create/" . $vars["pid"];

			$this->pageData = [
				"pid" => $this->typeModel->pid,
				"csrf" => $this->session->getSessionValue("csrf"),
			];

			$this->view("admin/types/create", [
				"pageTitle" => $this->pageTitle,
				"pageUrl" => $this->pageUrl,
				"pageData" => $this->pageData,
			]);
		}
	}

	// Post create user function
	function createType($vars = null)
	{
		$this->access();

		if ($vars["pid"]) {
			$this->productModel->id = (int) $vars["pid"];
			$this->typeModel->pid = (int) $vars["pid"];

			// Filter post fields
			$post = $this->filter_post();

			// Set CSRF token to be verified
			$this->session->csrf = $post["csrf"];

			// Verify CSRF token
			if ($this->session->validateCSRF()) {
				$this->typeModel->name = $post["name"];
				$this->typeModel->description = $post["description"];
				$this->typeModel->price = $post["price"];
				$this->typeModel->stock = $post["stock"];

				// Validate username, password, and email
				if ($this->typeModel->validateCreate()) {
					// Register new user
					$this->typeModel->create();

					// Redirect to profile
					redirect("admin/products/");
				} else {
					// Set error message
					$this->message = $this->typeModel->errors;

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
			$this->typeModel->id = $vars["id"];

			$this->pageTitle = "Update Product Type";
			$this->pageUrl =
				DOMAIN . "admin/product/type/update/" . $this->typeModel->id;

			$this->pageData = [
				"type" => $this->typeModel->readOne(),
				"csrf" => $this->session->getSessionValue("csrf"),
			];

			$this->view("admin/types/update", [
				"pageTitle" => $this->pageTitle,
				"pageUrl" => $this->pageUrl,
				"pageData" => $this->pageData,
			]);
		}
	}

	// Post update user function
	function updateType($vars = null)
	{
		$this->access();
		$post = $this->filter_post();

		if ($vars["id"]) {
			// Set CSRF token to be verified
			$this->session->csrf = $post["csrf"];

			// Verify CSRF token
			if ($this->session->validateCSRF()) {
				$this->typeModel->id = $vars["id"];
				$this->typeModel->name = $post["name"];
				$this->typeModel->description = $post["description"];
				$this->typeModel->price = $post["price"];
				$this->typeModel->stock = $post["stock"];

				if ($this->typeModel->validateUpdate()) {
					// Update settings
					if ($this->typeModel->update()) {
						// Redirect to profile
						redirect("admin/products/");
					}
				} else {
					// Set error message
					$this->message = $this->typeModel->errors;

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
			$this->typeModel->id = $vars["id"];

			$this->pageTitle = "Delete Product Type";
			$this->pageUrl =
				DOMAIN . "admin/product/type/delete/" . $this->productModel->id;

			$this->pageData = [
				"id" => $this->typeModel->id,
				"csrf" => $this->session->getSessionValue("csrf"),
			];

			$this->view("admin/types/delete", [
				"pageTitle" => $this->pageTitle,
				"pageUrl" => $this->pageUrl,
				"pageData" => $this->pageData,
			]);
		}
	}

	function deleteType($vars = null)
	{
		// Check logged in & permission
		$this->access();

		// If an id exist
		if ($vars["id"]) {
			// Set user id to be deleted
			$this->typeModel->id = $vars["id"];

			// Delete user
			$this->typeModel->delete();

			// Redirect to admin/users
			redirect("admin/products/");
		}
	}
}
