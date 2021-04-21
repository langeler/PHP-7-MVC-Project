<?php

namespace App\Controllers\Admin;

use App\Core\Controller;

class adminController extends Controller
{
	protected $pageTitle;
	protected $pageUrl;
	protected $pageData;

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

	function index()
	{
		$this->access();	
		$this->pageTitle = "Admin Dashboard";
		$this->pageUrl = DOMAIN . "admin/";

		$this->view("admin/index", [
			"pageTitle" => $this->pageTitle,
			"pageUrl" => $this->pageUrl,
		]);
	}
}
