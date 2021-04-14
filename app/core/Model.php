<?php

/**
 * Model Class
 *
 * Create a new instance of the Database class.
 *
 * The Model class is an abstract class that creates
 * a new instance of the Database class, allowing us
 * to interact with the database without having to create
 * a new instance in each class.
 */
namespace App\Core;

abstract class Model
{
	protected $db;
	protected $errors = [];
	protected $timestamp;

	public function __construct()
	{
		$this->db = new Database();
	}
	
	// used for the 'created' field when creating a product
	function getTimeStamp() {
		return $this->timestamp;
	}
	
	function setTimeStamp() {
		$this->timestamp = date('Y-m-d H:i:s');
	}

	// add an error for an attribute if the validation fails
	public function addError($attribute, $error) { 
		$this->errors[$attribute] = $error;
	}

	// get the error for an attribute
	public function getError($attribute) { 
		return (isset($this->errors[$attribute])) ? $this->_errors[$attribute] : '';
	}

	// get all errors for all attributes
	public function getErrors() {
		return $this->errors;       
	}
}
