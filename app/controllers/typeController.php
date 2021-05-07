<?php

namespace App\Controllers;

use App\Core\Controller;

class typeController extends Controller
{
	protected $pageTitle;
	protected $pageUrl;
	protected $pageData;
	protected $message;
	protected $csrf;

	function index($vars = null)
	{
		if ($vars["pid"] && $vars["tid"]) {
			$this->productModel->id = $vars["pid"];
			$this->imageModel->pid = $vars["pid"];
			$this->categoryModel->pid = $vars["pid"];
			$this->typeModel->id = $vars["tid"];
			$this->questionModel->tid = $vars["tid"];

			// Set variables for easy access
			$product = $this->productModel->readOne();
			$image = $this->imageModel->readAll();
			$type = $this->typeModel->readOne();
			$questions = $this->questionModel->readAll();

			// Read category one category based on category id from product
			$this->categoryModel->id = $product["category_id"];

			// Set variable for easy access
			$category = $this->categoryModel->readOne();

			$this->pageTitle = "Update Product";
			$this->pageUrl = DOMAIN . "product/" . $this->productModel->id;

			// Set page data with variables
			$this->pageData = [
				"csrf" => $this->session->getSessionValue("csrf"),
				"product" => $product,
				"images" => $image,
				"types" => $type,
				"questions" => $questions,
				"options" => $options,
				"category" => $category,
			];

			$this->view("type", [
				"pageTitle" => $this->pageTitle,
				"pageUrl" => $this->pageUrl,
				"pageData" => $this->pageData,
			]);
		}
	}

	function post()
	{
		$post = $this->filter_post();

		// Set CSRF token to be verified
		$this->session->csrf = $post["csrf"];

		// Verify CSRF token
		if ($this->session->validateCSRF()) {
			$quantity = $post["quantity"] ? $post["quantity"] : 1;

			redirect(
				"cart/add/" .
					$post["product"] .
					"/" .
					$post["type"] .
					"/" .
					$quantity
			);
		}
	}
}
