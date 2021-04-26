<?php

namespace App\Models;

use App\Core\Model as Model;

class CartItem extends Model
{
	private $cart_table = "cart_items";
	
	// object properties
	public $id; // Cart item id
	public $uid; // User id
	public $pid; // Produt id
	public $tid; // Type id
	public $quantity; // Quantity
	
	public function create() {
		
		// Set timestamp for the created record
		$this->setTimeStamp();
		
        // insert query
        $query = "INSERT INTO
                    " . $this->cart_table . "
                SET
					user_id = :user_id,
					product_id = :product_id,
					type_id = :type_id,
					quantity = :quantity,
					created = :created";

		// Prepare prepared statement
		$this->db->prepare($query);
		
		// Bind values
		$this->db->bind(":user_id", $this->uid);
		$this->db->bind(":product_id", $this->pid);
		$this->db->bind(":type_id", $this->tid);
		$this->db->bind(":quantity", $this->quantity);		
		$this->db->bind(":created", $this->timestamp);
		
		$result = $this->db->execute();

		return $result;
	}
	
	// read all user rows from the database
	public function readAll() {

		// query to read all users
		$query = "SELECT *
			FROM 
				" . $this->cart_table . "
			ORDER BY 
				created DESC
			WHERE
				user_id = ?";

		// prepare query statement
		$this->db->prepare($query);

		// execute query
		$result = $this->db->fetchAll();

		// return values
		return $result;
	}
	
	public function countAll() {

		$query = "SELECT 
			COUNT(*) as count
			FROM 
				" . $this->cart_table . "
			WHERE
				user_id = ?";

		$this->db->prepare($query);
	
		// execute the query
		$this->db->execute();

		$result = $this->db->fetch();

		return (int)$result['count'];
	}
	
	public function readOne()
	{
		// Set prepared query to be preformed
		$query = "SELECT * 
			FROM 
				" . $this->cart_table . "
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
	
	public function update()
	{	
		// Set timestamp for the created record
		$this->setTimeStamp();
				
		// Prepared query statement
		$query = "UPDATE 
				" . $this->cart_table . " 
			SET 
				quantity = :quantity,
				modified = :modified
			WHERE 
				id = :id";

		// Prepare prepared query statement
		$this->db->prepare($query);
		
		// Bind values
		$this->db->bind(":quantity", $this->quantity);
		$this->db->bind(":id", $this->id);
		
		// Execute query
		$result = $this->db->execute();

		// Return result
		return $result;
	}
	
	public function updateUser() {
		
		// Set timestamp for the created record
		$this->setTimeStamp();
		
		// Session user id (temporary if logged out).
		$session_id = $this->session->getSessionValue('user_id');
				
		// Prepared query statement
		$query = "UPDATE 
				" . $this->cart_table . " 
			SET 
				user_id = ?
			WHERE 
				user_id = ?";

		// Prepare prepared query statement
		$this->db->prepare($query);
		
		// Bind values
		$this->db->bind(1, $this->uid);
		$this->db->bind(2, $session_id);
		
		// Execute query
		$result = $this->db->execute();

		// Return result
		return $result;
	}
	
	public function delete() {
	
		// Prepared query statement
		$query = "DELETE FROM 
				" . $this->cart_table . " 
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
	
	public function deleteAll() {
	
		// Prepared query statement
		$query = "DELETE FROM 
				" . $this->cart_table . " 
			WHERE 
				user_id = :user_id";

		// Prepare prepared query statement
		$this->db->prepare($query);
		
		// Bind value
		$this->db->bind(":user_id", $this->uid);
		
		// Execute query
		$result = $this->db->execute();

		// Return result
		return $result;
	}
}