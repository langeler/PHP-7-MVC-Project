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

class Admin extends Model
{
	/**
	 * Register a new user by inserting all relevant registration
	 * data into the users table.
	 * Returns true if successful.
	 */
	public function createUser($username, $password, $email, $fullname, $role)
	{
		$query = "INSERT INTO users 
					  (username, password, email, fullname, role) 
				  VALUES 
					  (:username, :password, :email, :fullname, :role)";

		$this->db->query($query);
		$this->db->bind(":username", $username);
		$this->db->bind(":password", $password);
		$this->db->bind(":email", $email);
		$this->db->bind(":fullname", $fullname);
		$this->db->bind(":role", $role);

		$result = $this->db->execute();

		return $result;
	}

	/**
	 * Select all user data from all users.
	 * Return multiple rows.
	 */
	public function readAllUsers()
	{
		$query = "SELECT * FROM users";

		$this->db->query($query);

		$users = $this->db->resultset();

		return $users;
	}

	/**
	 * Select all data from a single user by user ID.
	 * Return a single row.
	 */
	public function readOneUser($user_id)
	{
		$query = "SELECT * 
				  FROM users 
				  WHERE id = :id 
				  LIMIT 1";

		$this->db->query($query);
		$this->db->bind(":id", $user_id);

		$user = $this->db->result();

		return $user;
	}

	/**
	 * Update the settings of a user.
	 * Return a boolean.
	 */
	public function updateUser(
		$user_id,
		$username,
		$email,
		$fullname,
		$description,
		$role
	) {
		$query = "UPDATE users 
				  SET username = :username ,
					  email = :email,
					  fullname = :fullname, 
					  description = :description
					  role = :role
				  WHERE id = :user_id";

		$this->db->query($query);
		$this->db->bind(":username", $username);
		$this->db->bind(":email", $email);
		$this->db->bind(":fullname", $fullname);
		$this->db->bind(":description", $description);
		$this->db->bind(":role", $role);
		$this->db->bind(":user_id", $user_id);

		$result = $this->db->execute();

		return $result;
	}

	/**
	 * Delete a user and all associated list items.
	 * Return a boolean.
	 */
	public function deleteUser($user_id)
	{
		$query = "DELETE FROM users
				  WHERE id = :id";

		$this->db->query($query);
		$this->db->bind(":id", $user_id);

		$result = $this->db->execute();

		$query = "DELETE FROM list_items
					WHERE user_id = :user_id";

		$this->db->query($query);
		$this->db->bind(":user_id", $user_id);
		$this->db->execute();

		$query = "DELETE FROM lists
					WHERE user_id = :user_id";

		$this->db->query($query);
		$this->db->bind(":user_id", $user_id);
		$this->db->execute();

		return $result;
	}
}
