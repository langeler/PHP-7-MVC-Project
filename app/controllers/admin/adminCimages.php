<?php

namespace App\Controllers\Admin;

use App\Core\Controller;

class adminCimages extends Controller
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

		if ($vars["cid"]) {
			$this->categoryModel->id = (int) $vars["cid"];
			$this->cImageModel->cid = (int) $vars["cid"];

			$this->pageTitle = "Read All Category Images";
			$this->pageUrl = DOMAIN . "admin/category/images/" . $vars["pid"];

			// Pagination
			$page = isset($get["page"]) ? $get["page"] : 1;

			// Pagination settings
			$perPage = 3;
			$displayArrows = true;
			$fromRecords = $perPage * $page - $perPage;

			$product = $this->categoryModel->readOne();
			$records = $this->cImageModel->countAll();
			$images = $this->cImageModel->readAllWithPaging(
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
				"cid" => $this->cImageModel->cid,
				"images" => $images,
				"pagination" => $pagination,
			];

			$this->view("admin/cimages/read", [
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

		if ($vars["cid"]) {
			$this->categoryModel->id = (int) $vars["cid"];
			$this->cImageModel->cid = (int) $vars["cid"];

			$this->pageTitle = "Create Category Image";
			$this->pageUrl =
				DOMAIN . "admin/category/image/create/" . $vars["pid"];

			$this->pageData = [
				"cid" => $this->cImageModel->cid,
				"csrf" => $this->session->getSessionValue("csrf"),
			];

			$this->view("admin/cimages/create", [
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
			$this->categoryModel->id = (int) $vars["cid"];
			$this->cImageModel->cid = (int) $vars["cid"];

			// Filter post fields
			$post = $this->filter_post();

			// Set CSRF token to be verified
			$this->session->csrf = $post["csrf"];

			// Verify CSRF token
			if ($this->session->validateCSRF()) {
				$this->cImageModel->description = $post["description"];

				// Register new user
				if ($this->cImageModel->upload()) {
					// Redirect to profile
					redirect("admin/products/");
				} else {
					// Set error message
					$this->message = $this->cImageModel->errors;

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
			$this->cImageModel->id = $vars["id"];

			$this->pageTitle = "Update Category Image";
			$this->pageUrl =
				DOMAIN .
				"admin/category/image/update/" .
				$this->cImageModel->id;

			$this->pageData = [
				"image" => $this->cImageModel->readOne(),
				"csrf" => $this->session->getSessionValue("csrf"),
			];

			$this->view("admin/cimages/update", [
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
				$this->cImageModel->id = $vars["id"];
				$this->cImageModel->description = $post["description"];

				if ($this->cImageModel->validateUpdate()) {
					// Update settings
					if ($this->cImageModel->update()) {
						// Redirect to profile
						redirect("admin/products/");
					}
				} else {
					// Set error message
					$this->message = $this->cImageModel->errors;

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
			$this->cImageModel->id = $vars["id"];
			$image = $this->cImageModel->readOne();

			$this->pageTitle = "Delete Category Image";
			$this->pageUrl =
				DOMAIN .
				"admin/category/image/delete/" .
				$this->cImageModel->id;

			$this->pageData = [
				"id" => $this->cImageModel->id,
				"csrf" => $this->session->getSessionValue("csrf"),
			];

			$this->view("admin/cimages/delete", [
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
			$this->cImageModel->id = $vars["id"];
			$image = $this->cImageModel->readOne();

			$this->cImageModel->cid = $image["category_id"];
			$this->cImageModel->name = $image["name"];

			if ($this->cImageModel->remove()) {
				// Delete user
				$this->cImageModel->delete();

				// Redirect to admin/users
				redirect("admin/products/");
			}
		}
	}
}
