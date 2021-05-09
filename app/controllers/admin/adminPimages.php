<?php

namespace App\Controllers\Admin;

use App\Core\Controller;

class adminPimages extends Controller
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
			$this->pImageModel->pid = (int) $vars["pid"];

			$this->pageTitle = "Read All Product Images";
			$this->pageUrl = DOMAIN . "admin/product/images/" . $vars["pid"];

			// Pagination
			$page = isset($get["page"]) ? $get["page"] : 1;

			// Pagination settings
			$perPage = 5;
			$displayArrows = true;
			$fromRecords = $perPage * $page - $perPage;

			$product = $this->productModel->readOne();
			$records = $this->pImageModel->countAll();
			$images = $this->pImageModel->readAllWithPaging(
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
				"pid" => $this->pImageModel->pid,
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
			$this->pImageModel->pid = (int) $vars["pid"];

			$this->pageTitle = "Create Image";
			$this->pageUrl =
				DOMAIN . "admin/product/image/create/" . $vars["pid"];

			$this->pageData = [
				"pid" => $this->pImageModel->pid,
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
			$this->pImageModel->pid = (int) $vars["pid"];

			// Filter post fields
			$post = $this->filter_post();

			// Set CSRF token to be verified
			$this->session->csrf = $post["csrf"];

			// Verify CSRF token
			if ($this->session->validateCSRF()) {
				$this->pImageModel->description = $post["description"];

				// Register new user
				if ($this->pImageModel->upload()) {
					// Redirect to profile
					redirect("admin/products/");
				} else {
					// Set error message
					$this->message = $this->pImageModel->errors;

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
			$this->pImageModel->id = $vars["id"];

			$this->pageTitle = "Update Product Image";
			$this->pageUrl =
				DOMAIN . "admin/product/image/update/" . $this->pImageModel->id;

			$this->pageData = [
				"image" => $this->pImageModel->readOne(),
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
				$this->pImageModel->id = $vars["id"];
				$this->pImageModel->description = $post["description"];

				if ($this->pImageModel->validateUpdate()) {
					// Update settings
					if ($this->pImageModel->update()) {
						// Redirect to profile
						redirect("admin/products/");
					}
				} else {
					// Set error message
					$this->message = $this->pImageModel->errors;

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
			$this->pImageModel->id = $vars["id"];
			$image = $this->pImageModel->readOne();

			$this->pageTitle = "Delete Product Image";
			$this->pageUrl =
				DOMAIN . "admin/product/image/delete/" . $this->pImageModel->id;

			$this->pageData = [
				"id" => $this->pImageModel->id,
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
			$this->pImageModel->id = $vars["id"];
			$image = $this->pImageModel->readOne();

			$this->pImageModel->pid = $image["product_id"];
			$this->pImageModel->name = $image["name"];

			if ($this->pImageModel->remove()) {
				// Delete user
				$this->pImageModel->delete();

				// Redirect to admin/users
				redirect("admin/products/");
			}
		}
	}
}
