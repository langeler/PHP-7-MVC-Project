<?php

namespace App\Models;

use App\Core\Model as Model;

class Options extends Model
{
	private $option_table = "product_options";

	public $id;
	public $qid;
	public $name;
	public $description;

	public function validateCreate()
	{
		// Validate fields
		$this->validate
			->name("name")
			->value($this->name)
			->pattern("text")
			->required();

		// Username already exists in the database
		if ($this->optionExist()) {
			$this->validate->errors[] = "A type with that name already exist.";
		}

		if ($this->validate->isSuccess()) {
			return true;
		} else {
			$this->errors = $this->validate->displayErrors();
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
			->pattern("text")
			->required();

		// Get user data from database
		$this->option = $this->readOne();

		// If email doesn't match the email on record
		if ($this->name !== $this->option["name"]) {
			// If new name isn't avaliable
			if ($this->optionExist()) {
				$this->validate->errors[] =
					"A question with that name already exist.";
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

	public function create()
	{
		// Set timestamp for the created record
		$this->setTimeStamp();

		// insert query
		$query =
			"INSERT INTO
                    " .
			$this->option_table .
			"
                SET
					name = :name,
					description = :description,
					question_id = :question_id,
					created = :created";

		// Prepare prepared statement
		$this->db->prepare($query);

		// Bind values
		$this->db->bind(":name", $this->name);
		$this->db->bind(":description", $this->description);
		$this->db->bind(":question_id", $this->qid);
		$this->db->bind(":created", $this->timestamp);

		$result = $this->db->execute();

		return $result;
	}

	// check if given email exist in the database
	public function optionExist()
	{
		// query to check if email exists
		$query =
			"SELECT *
			FROM
				" .
			$this->option_table .
			"
			WHERE
				name = ?
			AND
				question_id = ?
			LIMIT
				0,1";

		// prepare the query
		$this->db->prepare($query);

		// bind given email value
		$this->db->bind(1, $this->name);
		$this->db->bind(2, $this->qid);

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

	// read variation details
	public function readOne()
	{
		// Set prepared query to be preformed
		$query =
			"SELECT *
			FROM
				" .
			$this->option_table .
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

	// read all user rows from the database
	public function readAll()
	{
		// query to read all users
		$query =
			"SELECT *
			FROM
				" .
			$this->option_table .
			"
			WHERE
				question_id = ?
			ORDER BY
				name DESC";

		// prepare query statement
		$this->db->prepare($query);

		$this->db->bind(1, $this->qid);

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
			$this->option_table .
			"
			WHERE
				question_id = ?
			ORDER BY
				name DESC
			LIMIT
				?, ?";

		// prepare query statement
		$this->db->prepare($query);

		// bind limit clause variables
		$this->db->bind(1, $this->qid);
		$this->db->bind(2, (int) $records);
		$this->db->bind(3, (int) $perPage);

		// execute query
		$result = $this->db->fetchAll();

		// return values
		return $result;
	}

	public function update()
	{
		// Set timestamp for the created record
		$this->setTimeStamp();

		// Prepared query statement
		$query =
			"UPDATE
				" .
			$this->option_table .
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

	public function countAll()
	{
		$query =
			"SELECT
			COUNT(*) as count
			FROM
				" .
			$this->option_table .
			"
			WHERE
				question_id = ?";

		$this->db->prepare($query);

		$this->db->bind(1, $this->qid);

		// execute the query
		$this->db->execute();

		$result = $this->db->fetch();

		return (int) $result["count"];
	}

	public function delete()
	{
		// Prepared query statement
		$query =
			"DELETE FROM
				" .
			$this->option_table .
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

	public function deleteAll()
	{
		// Prepared query statement
		$query =
			"DELETE FROM
				" .
			$this->option_table .
			"
			WHERE
				question_id = :question_id";

		// Prepare prepared query statement
		$this->db->prepare($query);

		// Bind value
		$this->db->bind(":question_id", $this->qid);

		// Execute query
		$result = $this->db->execute();

		// Return result
		return $result;
	}
}
