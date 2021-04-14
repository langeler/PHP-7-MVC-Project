<?php

namespace App\Models;

use App\Core\Model as Model;

class Product extends Model
{
	private $table = "products";

	// object properties
	protected $id; // Category id
	protected $cid; // Sub category id
	protected $name; // Name
	protected $description; // Description
	protected $status; // Description
	protected $search; // Search query
	protected $records; // Total number of records
	protected $page; // Total records per page
	
	function create() {
		
		// insert product query
		$query = "INSERT INTO
				" . $this->table . "
			SET
				name=:name,
				description = :description,
				category_id = :category_id,
				created = :created,
				active_until = :active_until";
	}
	
	function readOne() {

		// select all products query
		$query = "SELECT
				id, 
				name, 
				description, 
				category_id, 
				status
			FROM 
				" . $this->table . "
			WHERE
				id = :id
			LIMIT 
				?, ?";
		
		$this->search;		
		$this->records;
		$this->page;
	}
	
	function readAll() {
		
		// select all products query
		$query = "SELECT
				id, 
				name, 
				description, 
				category_id, 
				status
			FROM 
				" . $this->table . "
			ORDER BY 
				name ASC
			LIMIT 
				?, ?";
		
		$this->search;		
		$this->records;
		$this->page;
	}
	
	function readAllByCategory () {
		
		// select all products query
		$query = "SELECT
				id, 
				name, 
				description, 
				category_id, 
				status
			FROM 
				" . $this->table . "
			WHERE
				category_id = :category_id
			ORDER BY 
				name ASC
			LIMIT 
				?, ?";
	}
	
	function update() {
		
		// product update query
		$query = "UPDATE
				" . $this->table . "
			SET
				name = :name,
				description = :description,
				category_id  = :category_id,
				status  = :status
			WHERE
				id = :id";
	}
	
	function delete() {
		
		// delete product query
		$query = "DELETE FROM
			 	" . $this->table . " 
			 WHERE 
			 	id = ?";
	}
	
	function search() {
		
		// select all products query
		$query = "SELECT
				id, 
				name, 
				description, 
				category_id, 
				status
			FROM 
				" . $this->table . "
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
	
	function countAll() {
	
		// query to count all product records
		$query = "SELECT 
				count(*) 
			FROM 
				" . $this->table;

	}
}