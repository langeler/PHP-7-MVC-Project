<?php

/**
 * Category Class
 * Interact with categories and category data.
 */
namespace App\Models;

use App\Core\Model as Model;

class Category extends Model
{
	private $category_table = "categories";

	public $id;
	public $name;
	public $description;
	public $created;
	public $modified;

	public function validateCreate()
	{
		// Validate fields
		$this->validate
			->name("name")
			->value($this->name)
			->pattern("words")
			->required();

		// Username already exists in the database
		if ($this->nameExist()) {
			$this->validate->errors[] =
				"A category with that name already exist.";
		}

		if ($this->validate->isSuccess()) {
			return true;
		} else {
			$this->errors = $this->validate->displayErrors();
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
			->name("name")
			->value($this->name)
			->pattern("words")
			->required();

		// Get user data from database
		$this->category = $this->readOne();

		// If email doesn't match the email on record
		if ($this->name !== $this->category["name"]) {
			// If new name isn't avaliable
			if ($this->nameExist()) {
				$this->validate->errors[] =
					"A category with that name already exist.";
			}
		}

		if ($this->validate->isSuccess()) {
			return true;
		} else {
			$this->errors = $this->validate->displayErrors();
			$this->getErrors();
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

		// insert query
		$query =
			"INSERT INTO
                    " .
			$this->category_table .
			"
                SET
					name = :name,
					description = :description,
					created = :created";

		// Prepare prepared statement
		$this->db->prepare($query);

		// Bind values
		$this->db->bind(":name", $this->name);
		$this->db->bind(":description", $this->description);
		$this->db->bind(":created", $this->timestamp);

		$result = $this->db->execute();

		return $result;
	}

	// check if given email exist in the database
	public function nameExist()
	{
		// query to check if email exists
		$query =
			"SELECT *
			FROM
				" .
			$this->category_table .
			"
			WHERE
				name = ?
			LIMIT
				0,1";

		// prepare the query
		$this->db->prepare($query);

		// bind given email value
		$this->db->bind(1, $this->name);

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
			$this->category_table .
			"
			WHERE
				name LIKE ?
			OR
				description LIKE ?
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
			$this->category_table .
			"
			ORDER BY
				name ASC";

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
			$this->category_table .
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
				" . $this->category_table;

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
			$this->category_table .
			"
			WHERE
				name LIKE ?
			OR
				description LIKE ?";

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
			$this->category_table .
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
	public function readOneByName()
	{
		// Set prepared query to be preformed
		$query =
			"SELECT *
			FROM
				" .
			$this->category_table .
			"
			WHERE
				name = :name
			LIMIT
				0,1";

		// Prepare query statement
		$this->db->prepare($query);

		// Bind value
		$this->db->bind(":name", $this->name);

		// Execute and fetch row
		$row = $this->db->fetch();

		// Return row
		return $row;
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
			$this->category_table .
			"
			SET
				name = :name ,
				description = :description,
				modified = :modified
			WHERE
				id = :id";

		// Prepare prepared query statement
		$this->db->prepare($query);

		// Bind values
		$this->db->bind(":name", $this->name);
		$this->db->bind(":description", $this->description);
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
			$this->category_table .
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
