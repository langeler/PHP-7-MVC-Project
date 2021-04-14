<?php

namespace App\Models;

use App\Core\Model as Model;

class Contact extends Model
{
	private $table = "contact";

	// object properties
	protected $id; // Category id
	protected $name; // Category name
	protected $email; // Category description
	protected $phone; // Search query
	protected $country; // Search query
	protected $state; // Search query
	protected $zip; // Search query
	protected $address; // Search query

	protected $records; // Total number of records
	protected $page; // Total records per page

	// delete the product
	function create() {
		
		// insert query
		$query = "INSERT INTO 
				" . $this->table . "
			SET 
				name = ?, 
				description = ?, 
				created = ?";
	}
	
	// delete the product
	function readOne() {
		
		// select single record query
		$query = "SELECT 
				name, 
				description
			FROM 
				" . $this->table_name . "
			WHERE 
				id = ?
			LIMIT 
				0, 1";
	}

	// delete the product
	function readAll() {
		
		// query select all categories
		$query = "SELECT 
				id, 
				name, 
				description
			FROM 
				" . $this->table . "
			ORDER BY 
				name
			LIMIT 
				?, ?";
				
		$this->records;
		$this->page;
	}
	
	// delete the product
	function update() {
		
		// update query
		$query = "UPDATE 
				" . $this->table . "
			SET 
				name = :name, 
				description = :description
			WHERE 
				id = :id";
	}
	
	// delete the product
	function delete() {
		
		// delete query
		$query = "DELETE FROM 
				" . $this->table . " 
			WHERE 
				id = ?";
	}
	
	function search() {
		
		// search query
		$query = "SELECT 
				id, 
				name, 
				description
			FROM 
				" . $this->table_name . "
			WHERE 
				name LIKE ?
			ORDER BY 
				name ASC
			LIMIT 
				?, ?";
		
		$this->search;
		$this->records;
		$this->page;
	}
	
	// used for paging categories
	public function countAll() {

		// query to count all data
		$query = "SELECT count(*) FROM " . $this->table;
		
		// prepare query statement
		$stmt = $this->conn->prepare($query);

		// execute query
		$stmt->execute();

		// get row value
		$rows = $stmt->fetch(PDO::FETCH_NUM);

		// return all data count
		return $rows[0];
	}
	
	
}