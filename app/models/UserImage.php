<?php

namespace App\Models;

use App\Core\Model as Model;

class UserImage extends Model
{
	private $image_table = "user_images";

	public $id;
	public $uid;
	public $name;
	public $description;

	public function upload()
	{
		if (!isset($_FILES["files"])) {
			$this->validate->errors[] = "There is no file to upload.";
			$this->errors = $this->validate->displayErrors();
			$this->getErrors();
			return false;
		}

		$allowedTypes = [
			"image/png" => "png",
			"image/jpeg" => "jpg",
			"image/jpeg" => "jpeg",
		];

		// Loop through all the inputed $_FILES
		foreach ($_FILES["files"]["tmp_name"] as $key => $value) {
			$error = $_FILES["files"]["error"][$key];
			$filepath = $_FILES["files"]["tmp_name"][$key];
			$fileSize = filesize($filepath);
			$fileinfo = finfo_open(FILEINFO_MIME_TYPE);
			$filetype = finfo_file($fileinfo, $filepath);

			// Undefined | Multiple Files | $_FILES Corruption Attack
			// If this request falls under any of them, treat it invalid.
			if (!isset($error) || is_array($error)) {
				$this->validate->errors[] =
					"Invalid upload parameter, error occured.";
				continue;
			}

			if ($fileSize === 0) {
				$this->validate->errors[] = "The file is empty.";
				continue;
			}

			// Check $_FILES['upfile']['error'] value.
			switch ($error) {
				case UPLOAD_ERR_OK:
					break;
				case UPLOAD_ERR_NO_FILE:
					throw new RuntimeException("No file sent.");
				case UPLOAD_ERR_INI_SIZE:
				case UPLOAD_ERR_FORM_SIZE:
					throw new RuntimeException("Exceeded filesize limit.");
				default:
					throw new RuntimeException("Unknown errors.");
			}

			// if no errors were found
			if ($error == 0) {
				if ($fileSize > 3145728) {
					// 3 MB (1 byte * 1024 * 1024 * 3 (for 3 MB))
					$this->validate->errors[] = "The file is too large";
					continue;
				}

				if (!in_array($filetype, array_keys($allowedTypes))) {
					$this->validate->errors[] = "File format not allowed.";
					continue;
				}
			}

			if ($this->validate->isSuccess()) {
				// I'm using the original name here, but you can also change the name of the file here
				$filename = bin2hex(random_bytes(32));
				// $filename = basename($filepath);

				// Set file extension
				$extension = $allowedTypes[$filetype];

				// The name of the directory that we need to create.
				$targetDirectory = UPLOAD_DIR . DS . "users" . DS . $this->uid;

				// Check if the directory already exists.
				if (!is_dir($targetDirectory)) {
					// Directory does not exist, so lets create it.
					mkdir($targetDirectory, 0755, true);
				}

				// New file path
				$newFilepath =
					$targetDirectory . DS . $filename . "." . $extension;
				$this->name = $filename . "." . $extension;

				if (!copy($filepath, $newFilepath)) {
					// Copy the file, returns false if failed
					$this->validate->errors[] = "Can't move file.";
					continue;
				}

				unlink($filepath); // Delete the temp file						// save name to database

				// add successfully uploaded image to database
				$this->create();
			} else {
				$this->errors = $this->validate->displayErrors();
				$this->getErrors();
				return false;
			}
		}

		return true;
	}

	public function remove()
	{
		// The name of the directory that we need to create.
		$filepath =
			UPLOAD_DIR . DS . "users" . DS . $this->uid . DS . $this->name;

		if (unlink($filepath)) {
			return true;
		}

		return false;
	}

	public function create()
	{
		// Set timestamp for the created record
		$this->setTimeStamp();

		// insert query
		$query =
			"INSERT INTO
					" .
			$this->image_table .
			"
				SET
					name = :name,
					description = :description,
					user_id = :user_id,
					created = :created";

		// Prepare prepared statement
		$this->db->prepare($query);

		// Bind values
		$this->db->bind(":name", $this->name);
		$this->db->bind(":description", $this->description);
		$this->db->bind(":user_id", $this->uid);
		$this->db->bind(":created", $this->timestamp);

		$result = $this->db->execute();

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
			$this->image_table .
			"
			WHERE
				user_id = :user_id
			ORDER BY
				created DESC";

		// prepare query statement
		$this->db->prepare($query);

		$this->db->bind(":user_id", $this->uid);

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
			$this->image_table .
			"
			WHERE
				user_id = ?
			ORDER BY
				created DESC
			LIMIT
				?, ?";

		// prepare query statement
		$this->db->prepare($query);

		// bind limit clause variables
		$this->db->bind(1, $this->uid);
		$this->db->bind(2, (int) $records);
		$this->db->bind(3, (int) $perPage);

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
				" .
			$this->image_table .
			"
			WHERE
				user_id = ?";

		$this->db->prepare($query);

		$this->db->bind(1, $this->uid);

		// execute the query
		$this->db->execute();

		$result = $this->db->fetch();

		return (int) $result["count"];
	}

	// read variation details
	public function readFirst()
	{
		// Set prepared query to be preformed
		$query =
			"SELECT *
			FROM
				" .
			$this->image_table .
			"
			WHERE
				user_id = ?
			ORDER BY
				name DESC
			LIMIT
				0,1";

		// Prepare query statement
		$this->db->prepare($query);

		// Bind values
		$this->db->bind(1, $this->uid);

		// Execute and fetch row
		$row = $this->db->fetch();

		// Return row
		return $row;
	}

	// read variation details
	public function readOne()
	{
		// Set prepared query to be preformed
		$query =
			"SELECT *
			FROM
				" .
			$this->image_table .
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

	public function update()
	{
		// Set timestamp for the created record
		$this->setTimeStamp();

		// Prepared query statement
		$query =
			"UPDATE
				" .
			$this->image_table .
			"
			SET
				description = :description,
				modified = :modified
			WHERE
				id = :id";

		// Prepare prepared query statement
		$this->db->prepare($query);

		// Bind values
		$this->db->bind(":description", $this->description);
		$this->db->bind(":modified", $this->timestamp);
		$this->db->bind(":id", $this->id);

		// Execute query
		$result = $this->db->execute();

		// Return result
		return $result;
	}

	public function delete()
	{
		// Prepared query statement
		$query =
			"DELETE FROM
				" .
			$this->image_table .
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
			$this->image_table .
			"
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
