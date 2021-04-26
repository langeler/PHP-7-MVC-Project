<?php

/**
 * User Class
 * Interact with users and user data.
 */
namespace App\Models;

use App\Core\Model as Model;

class User extends Model
{
	private $user_table = "users";

	public $id;
	public $email;
	public $username;
	public $password;
	public $cpassword;
	public $passwordHash;
	public $forename;
	public $surname;
	public $phone;
	public $access_code;
	public $role;
	public $status = 1;
	public $created;
	public $modified;

	/**
	 * Securely hash a password.
	 * Returns hashed password.
	 */
	public function hashPassword()
	{
		$this->passwordHash = password_hash($this->password, PASSWORD_BCRYPT, [
			"cost" => 12,
		]);
	}

	/**
	 * Vertify a submitted password against existing password.
	 * Return a Boolean.
	 */
	public function verifyPassword()
	{
		if (password_verify($this->password, $this->passwordHash)) {
			return true;
		}

		return false;
	}

	/**
	 * Check if a username is in the list of disallowed usernames.
	 * Return a Boolean.
	 */
	public function isApprovedUsername()
	{
		return in_array($this->username, DISALLOWED_USERNAMES) ? false : true;
	}

	public function validateCreate()
	{
		// Validate fields
		$this->validate
			->name("forename")
			->value($this->forename)
			->pattern("words")
			->required();
		$this->validate
			->name("surname")
			->value($this->surname)
			->pattern("words")
			->required();
		$this->validate
			->name("phone")
			->value($this->phone)
			->pattern("tel")
			->required();
		$this->validate
			->name("email")
			->value($this->email)
			->required()
			->is_email($this->email);
		$this->validate
			->name("username")
			->value($this->username)
			->pattern("alpha")
			->required();
		$this->validate
			->name("password")
			->value($this->password)
			->customPattern("[A-Za-z0-9-.;_!#@]{5,15}")
			->required();
		$this->validate
			->name("cpassword")
			->value($this->cpassword)
			->customPattern("[A-Za-z0-9-.;_!#@]{5,15}")
			->required();
		$this->validate
			->name("role")
			->value($this->role)
			->pattern("words")
			->required();

		// Check if passwords match
		if ($this->cpassword != $this->password) {
			$this->validate->errors[] =
				"Password and confirm password do not match!";
		}

		// Username already exists in the database
		if ($this->usernameExists()) {
			$this->validate->errors[] = USERNAME_EXISTS;
		}

		// Email already exists in the database
		if ($this->emailExists()) {
			$this->validate->errors[] = EMAIL_EXISTS;
		}

		// Username does matches with a disallowed username
		if (!$this->isApprovedUsername()) {
			$this->validate->errors[] = USERNAME_NOT_APPROVED;
		}

		$this->errors = $this->validate->displayErrors();

		if ($this->validate->isSuccess()) {
			return true;
		} else {
			$this->getErrors();
			return false;
		}
	}

	public function validateLogin()
	{
		$this->validate
			->name("username")
			->value($this->username)
			->pattern("alpha")
			->required();
		$this->validate
			->name("password")
			->value($this->password)
			->customPattern("[A-Za-z0-9-.;_!#@]{5,15}")
			->required();

		// Username does matches with a disallowed username
		if (!$this->isApprovedUsername()) {
			$this->validate->errors[] = USERNAME_NOT_APPROVED;
		}

		$this->errors = $this->validate->displayErrors();

		if ($this->validate->isSuccess()) {
			return true;
		} else {
			$this->getErrors();
			return false;
		}
	}

	public function validateSearch()
	{
		// Validate fields
		$this->validate
			->name("search")
			->value($this->search)
			->pattern("words")
			->required();
		$this->errors = $this->validate->displayErrors();

		if ($this->validate->isSuccess()) {
			return true;
		} else {
			$this->getErrors();
			return false;
		}
	}

