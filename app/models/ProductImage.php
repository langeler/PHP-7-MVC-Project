<?php

namespace App\Models;

use App\Core\Model as Model;

class ProductImage extends Model
{
	private $table = "product_images";

	protected $id;
    protected $product_id;
	protected $name;
	protected $description;
    protected $stock;
	
	function updateStock() {
		
		// product update query
		$query = "UPDATE
				" . $this->table . "
			SET
				stock = :stock
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

	// delete all the variations
	function deleteAll() {
		
		// delete product image query
		$query = "DELETE FROM 
				" . $this->table . " 
			WHERE 
				product_id = ?";
	}
	
	// update the variation
	function update() {

		// update query
		$query = "UPDATE 
				" . $this->table . "
			SET 
				name = :name, 
				price = :price, 
				stock = :stock
			WHERE 
				id = :id";
	}
	
	// create variation
	function create() {
	
		// insert query
		$query = "INSERT INTO 
			" . $this->table . "
			SET 
				product_id = :product_id, 
				name=:name, price = :price, 
				stock=:stock, created = :created";
	}
	
	// read variation details
	function readOne() {
		
		// select single record query
		$query = "SELECT 
				id, 
				product_id, 
				name, 
				price, 
				stock
			FROM 
				" . $this->table . "
			WHERE 
				id = ?
			LIMIT 
				0, 1";
	}
	
	function readAllByProduct() {
		
		// query select all variations
		$query = "SELECT 
				id, 
				product_id, 
				name, 
				price, 
				stock
			FROM 
				" . $this->table . "
			WHERE 
				product_id = :product_id
			ORDER BY 
				id";
	}
	
	public function countAll() {
	
		// query to count all data
		$query = "SELECT 
				count(*) 
			FROM 
				" . $this->table;

	}
	
	// used to read variation name by its ID
	function readName() {

		// select single record query
		$query = "SELECT 
				name 
			FROM 
				" . $this->table . " 
			WHERE 
				id = ? 
			LIMIT 
				0, 1";
	}
}