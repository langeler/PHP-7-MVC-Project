<?php

namespace App\Models;

use App\Core\Model as Model;

class Types extends Model
{
	private $type_table = "product_types";

	public $id;
	public $pid;
	public $name;
	public $description;
	public $price;
	public $stock;

	public function validateCreate()
	{
		// Validate fields
		$this->validate
			->name("name")
			->value($this->name)
			->pattern("words")
			->required();
		$this->validate
			->name("price")
			->value($this->price)
			->pattern("float")
			->required();
		$this->validate
			->name("stock")
			->value($this->stock)
			->pattern("int")
			->required();

		// Username already exists in the database
		if ($this->typeExist()) {
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
			->pattern("words")
			->required();
		$this->validate
			->name("price")
			->value($this->price)
			->pattern("float")
			->required();
		$this->validate
			->name("stock")
			->value($this->stock)
			->pattern("int")
			->required();

		// Get user data from database
		$this->type = $this->readOne();

		// If email doesn't match the email on record
		if ($this->name !== $this->type["name"]) {
			// If new name isn't avaliable
			if ($this->typeExist()) {
				$this->validate->errors[] =
					"A type with that name already exist.";
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
			$this->type_table .
			"
                SET
					name = :name,
					description = :description,
					price = :price,
					stock = :stock,
					product_id = :product_id,
					created = :created";

		// Prepare prepared statement
		$this->db->prepare($query);

		// Bind values
		$this->db->bind(":name", $this->name);
		$this->db->bind(":description", $this->description);
		$this->db->bind(":price", $this->price);
		$this->db->bind(":product_id", $this->pid);
		$this->db->bind(":stock", $this->stock);
		$this->db->bind(":created", $this->timestamp);

		$result = $this->db->execute();

		return $result;
	}

	// check if given email exist in the database
	public function typeExist()
	{
		// query to check if email exists
		$query =
			"SELECT *
			FROM
				" .
			$this->type_table .
			"
			WHERE
				name = ?
			AND
				product_id = ?
			LIMIT
				0,1";

		// prepare the query
		$this->db->prepare($query);

		// bind given email value
		$this->db->bind(1, $this->name);
		$this->db->bind(2, $this->pid);

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
			$this->type_table .
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
			$this->type_table .
			"
			WHERE
				product_id = ?
			ORDER BY
				name DESC";

		// prepare query statement
		$this->db->prepare($query);

		$this->db->bind(1, $this->pid);

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
			$this->type_table .
			"
			WHERE
				product_id = ?
			ORDER BY
				name DESC
			LIMIT
				?, ?";

		// prepare query statement
		$this->db->prepare($query);

		// bind limit clause variables
		$this->db->bind(1, $this->pid);
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
			$this->type_table .
			"
			SET
				name = :name ,
				description = :description,
				price = :price,
				stock = :stock,
				modified = :modified
			WHERE
				id = :id";

		// Prepare prepared query statement
		$this->db->prepare($query);

		// Bind values
		$this->db->bind(":name", $this->name);
		$this->db->bind(":description", $this->description);
		$this->db->bind(":price", $this->price);
		$this->db->bind(":stock", $this->stock);
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
			$this->type_table .
			"
			WHERE
				product_id = ?";

		$this->db->prepare($query);

		$this->db->bind(1, $this->pid);

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
			$this->type_table .
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
			$this->type_table .
			"
			WHERE
				product_id = :product_id";

		// Prepare prepared query statement
		$this->db->prepare($query);

		// Bind value
		$this->db->bind(":product_id", $this->pid);

		// Execute query
		$result = $this->db->execute();

		// Return result
		return $result;
	}
}
