<?php

namespace App\Controllers\Auth;

use App\Core\Controller as Controller;
use App\Models\ListClass;

class DashboardController extends Controller
{
	protected $pageTitle = "Dashboard";
	protected $account;
	public $csrf;

	public function get()
	{
		$this->userModel->id = $this->session->getSessionValue("user_id");
		$this->session->authenticate($this->userModel->id);
		$this->account = $this->userModel->readOne();

		$this->view("dashboard");
	}
}
