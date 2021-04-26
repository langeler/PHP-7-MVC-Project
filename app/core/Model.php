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

use App\Core\Database;
use App\Core\Validate;
use App\Core\Session;

abstract class Model
{
	protected $db;
	protected $session;
	protected $validate;
	protected $timestamp;

	public $errors;

	public function __construct()
	{
		$this->db = new Database();
		$this->session = new Session();
		$this->validate = new Validate();
	}

	// used for the 'created' field when creating a product
	function getTimeStamp()
	{
		return $this->timestamp;
	}

	function setTimeStamp()
	{
		$this->timestamp = date("Y-m-d H:i:s");
	}

	// get all errors for all attributes
	public function getErrors()
	{
		return $this->errors;
	}
}
