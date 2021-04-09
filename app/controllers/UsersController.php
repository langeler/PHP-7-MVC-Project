<?php

namespace App\Controllers;

use App\Core\Controller as Controller;

class UsersController extends Controller
{
    public $pageTitle = "View Users";
    public $users;
    public $role;

    public function get()
    {
        $isLoggedIn = $this->session->isUserLoggedIn();
        
        // TODO add role field to DB & set session value
        $this->role = $this->session->getSessionValue('role');
       
        if ($this->role == "admin") {
        	$this->users = $this->userControl->getAllUsers();
			$this->view('users');
        }
    }
}
