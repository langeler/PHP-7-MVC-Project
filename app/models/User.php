<?php

/**
 * User Class
 *
 * Interact with users and user data.
 *
 * Any call to the database regarding the users table will go through
 * the User class. The User class extends the Model class, which simply
 * instantiates a Database instance that allows us to connect.
 *
 * From here, we can get information on any user by their user ID,
 * username, or email, or we can get a list of all users. This class
 * also includes calls to the password request table.
 */
namespace App\Models;

use App\Core\Model as Model;

class User extends Model
{
	public $id;
	public $email;
	public $username;
	public $password;
	public $passwordHash;
	public $forename;
	public $surname;
	public $phone;
	public $role = "user";
	public $status = 1;
	
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
		$approved = in_array($this->username, DISALLOWED_USERNAMES) ? false : true;

		return $approved;
	}
	
		/**
	 * Check if username is empty, and make sure it only contains
	 * alphanumeric characters, numbers, dashes, and underscores.
	 * Return an error or null.
	 */
	public function validateUsername()
	{
		if (!empty($this->username)) {
			
			if (strlen($this->username) < "3") {
				$this->errors[] = USERNAME_TOO_SHORT;
			}
			
			if (strlen($this->username) > "50") {
				$this->errors[] = USERNAME_TOO_LONG;
			}
			
			// Match a-z, A-Z, 1-9, -, _.
			if (!preg_match("/^[a-zA-Z\d\-_]+$/i", $this->username)) {
				$this->errors[] = USERNAME_CONTAINS_DISALLOWED;
			}
		}
		
		else {
			$this->errors[] = USERNAME_MISSING;
		}
	}

	/**
	 * Check if password is empty, and make sure it conforms
	 * to password security standards.
	 * Return an error or null.
	 */
	public function validatePassword()
	{
		if (!empty($this->password)) {
			
			if (strlen($this->password) < "8") {
				$this->errors[] = PASSWORD_TOO_SHORT;
			}
		
			if (!preg_match("#[0-9]+#", $this->password)) {
				$this->errors[] = PASSWORD_NEEDS_NUMBER;
			}
			
			if (!preg_match("#[A-Z]+#", $this->password)) {
				$this->errors[] = PASSWORD_NEEDS_UPPERCASE;
			}
			
			if (!preg_match("#[a-z]+#", $this->password)) {
				$this->errors[] = PASSWORD_NEEDS_LOWERCASE;
			}
		}
		
		else {
			$this->errors[] = PASSWORD_MISSING;
		}
	}

	/**
	 * Check if email is empty, and test it against PHP built in
	 * email validation.
	 * Return an error or null.
	 */
	public function validateEmail()
	{
		if (!empty($this->email)) {
			
			// Remove all illegal characters from email
			$this->email = filter_var($this->email, FILTER_SANITIZE_EMAIL);

			// Validate e-mail
			if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
				$this->errors[] = EMAIL_NOT_VALID;
			}
		}
		
		else {
			$this->errors[] = EMAIL_MISSING;
		}
	}
	
	public function validateUserSettings() {
		
		// Validate forename
		if (empty($this->forename)) {
			$this->errors[] = "Your first name is required";
		}
		
		// Validate surname
		if (empty($this->surname)) {
			$this->errors[] = "Your last name is required";
		}
		
		// Validate surname
		if (empty($this->phone)) {
			$this->errors[] = "Your phone number is required";
		}
		
		if (isset($this->email)) {
			
			$this->account = $this->getUser();
			
			if ($this->email  !== $this->account["email"]) {
				
				$this->email = $this->account["email"];
				
				$emailSearchResults = $this->isEmailAvailable();

				if ($emailSearchResults > 0) {
					$this->errors[] = EMAIL_EXISTS;
				}
			}
		}
	}
	
	/**
	 * Make sure password passes proper testing, username does not
	 * contain special characters, and email is valid.
	 */
	public function validateNewUser()
	{
		// Validate forename
		if (empty($this->forename)) {
			$this->errors[] = "Your first name is required";
		}
		
		// Validate surname
		if (empty($this->surname)) {
			$this->errors[] = "Your last name is required";
		}
		
		// Validate phone
		if (empty($this->phone)) {
			$this->errors[] = "Your phone number is required";
		}
		
		$this->validatePassword();
		$this->validateUsername();
		$this->validateEmail();

		$usernameSearchResults = $this->isUsernameAvailable();
		$emailSearchResults = $this->isEmailAvailable();
		$isApprovedUsername = $this->isApprovedUsername();

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
	
	/**
	 * Select all data from a single user by user ID.
	 * Return a single row.
	 */
	public function getUser()
	{
		$query = "SELECT * 
				  FROM users 
				  WHERE id = :id 
				  LIMIT 1";

		$this->db->query($query);
		$this->db->bind(":id", $this->id);

		$user = $this->db->result();

		return $user;
	}

	/**
	 * Select all user data from all users.
	 * Return multiple rows.
	 */
	public function getAllUsers()
	{
		$query = "SELECT * FROM users";

		$this->db->query($query);

		$users = $this->db->resultset();

		return $users;
	}

	/**
	 * Select all data from a single user by username.
	 * Return a single row.
	 */
	public function getUserByUsername()
	{
		$query = "SELECT * 
				  FROM users 
				  WHERE username = :username 
				  LIMIT 1";

		$this->db->query($query);
		$this->db->bind(":username", $this->username);

		$user = $this->db->result();

		return $user;
	}

	/**
	 * Select all data from a single user by email address.
	 * Return a single row.
	 */
	public function getUserByEmail()
	{
		$query = "SELECT * 
				  FROM users 
				  WHERE email = :email 
				  LIMIT 1";

		$this->db->query($query);
		$this->db->bind(":email", $this->email);

		$user = $this->db->result();

		return $user;
	}

	/**
	 * Register a new user by inserting all relevant registration
	 * data into the users table.
	 * Returns true if successful.
	 */
	public function registerNewUser()
	{
		$this->setTimeStamp();
		
		$query = "INSERT INTO users 
					  (forename, surname, phone, username, password, email, role, status, created) 
				  VALUES 
					  (:forename, :surname, :phone, :username, :password, :email, :role, :status, :created)";

		$this->db->query($query);
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

	/**
	 * Query the database for existing usernames to ensure a new
	 * user registration does not override an existing user.
	 * Return a boolean.
	 */
	public function isUsernameAvailable()
	{
		$this->username = strtolower($this->username);
		
		$query = "SELECT COUNT(username) 
				  AS num 
				  FROM users 
				  WHERE LOWER(username) = :username";

		$this->db->query($query);
		$this->db->bind(":username", $this->username);

		$result = $this->db->result();

		return $result["num"];
	}

	/**
	 * Query the database for existing emails to ensure a new
	 * user registration does not override an existing user.
	 * Return a boolean.
	 */
	public function isEmailAvailable()
	{
		$this->email = strtolower($this->email);

		$query = "SELECT COUNT(email) 
				  AS num 
				  FROM users 
				  WHERE email = :email";

		$this->db->query($query);
		$this->db->bind(":email", $this->email);

		$result = $this->db->result();

		return $result["num"];
	}

	/**
	 * Update the settings of a user.
	 * Return a boolean.
	 */
	public function updateUserSettings()
	{
		$query = "UPDATE users 
				  SET forename = :forename ,
					  surname = :surname,
					  email = :email, 
					  phone = :phone
				  WHERE id = :user_id";

		$this->db->query($query);
		$this->db->bind(":forename", $this->forename);
		$this->db->bind(":surname", $this->surname);
		$this->db->bind(":email", $this->email);
		$this->db->bind(":phone", $this->phone);
		$this->db->bind(":user_id", $this->id);

		$result = $this->db->execute();

		return $result;
	}

	/**
	 * Delete a user and all associated list items.
	 * Return a boolean.
	 */
	public function deleteUser()
	{
		$query = "DELETE FROM users
				  WHERE id = :id";

		$this->db->query($query);
		$this->db->bind(":id", $this->id);

		$result = $this->db->execute();

		return $result;
	}

	/**
	 * Query the database for usernames to ensure a new
	 * user registration does not override an existing user.
	 * Return a boolean.
	 */
	public function createPasswordRequest($userId, $token)
	{
		$query = "INSERT INTO password_reset_request
					(user_id, date_requested, token)
				  VALUES
					(:user_id, :date_requested, :token)";

		$this->db->query($query);
		$this->db->bind(":user_id", $userId);
		$this->db->bind(":date_requested", date("Y-m-d H:i:s"));
		$this->db->bind(":token", $token);

		$result = $this->db->execute();

		return $result;
	}

	/**
	 * Before allowing a user to change their password, verify
	 * the password request has taken place on the same session
	 * based on the GET variables passed through.
	 * Return the matching result.
	 */
	public function verifyPasswordRequest($userId, $passwordRequestId, $token)
	{
		$query = "SELECT id, user_id, date_requested 
				  FROM password_reset_request
				  WHERE 
					  user_id = :user_id AND 
					  token = :token AND 
					  id = :id";

		$this->db->query($query);
		$this->db->bind(":user_id", $userId);
		$this->db->bind(":id", $passwordRequestId);
		$this->db->bind(":token", $token);

		$requestInfo = $this->db->result();

		return $requestInfo;
	}

	/**
	 * Update the password of the user who requested a password
	 * change.
	 * Return a boolean.
	 */
	public function resetUserPassword($passwordHash, $userId)
	{
		$query = "UPDATE users 
				  SET password = :password 
				  WHERE id = :id";

		$this->db->query($query);
		$this->db->bind(":password", $passwordHash);
		$this->db->bind(":id", $userId);

		$result = $this->db->execute();

		return $result;
	}
}
