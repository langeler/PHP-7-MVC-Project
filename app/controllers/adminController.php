<?php

namespace App\Controllers;

use App\Core\Controller;

class adminController extends Controller
{
	protected $pageTitle;
	protected $pageUrl;
	protected $pageData;
	protected $role;
	protected $paginate;

	function access() {
		
		$isLoggedIn = $this->session->isUserLoggedIn();
		$this->role = $this->session->getSessionValue("role");
		
		//var_dump($isLoggedIn);
		//var_dump($this->role);
		//exit;
		
		if ($isLoggedIn && $this->role == "admin") {
			return true;
		}
		
		else {
			$this->redirect("");
			exit;
		}
	}

	function home()
	{
		$this->access();	
		$this->pageTitle = "Admin Dashboard";

		$this->view("admin/home", [
			"pageTitle" => $this->pageTitle,
		]);
	}

	function readAllUsers($vars)
	{
		$this->access();
		$get = $this->filter_get();
		
		$this->pageTitle = "Read All User";
		$this->pageUrl = DOMAIN . "admin/users/";
		
		// Pagination
		$page = isset($get['page']) ? $get['page'] : 1;
		$search = isset($get['search']) ? $get['search'] : '';
		
		// Pagination settings
		$perPage = 3;
		$displayArrows = true;
		$fromRecords = ($perPage * $page) - $perPage;

		// If a search is made
		if ($search) {
			$records = $this->userModel->countAllBySearch($search);
			$accounts = $this->userModel->searchWithPaging($search, $fromRecords, $perPage);
		}
		
		// If no search is made
		else {
			$records = $this->userModel->countAll();
			$accounts = $this->userModel->readAllWithPaging($fromRecords, $perPage);
		}

		// Pagination variable
		$pagination = $this->pagination->paging($records, $this->pageUrl, $page, $perPage, $displayArrows);
		
		var_dump($search);
		
		$this->pageData = [
			"search" => $search,
			"accounts" => $accounts,
			"pagination" => $pagination,
		];

		$this->view("admin/users", [
			"pageTitle" => $this->pageTitle,
			"pageUrl" => $this->pageUrl,
			"pageData" => $this->pageData,

		]);
	}

	// Get create user view
	function readUser()
	{
		$this->access();
		$this->pageTitle = "Create User";

		$this->view("admin/create.user", [
			"pageTitle" => $this->pageTitle,
			"roles" => ["user", "admin"],
		]);
	}

	function readOneUser($user_id = null)
	{
		$this->access();
		$this->pageTitle = "Update User";

		// var_dump($user_id);
		$user_id = $user_id["id"];

		if (isset($user_id)) {
			$account = $this->admin->readOneUser($user_id);
			// var_dump($user_id['id']);

			$this->view("admin/update.user", [
				"account" => $account,
				"pageTitle" => $this->pageTitle,
				"roles" => ["user", "admin"],
			]);
		}
		
		else {
			$this->redirect("admin/users");
		}
	}

	// Post create user function
	function createUser()
	{
		$this->admin->createUser(
			$this->post("username"),
			$this->post("password"),
			$this->post("email"),
			$this->post("fullname"),
			$this->post("role")
		);

		$this->redirect("admin/home");
	}

	// Post update user function
	function updateUser($user_id = null)
	{
		$user_id = $user_id["id"];

		if (isset($user_id)) {
			$this->admin->updateUser(
				$user_id,
				$this->post("username"),
				$this->post("email"),
				$this->post("fullname"),
				$this->post("description"),
				$this->post("role")
			);
		}

		$this->redirect("admin/home");
	}

	// Post delete user function
	function deleteUser($user_id = null)
	{
		$user_id = $user_id["id"];

		if (isset($user_id)) {
			$this->admin->deleteUser($user_id);
		}

		$this->redirect("admin/home");
	}
}
