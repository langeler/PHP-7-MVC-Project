<?php

namespace App\Controllers;

use App\Core\Controller as Controller;

class RegisterController extends Controller
{
	public $pageTitle = "Register";
	public $message;
	public $user;
	public $errorList = "";
	public $errors = [];
	public $csrf;

	/**
	 * Make sure password passes proper testing, username does not
	 * contain special characters, and email is valid.
	 */
	public function validateNewUser($forename, $surname, $phone, $username, $password, $email)
	{
		// Validate forename
		if (empty($forename)) {
			$this->errors[] = "Your first name is required";
		}
		
		// Validate surname
		if (empty($surname)) {
			$this->errors[] = "Your last name is required";
		}
		
		// Validate phone
		if (empty($phone)) {
			$this->errors[] = "Your phone number is required";
		}
		
		$this->validatePassword($password);
		$this->validateUsername($username);
		$this->validateEmail($email);

		$usernameSearchResults = $this->userControl->isUsernameAvailable(
			$username
		);
		$emailSearchResults = $this->userControl->isEmailAvailable($email);
		$isApprovedUsername = $this->isApprovedUsername($username);

		// Username already exists in the database
		if ($usernameSearchResults > 0) {
			$this->errors[] = USERNAME_EXISTS;
		}
		// Email already exists in the database
		elseif ($emailSearchResults > 0) {
			$this->errors[] = EMAIL_EXISTS;
		}
		// Username does matches with a disallowed username
		elseif (!$isApprovedUsername) {
			$this->errors[] = USERNAME_NOT_APPROVED;
		}
	}

	public function post()
	{
		$post = $this->filter_post();
		$this->session->validateCSRF($post["csrf"]);
		
		$forename = $post["forename"];
		$surname = $post["surname"];
		$phone = $post["phone"];		
		$username = $post["username"];
		$password = $post["password"];
		$email = $post["email"];

		// Validate username, password, and email
		$this->validateNewUser($forename, $surname, $phone, $username, $password, $email);

		// Show errors if any tests failed
		if (!empty($this->errors)) {
			$this->errorList = $this->getErrors($this->errors);
			$this->message = $this->errorList;

			echo $this->message;
			exit();
		} else {
			// Hash the password
			$passwordHash = $this->encryptPassword($password);
			$result = $this->userControl->registerNewUser(
				$forename,
				$surname,
				$phone,
				$username,
				$passwordHash,
				$email,
				"user"
			);

			// User registration successful
			if ($result) {
				$this->user = $this->userControl->getUserByUsername($username);
				$this->session->login($this->user);

				// TODO: SESSION Flash class
				// $this->message = 'Proceed';
				// echo $this->message;

				$this->redirect("dashboard");
			}
		}

		$this->view("register");
	}

	public function get()
	{
		$isLoggedIn = $this->session->isUserLoggedIn();
		$this->csrf = $this->session->getSessionValue("csrf");

		if ($isLoggedIn) {
			$this->redirect("dashboard");
		}

		$this->view("register");
	}
}
