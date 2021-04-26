<?php

namespace App\Controllers\Admin;

use App\Core\Controller;

class adminProducts extends Controller
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
			$this->redirect("");
			exit();
		}
	}

	function index()
	{
		$this->access();
		$get = $this->filter_get();

		$this->pageTitle = "Read All Products";
		$this->pageUrl = DOMAIN . "admin/products/";

		// Pagination
		$page = isset($get["page"]) ? $get["page"] : 1;
		$search = isset($get["search"]) ? $get["search"] : "";

		// Pagination settings
		$perPage = 3;
		$displayArrows = true;
		$fromRecords = $perPage * $page - $perPage;

		// If a search is made
		if ($search) {
			$records = $this->productModel->countAllBySearch($search);
			$products = $this->productModel->searchWithPaging(
				$search,
				$fromRecords,
				$perPage
			);
		}

		// If no search is made
		else {
			$records = $this->productModel->countAll();
			$products = $this->productModel->readAllWithPaging(
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
			"products" => $products,
			"pagination" => $pagination,
		];

		$this->view("admin/products/read", [
			"pageTitle" => $this->pageTitle,
			"pageUrl" => $this->pageUrl,
			"pageData" => $this->pageData,
		]);
	}

	// Get create user view
	function create()
	{
		$this->access();
		$this->pageTitle = "Create Product";
		$this->pageUrl = DOMAIN . "admin/product/create/";

		$this->pageData = [
			"csrf" => $this->session->getSessionValue("csrf"),
			"categories" => $this->categoryModel->readAll(),
			"status" => [
				"active" => "1",
				"inactive" => "0",
			],
		];

		$this->view("admin/products/create", [
			"pageTitle" => $this->pageTitle,
			"pageUrl" => $this->pageUrl,
			"pageData" => $this->pageData,
		]);
	}

	// Post create user function
	function createProduct()
	{
		$this->access();

		// Filter post fields
		$post = $this->filter_post();

		// Set CSRF token to be verified
		$this->session->csrf = $post["csrf"];

		// Verify CSRF token
		if ($this->session->validateCSRF()) {
			$this->productModel->name = $this->clean($post["name"]);
			$this->productModel->description = $this->clean(
				$surname = $post["description"]
			);
			$this->productModel->cid = $this->clean($post["category"]);
			$this->productModel->status = $this->clean($post["status"]);

			// Validate username, password, and email
			if ($this->productModel->validateCreate()) {
				// Register new user
				$this->productModel->create();

				// Redirect to profile
				$this->redirect("admin/products/");
			} else {
				// Set error message
				$this->message = $this->productModel->errors;

				echo $this->message;
				exit();
			}
		}
	}

	function update($vars = null)
	{
		$this->access();

		if ($vars["id"]) {
			$this->productModel->id = $vars["id"];

			$this->pageTitle = "Update Product";
			$this->pageUrl =
				DOMAIN . "admin/product/update/" . $this->productModel->id;

			$this->pageData = [
				"product" => $this->productModel->readOne(),
				"csrf" => $this->session->getSessionValue("csrf"),
				"categories" => $this->categoryModel->readAll(),
				"status" => [
					"active" => "1",
					"inactive" => "0",
				],
			];

			$this->view("admin/products/update", [
				"pageTitle" => $this->pageTitle,
				"pageUrl" => $this->pageUrl,
				"pageData" => $this->pageData,
			]);
		}
	}

	// Post update user function
	function updateProduct($vars = null)
	{
		$this->access();
		$post = $this->filter_post();

		if ($vars["id"]) {
			// Set CSRF token to be verified
			$this->session->csrf = $post["csrf"];

			// Verify CSRF token
			if ($this->session->validateCSRF()) {
				$this->productModel->id = $vars["id"];
				$this->productModel->name = $this->clean($post["name"]);
				$this->productModel->description = $this->clean(
					$post["description"]
				);
				$this->productModel->cid = $this->clean($post["category"]);
				$this->productModel->status = $this->clean($post["status"]);

				if ($this->productModel->validateUpdate()) {
					// Update settings
					if ($this->productModel->update()) {
						// Redirect to profile
						$this->redirect("admin/products/");
					}
				} else {
					// Set error message
					$this->message = $this->productModel->getErrors(
						$this->errors
					);

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
			$this->productModel->id = $vars["id"];

			$this->pageTitle = "Delete Product";
			$this->pageUrl =
				DOMAIN . "admin/product/delete/" . $this->productModel->id;

			$this->pageData = [
				"id" => $this->productModel->id,
				"csrf" => $this->session->getSessionValue("csrf"),
			];

			$this->view("admin/products/delete", [
				"pageTitle" => $this->pageTitle,
				"pageUrl" => $this->pageUrl,
				"pageData" => $this->pageData,
			]);
		}
	}

	function deleteProduct($vars = null)
	{
		// Check logged in & permission
		$this->access();

		// If an id exist
		if ($vars["id"]) {
			// Set user id to be deleted
			$this->productModel->id = $vars["id"];

			// Delete user
			$this->productModel->delete();

			// Redirect to admin/users
			$this->redirect("admin/products/");
		}
	}
}
