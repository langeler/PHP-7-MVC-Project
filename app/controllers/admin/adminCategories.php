<?php

namespace App\Controllers\Admin;

use App\Core\Controller;

class adminCategories extends Controller
{
	protected $pageTitle;
	protected $pageUrl;
	protected $pageData;
	protected $message;
	protected $csrf;
	
	function access() {
		
		$isLoggedIn = $this->session->isUserLoggedIn();
		$role = $this->session->getSessionValue("role");
		
		//var_dump($isLoggedIn);
		//var_dump($this->role);
		//exit;
		
		if ($isLoggedIn && $role == "admin") {
			return true;
		}
		
		else {
			$this->redirect("");
			exit;
		}
	}

	function index()
	{
		$this->access();
		$get = $this->filter_get();
		
		$this->pageTitle = "Read All Categories";
		$this->pageUrl = DOMAIN . "admin/categories/";
		
		// Pagination
		$page = isset($get['page']) ? $get['page'] : 1;
		$search = isset($get['search']) ? $get['search'] : '';
		
		// Pagination settings
		$perPage = 3;
		$displayArrows = true;
		$fromRecords = ($perPage * $page) - $perPage;

		// If a search is made
		if ($search) {
			$records = $this->categoryModel->countAllBySearch($search);
			$categories = $this->categoryModel->searchWithPaging($search, $fromRecords, $perPage);
		}
		
		// If no search is made
		else {
			$records = $this->categoryModel->countAll();
			$categories = $this->categoryModel->readAllWithPaging($fromRecords, $perPage);
		}

		// Pagination variable
		$pagination = $this->pagination->paging($records, $this->pageUrl, $page, $perPage, $displayArrows);
		
		$this->pageData = [
			"search" => $search,
			"categories" => $categories,
			"pagination" => $pagination,
		];

		$this->view("admin/categories/read", [
			"pageTitle" => $this->pageTitle,
			"pageUrl" => $this->pageUrl,
			"pageData" => $this->pageData,

		]);
	}

	// Get create user view
	function create()
	{
		$this->access();
		$this->pageTitle = "Create Category";
		$this->pageUrl = DOMAIN . "admin/category/create/";
		
		$this->pageData = [
			"csrf" => $this->session->getSessionValue("csrf")
		];

		$this->view("admin/categories/create", [
			"pageTitle" => $this->pageTitle,
			"pageUrl" => $this->pageUrl,
			"pageData" => $this->pageData,
		]);
	}

	// Post create user function
	function createCategory()
	{
		$this->access();
		
		// Filter post fields
		$post = $this->filter_post();
		
		// Set CSRF token to be verified
		$this->session->csrf = $post["csrf"];

		// Verify CSRF token
		if ($this->session->validateCSRF()) {
			
			$this->categoryModel->name = $this->clean($post["name"]);
			$this->categoryModel->description = $this->clean($surname = $post["description"]);
			
			// Validate username, password, and email
			if ($this->categoryModel->validateCreate()) {
				
				// Register new user
				$this->categoryModel->create();
			
				// Redirect to profile
				$this->redirect('admin/categories/');
			}
			
			else {
				// Set error message
				$this->message = $this->categoryModel->errors;

				echo $this->message;
				exit();	
			}
		}
	}
	
	
	function update($vars = null)
	{
		$this->access();
		
		if ($vars['id']) {

			$this->categoryModel->id = $vars['id'];

			$this->pageTitle = "Update Category";
			$this->pageUrl = DOMAIN . "admin/category/update/" . $this->categoryModel->id;
			
			$this->pageData = [
				"category" => $this->categoryModel->readOne(),
				"csrf" => $this->session->getSessionValue("csrf")
			];

			$this->view("admin/categories/update", [
				"pageTitle" => $this->pageTitle,
				"pageUrl" => $this->pageUrl,
				"pageData" => $this->pageData,
			]);
		}
	}

	// Post update user function
	function updateCategory($vars = null)
	{
		$this->access();
		$post = $this->filter_post();

		if ($vars['id']) {
			
			$this->categoryModel->id = $vars['id'];
		
			// Set CSRF token to be verified
			$this->session->csrf = $post["csrf"];
		
			// Verify CSRF token
			if ($this->session->validateCSRF()) {
		
				$this->categoryModel->name = $this->clean($post['name']);
				$this->categoryModel->description = $this->clean($post['description']);
								
				if ($this->categoryModel->validateUpdate()) {
	
					// Update settings
					if ($this->categoryModel->update()) {
						// Redirect to profile
						$this->redirect("admin/categories/");	
					}
				}
			
				else {
					// Set error message
					$this->message = $this->categoryModel->getErrors($this->errors);

					echo $this->message;
					exit();	
				}
			}
		}
	}
	
	function delete($vars = null) {
		
		$this->access();
		
		if ($vars['id']) {

			$this->categoryModel->id = $vars['id'];

			$this->pageTitle = "Delete Category";
			$this->pageUrl = DOMAIN . "admin/category/delete/" . $this->categoryModel->id;
			
			$this->pageData = [
				"id" => $this->categoryModel->id,
				"csrf" => $this->session->getSessionValue("csrf"),
			];

			$this->view("admin/categories/delete", [
				"pageTitle" => $this->pageTitle,
				"pageUrl" => $this->pageUrl,
				"pageData" => $this->pageData,
			]);
		}
	}

	function deleteCategory($vars = null) {
		
		// Check logged in & permission
		$this->access();
		
		// If an id exist
		if ($vars['id']) {
			
			// Set user id to be deleted
			$this->categoryModel->id = $vars['id'];
			
			// Delete user
			$this->categoryModel->delete();
			
			// Redirect to admin/users
			$this->redirect("admin/categories");
		}
	}
}
