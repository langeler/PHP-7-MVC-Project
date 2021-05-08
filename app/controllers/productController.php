<?php

namespace App\Controllers;

use App\Core\Controller;

class productController extends Controller
{
	protected $pageTitle;
	protected $pageUrl;
	protected $pageData;
	protected $message;
	protected $csrf;

	function index($vars = null)
	{
		if ($vars["id"]) {
			$this->productModel->id = $vars["id"];
			$this->pImageModel->pid = $vars["id"];
			$this->categoryModel->pid = $vars["id"];
			$this->typeModel->pid = $vars["id"];

			// Set variables for easy access
			$product = $this->productModel->readOne();
			$image = $this->pImageModel->readAll();
			$types = $this->typeModel->readAll();

			// Read category one category based on category id from product
			$this->categoryModel->id = $product["category_id"];

			// Set variable for easy access
			$category = $this->categoryModel->readOne();

			$this->pageTitle = "Update Product";
			$this->pageUrl = DOMAIN . "product/" . $this->productModel->id;

			// dd($_SESSION);

			// Set page data with variables
			$this->pageData = [
				"csrf" => $this->session->getSessionValue("csrf"),
				"product" => $product,
				"images" => $image,
				"types" => $types,
				"category" => $category,
			];

			$this->view("product", [
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
