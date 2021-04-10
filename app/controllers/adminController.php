<?php

namespace App\Controllers;

use App\Core\Controller as Controller;
use App\Models\Admin;
use App\Models\Session;
use App\Models\User;

class adminController extends Controller
{
	protected $pageTitle;
	protected $session;
	protected $admin;
	protected $categories;

	/**
	 * Initialize controller with Session, User, Comment, and List classes.
	 */
	public function __construct()
	{
		$this->admin = new Admin();
		$this->session = new Session();
		$this->userControl = new User();

		$isLoggedIn = $this->session->isUserLoggedIn();

		// TODO add role field to DB & set session value
		$this->role = $this->session->getSessionValue("role");

		if (!$this->role == "admin") {
			$this->redirect("login");
		}
	}

	function home()
	{
		$this->pageTitle = "Admin Dashboard";

		$this->view("admin/home", [
			"pageTitle" => $this->pageTitle,
		]);
	}

	function readAllUsers()
	{
		$this->pageTitle = "Read All User";
		$this->users = $this->admin->readAllUsers();

		$this->view("admin/users", [
			"pageTitle" => $this->pageTitle,
			"users" => $this->users,
		]);
	}

	// Get create user view
	function readUser()
	{
		$this->pageTitle = "Create User";

		$this->view("admin/create.user", [
			"pageTitle" => $this->pageTitle,
			"roles" => ["user", "admin"],
		]);
	}

	function readOneUser($user_id = null)
	{
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
		} else {
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
	
	
	function readAllCategories()
	{
		$this->pageTitle = "Read All Categories";
		$this->categories = $this->admin->readAllCategories();

		$this->view("admin/categories", [
			"pageTitle" => $this->pageTitle,
			"categories" => $this->categories,
		]);
	}

	// Get create user view
	function readCategory()
	{
		$this->pageTitle = "Create Category";

		$this->view("admin/create.category", [
			"pageTitle" => $this->pageTitle,
		]);
	}

	function readOneCategory($category_id = null)
	{
		$this->pageTitle = "Update Category";
		
		
		$category_id = $category_id["id"];
		var_dump($category_id);
		if (isset($category_id)) {
			
			$category = $this->admin->readOneCategory($category_id);

			$this->view("admin/update.category", [
				"category" => $category,
				"pageTitle" => $this->pageTitle,
			]);
		} else {
			$this->redirect("admin/users");
		}
	}

	// Post create user function
	function createCategory()
	{
		$this->admin->createCategory(
			$this->post("name"),
			$this->post("description")
		);

		$this->redirect("admin/home");
	}

	// Post update user function
	function updateCategory($category_id = null)
	{
		$category_id = $category_id["id"];

		if (isset($category_id)) {
			$this->admin->updateCategory(
				$category_id,
				$this->post("name"),
				$this->post("description")
			);
		}

		$this->redirect("admin/home");
	}

	// Post delete user function
	function deleteCategory($category_id = null)
	{
		$category_id = $category_id["id"];

		if (isset($category_id)) {
			$this->admin->deleteCategory($category_id);
		}

		$this->redirect("admin/home");
	}
}