	public function validateUpdate()
	{
		// Validate fields
		$this->validate
			->name("forename")
			->value($this->forename)
			->pattern("words")
			->required();
		$this->validate
			->name("surname")
			->value($this->surname)
			->pattern("words")
			->required();
		$this->validate
			->name("phone")
			->value($this->phone)
			->pattern("tel")
			->required();
		$this->validate
			->name("email")
			->value($this->email)
			->required()
			->is_email($this->email);
		$this->validate
			->name("role")
			->value($this->role)
			->pattern("words")
			->required();

		// Get user data from database
		$this->account = $this->readOne();

		// If email doesn't match the email on record
		if ($this->email !== $this->account["email"]) {
			// If new email isn't avaliable
			if ($this->emailExists()) {
				$this->validate->errors[] = EMAIL_EXISTS;
			}
		}

		$this->errors = $this->validate->displayErrors();

		if ($this->validate->isSuccess()) {
			return true;
		} else {
			$this->getErrors();
			return false;
		}
	}

	public function login()
	{
		// Retrieve the user account information for the given username
		$this->account = $this->readOneByUsername();

		$this->passwordHash = $this->account["password"];

		if ($this->verifyPassword()) {
			$this->session->user = $this->account;
			$this->session->login();

			// Return true
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Register a new user by inserting all relevant registration
	 * data into the users table.
	 * Returns true if successful.
	 */
	public function create()
	{
		// Set timestamp for the created record
		$this->setTimeStamp();

		// Hash the password
		$this->hashPassword();

		// insert query
		$query =
			"INSERT INTO
                    " .
			$this->user_table .
			"
                SET
					forename = :forename,
					surname = :surname,
					phone = :phone,
					username = :username,
					email = :email,
					password = :password,
					role = :role,
					status = :status,
					created = :created";

		// Prepare prepared statement
		$this->db->prepare($query);

		// Bind values
		$this->db->bind(":forename", $this->forename);
		$this->db->bind(":surname", $this->surname);
		$this->db->bind(":phone", $this->phone);
		$this->db->bind(":username", $this->username);
		$this->db->bind(":password", $this->passwordHash);
		$this->db->bind(":email", $this->email);
		$this->db->bind(":role", $this->role);
		$this->db->bind(":status", $this->status);
		$this->db->bind(":created", $this->timestamp);

		$result = $this->db->execute();

		return $result;
	}

	// check if given email exist in the database
	public function emailExists()
	{
		// query to check if email exists
		$query =
			"SELECT *
			FROM
				" .
			$this->user_table .
			"
			WHERE
				email = ?
			LIMIT
				0,1";

		// prepare the query
		$this->db->prepare($query);

		// bind given email value
		$this->db->bind(1, $this->email);

		// execute the query
		$this->db->execute();

		// if email exists, assign values to object properties for easy access and use for php sessions
		if ($this->db->rowCount() > 0) {
			// return true because email exists in the database
			return true;
		}

		// return false if email doesn't exist in the database
		return false;
	}

	// search all user rows from the database
	public function searchWithPaging($search, $records, $perPage)
	{
		// query to read all users
		$query =
			"SELECT *
			FROM
				" .
			$this->user_table .
			"
			WHERE
				username LIKE ?
			OR
				email LIKE ?
			ORDER BY
				created DESC
			LIMIT
				?, ?";

		// prepare query statement
		$this->db->prepare($query);

		// sanitize
		$search = "%{$search}%";
		$search = htmlspecialchars(strip_tags($search));

		// bind variable values
		$this->db->bind(1, $search);
		$this->db->bind(2, $search);
		$this->db->bind(3, (int) $records);
		$this->db->bind(4, (int) $perPage);

		// execute query
		$result = $this->db->fetchAll();

		// return values
		return $result;
	}

	// read all user rows from the database
	public function readAll()
	{
		// query to read all users
		$query =
			"SELECT *
			FROM
				" .
			$this->user_table .
			"
			ORDER BY
				created DESC";

		// prepare query statement
		$this->db->prepare($query);

		// execute query
		$result = $this->db->fetchAll();

		// return values
		return $result;
	}

	// read all user rows from the database
	public function readAllWithPaging($records, $perPage)
	{
		// query to read all users
		$query =
			"SELECT *
			FROM
				" .
			$this->user_table .
			"
			ORDER BY
				created DESC
			LIMIT
				?, ?";

		// prepare query statement
		$this->db->prepare($query);

		// bind limit clause variables
		$this->db->bind(1, (int) $records);
		$this->db->bind(2, (int) $perPage);

		// execute query
		$result = $this->db->fetchAll();

		// return values
		return $result;
	}

	public function countAll()
	{
		$query =
			"SELECT
			COUNT(*) as count
			FROM
				" . $this->user_table;

		$this->db->prepare($query);

		// execute the query
		$this->db->execute();

		$result = $this->db->fetch();

		return (int) $result["count"];
	}

	// used for paging products based on search term
	public function countAllBySearch($search)
	{
		$query =
			"SELECT
			COUNT(*) as count
			FROM
				" .
			$this->user_table .
			"
			WHERE
				username LIKE ?
			OR
				email LIKE ?";

		$this->db->prepare($query);

		$search = "%{$search}%";
		$search = htmlspecialchars(strip_tags($search));

		// bind search term
		$this->db->bind(1, $search);
		$this->db->bind(2, $search);

		// execute the query
		$this->db->execute();

		$result = $this->db->fetch();

		return (int) $result["count"];
	}

	/**
	 * Select all data from a single user by user ID.
	 * Return a single row.
	 */
	public function readOne()
	{
		// Set prepared query to be preformed
		$query =
			"SELECT *
			FROM
				" .
			$this->user_table .
			"
			WHERE
				id = :id
			LIMIT
				0,1";

		// Prepare query statement
		$this->db->prepare($query);

		// Bind values
		$this->db->bind(":id", $this->id);

		// Execute and fetch row
		$row = $this->db->fetch();

		// Return row
		return $row;
	}

	/**
	 * Select all data from a single user by username.
	 * Return a single row.
	 */
	public function readOneByUsername()
	{
		// Set prepared query to be preformed
		$query =
			"SELECT *
			FROM
				" .
			$this->user_table .
			"
			WHERE
				username = :username
			LIMIT
				0,1";

		// Prepare query statement
		$this->db->prepare($query);

		// Bind value
		$this->db->bind(":username", $this->username);

		// Execute and fetch row
		$row = $this->db->fetch();

		// Return row
		return $row;
	}

	/**
	 * Select all data from a single user by email address.
	 * Return a single row.
	 */
	public function readOneByEmail()
	{
		// Set prepared query to be preformed
		$query =
			"SELECT *
			FROM
				" .
			$this->user_table .
			"
			WHERE
				email = :email
			LIMIT
				0,1";

		// Prepare query statement
		$this->db->prepare($query);

		// Bind value
		$this->db->bind(":email", $this->email);

		// Execute and fetch row
		$row = $this->db->fetch();

		// Return row
		return $row;
	}

	// check if given username exist in the database
	public function usernameExists()
	{
		// query to check if username exists
		$query =
			"SELECT *
			FROM
				" .
			$this->user_table .
			"
			WHERE
				username = ?
			LIMIT
				0,1";

		// prepare the query
		$this->db->prepare($query);

		// bind given username value
		$this->db->bind(1, $this->username);

		// execute the query
		$this->db->execute();

		// if username exists, assign values to object properties for easy access and use for php sessions
		if ($this->db->rowCount() > 0) {
			// return true because email exists in the database
			return true;
		}

		// return false if username doesn't exist in the database
		return false;
	}

	/**
	 * Update the settings of a user.
	 * Return a boolean.
	 */
	public function update()
	{
		// Set timestamp for the created record
		$this->setTimeStamp();

		// Prepared query statement
		$query =
			"UPDATE
				" .
			$this->user_table .
			"
			SET
				forename = :forename ,
				surname = :surname,
				email = :email,
				phone = :phone,
				role = :role,
				modified = :modified
			WHERE
				id = :id";

		// Prepare prepared query statement
		$this->db->prepare($query);

		// Bind values
		$this->db->bind(":forename", $this->forename);
		$this->db->bind(":surname", $this->surname);
		$this->db->bind(":email", $this->email);
		$this->db->bind(":phone", $this->phone);
		$this->db->bind(":role", $this->role);
		$this->db->bind(":modified", $this->timestamp);
		$this->db->bind(":id", $this->id);

		// Execute query
		$result = $this->db->execute();

		// Return result
		return $result;
	}

	/**
	 * Delete a user and all associated list items.
	 * Return a boolean.
	 */
	public function delete()
	{
		// Prepared query statement
		$query =
			"DELETE FROM
				" .
			$this->user_table .
			"
			WHERE
				id = :id";

		// Prepare prepared query statement
		$this->db->prepare($query);

		// Bind value
		$this->db->bind(":id", $this->id);

		// Execute query
		$result = $this->db->execute();

		// Return result
		return $result;
	}
}
