<?php

namespace App\Controllers\Admin;

use App\Core\Controller;

class adminImages extends Controller
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

	function index($vars = null)
	{
		$this->access();
		$get = $this->filter_get();

		if ($vars["pid"]) {
			$this->productModel->id = (int) $vars["pid"];
			$this->imageModel->pid = (int) $vars["pid"];

			$this->pageTitle = "Read All Product Images";
			$this->pageUrl = DOMAIN . "admin/product/images/" . $vars["pid"];

			// Pagination
			$page = isset($get["page"]) ? $get["page"] : 1;

			// Pagination settings
			$perPage = 3;
			$displayArrows = true;
			$fromRecords = $perPage * $page - $perPage;

			$product = $this->productModel->readOne();
			$records = $this->imageModel->countAll();
			$images = $this->imageModel->readAllWithPaging(
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
				"pid" => $this->imageModel->pid,
				"images" => $images,
				"pagination" => $pagination,
			];

			$this->view("admin/images/read", [
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
			$this->imageModel->pid = (int) $vars["pid"];

			$this->pageTitle = "Create Image";
			$this->pageUrl =
				DOMAIN . "admin/product/image/create/" . $vars["pid"];

			$this->pageData = [
				"pid" => $this->imageModel->pid,
				"csrf" => $this->session->getSessionValue("csrf"),
			];

			$this->view("admin/images/create", [
				"pageTitle" => $this->pageTitle,
				"pageUrl" => $this->pageUrl,
				"pageData" => $this->pageData,
			]);
		}
	}

	// Post create user function
	function createImage($vars = null)
	{
		$this->access();

		if ($vars["pid"]) {
			$this->productModel->id = (int) $vars["pid"];
			$this->imageModel->pid = (int) $vars["pid"];

			// Filter post fields
			$post = $this->filter_post();

			// Set CSRF token to be verified
			$this->session->csrf = $post["csrf"];

			// Verify CSRF token
			if ($this->session->validateCSRF()) {
				$this->imageModel->description = $this->clean(
					$surname = $post["description"]
				);

				// Register new user
				if ($this->imageModel->upload()) {
					// Redirect to profile
					$this->redirect("admin/products/");
				} else {
					// Set error message
					$this->message = $this->imageModel->errors;

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
			$this->imageModel->id = $vars["id"];

			$this->pageTitle = "Update Product Image";
			$this->pageUrl =
				DOMAIN . "admin/product/image/update/" . $this->imageModel->id;

			$this->pageData = [
				"image" => $this->imageModel->readOne(),
				"csrf" => $this->session->getSessionValue("csrf"),
			];

			$this->view("admin/images/update", [
				"pageTitle" => $this->pageTitle,
				"pageUrl" => $this->pageUrl,
				"pageData" => $this->pageData,
			]);
		}
	}

	// Post update user function
	function updateImage($vars = null)
	{
		$this->access();
		$post = $this->filter_post();

		if ($vars["id"]) {
			// Set CSRF token to be verified
			$this->session->csrf = $post["csrf"];

			// Verify CSRF token
			if ($this->session->validateCSRF()) {
				$this->imageModel->id = $vars["id"];
				$this->imageModel->description = $this->clean(
					$post["description"]
				);

				if ($this->imageModel->validateUpdate()) {
					// Update settings
					if ($this->imageModel->update()) {
						// Redirect to profile
						$this->redirect("admin/products/");
					}
				} else {
					// Set error message
					$this->message = $this->imageModel->errors;

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
			$this->imageModel->id = $vars["id"];
			$image = $this->imageModel->readOne();

			$this->pageTitle = "Delete Product Image";
			$this->pageUrl =
				DOMAIN . "admin/product/image/delete/" . $this->imageModel->id;

			$this->pageData = [
				"id" => $this->imageModel->id,
				"csrf" => $this->session->getSessionValue("csrf"),
			];

			$this->view("admin/images/delete", [
				"pageTitle" => $this->pageTitle,
				"pageUrl" => $this->pageUrl,
				"pageData" => $this->pageData,
			]);
		}
	}

	function deleteImage($vars = null)
	{
		// Check logged in & permission
		$this->access();

		// If an id exist
		if ($vars["id"]) {
			// Set user id to be deleted
			$this->imageModel->id = $vars["id"];
			$image = $this->imageModel->readOne();

			$this->imageModel->pid = $image["product_id"];
			$this->imageModel->name = $image["name"];

			if ($this->imageModel->remove()) {
				// Delete user
				$this->imageModel->delete();

				// Redirect to admin/users
				$this->redirect("admin/products/");
			}
		}
	}
}
