<?php

namespace App\Models;

use App\Core\Model as Model;

class Article extends Model
{
	private $table = "articles";

	// object properties
	protected $id; // Article id
	protected $sid; // Category id
	protected $uid; // User id
	protected $status; // Status
	protected $title; // Title
	protected $slug; // Slug
	protected $content; // Content
	protected $description; // Description
	protected $search; // Search query
	protected $records; // Total number of records
	protected $page; // Total records per page

	function create()
	{
		// insert product query
		$query =
			"INSERT INTO
				" .
			$this->table .
			"
			SET
				title = :title,
				slug = :slug,
				description = :description,
				content = :content,
				user_id = :user_id,
				subject_id = :subject_id,
				status = :status,
				created = :created";
	}

	function readOne()
	{
		// select all products query
		$query =
			"SELECT
				id,
				title,
				slug,
				content,
				description,
				user_id,
				subject_id,
				status
			FROM
				" .
			$this->table .
			"
			WHERE
				id = :id
			LIMIT
				0, 1";

		$this->search;
	}

	function readAll()
	{
		// select all products query
		$query =
			"SELECT
				id,
				title,
				slug,
				content,
				description,
				user_id,
				subject_id,
				status
			FROM
				" .
			$this->table .
			"
			ORDER BY
				name ASC
			LIMIT
				?, ?";

		$this->search;
		$this->records;
		$this->page;
	}

	function readAllBySubject()
	{
		// select all products query
		$query =
			"SELECT
				id,
				title,
				slug,
				content,
				description,
				user_id,
				subject_id,
				status
			FROM
				" .
			$this->table .
			"
			WHERE
				subject_id = :subject_id
			ORDER BY
				name ASC
			LIMIT
				?, ?";

		$this->records;
		$this->page;
	}

	function update()
	{
		// product update query
		$query =
			"UPDATE
				" .
			$this->table .
			"
			SET
				title = :title,
				slug = :slug,
				description = :description,
				content = :content,
				user_id  = :user_id,
				subject_id = :subject_id,
				status  = :status
			WHERE
				id = :id";
	}

	function delete()
	{
		// delete product query
		$query =
			"DELETE FROM
			 	" .
			$this->table .
			"
			 WHERE
			 	id = ?";
	}

	function search()
	{
		// select all products query
		$query =
			"SELECT
				id,
				title,
				slug,
				content,
				description,
				subject_id,
				user_id,
				status
			FROM
				" .
			$this->table .
			"
			WHERE
				title LIKE ?
			ORDER BY
				name ASC
			LIMIT
				?, ?";

		$this->search;
		$this->records;
		$this->page;
	}

	function countAll()
	{
		// query to count all product records
		$query =
			"SELECT
				count(*)
			FROM
				" . $this->table;
	}
}
