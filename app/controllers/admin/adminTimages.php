<?php

namespace App\Controllers\Admin;

use App\Core\Controller;

class adminTimages extends Controller
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
			$this->productModel->id = (int) $vars["tid"];
			$this->tImageModel->tid = (int) $vars["tid"];

			$this->pageTitle = "Read All Type Images";
			$this->pageUrl = DOMAIN . "admin/type/images/" . $vars["pid"];

			// Pagination
			$page = isset($get["page"]) ? $get["page"] : 1;

			// Pagination settings
			$perPage = 5;
			$displayArrows = true;
			$fromRecords = $perPage * $page - $perPage;

			$product = $this->productModel->readOne();
			$records = $this->tImageModel->countAll();
			$images = $this->tImageModel->readAllWithPaging(
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
				"tid" => $this->tImageModel->tid,
				"images" => $images,
				"pagination" => $pagination,
			];

			$this->view("admin/timages/read", [
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
			$this->productModel->id = (int) $vars["tid"];
			$this->tImageModel->tid = (int) $vars["tid"];

			$this->pageTitle = "Create Type Image";
			$this->pageUrl = DOMAIN . "admin/type/image/create/" . $vars["pid"];

			$this->pageData = [
				"pid" => $this->tImageModel->pid,
				"csrf" => $this->session->getSessionValue("csrf"),
			];

			$this->view("admin/timages/create", [
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

		if ($vars["tid"]) {
			$this->productModel->id = (int) $vars["tid"];
			$this->tImageModel->tid = (int) $vars["tid"];

			// Filter post fields
			$post = $this->filter_post();

			// Set CSRF token to be verified
			$this->session->csrf = $post["csrf"];

			// Verify CSRF token
			if ($this->session->validateCSRF()) {
				$this->tImageModel->description = $post["description"];

				// Register new user
				if ($this->tImageModel->upload()) {
					// Redirect to profile
					redirect("admin/products/");
				} else {
					// Set error message
					$this->message = $this->tImageModel->errors;

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
			$this->tImageModel->id = $vars["id"];

			$this->pageTitle = "Update Type Image";
			$this->pageUrl =
				DOMAIN . "admin/type/image/update/" . $this->tImageModel->id;

			$this->pageData = [
				"image" => $this->tImageModel->readOne(),
				"csrf" => $this->session->getSessionValue("csrf"),
			];

			$this->view("admin/timages/update", [
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
				$this->tImageModel->id = $vars["id"];
				$this->tImageModel->description = $post["description"];

				if ($this->tImageModel->validateUpdate()) {
					// Update settings
					if ($this->tImageModel->update()) {
						// Redirect to profile
						redirect("admin/products/");
					}
				} else {
					// Set error message
					$this->message = $this->tImageModel->errors;

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
			$this->tImageModel->id = $vars["id"];
			$image = $this->tImageModel->readOne();

			$this->pageTitle = "Delete Type Image";
			$this->pageUrl =
				DOMAIN . "admin/type/image/delete/" . $this->tImageModel->id;

			$this->pageData = [
				"id" => $this->tImageModel->id,
				"csrf" => $this->session->getSessionValue("csrf"),
			];

			$this->view("admin/timages/delete", [
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
			$this->tImageModel->id = $vars["id"];
			$image = $this->tImageModel->readOne();

			$this->tImageModel->tid = $image["type_id"];
			$this->tImageModel->name = $image["name"];

			if ($this->tImageModel->remove()) {
				// Delete user
				$this->tImageModel->delete();

				// Redirect to admin/users
				redirect("admin/products/");
			}
		}
	}
}
