<?php

namespace App\Controllers;

use App\Core\Controller;

class cartController extends Controller
{
	protected $pageTitle;
	protected $pageUrl;
	protected $pageData;
	protected $message;
	protected $csrf;

	// Read all cart items
	function index()
	{
		$this->pageTitle = "All Products";
		$this->pageUrl = DOMAIN . "products/";

		// Get user_id from session
		$user_id = $this->session->getSessionValue("user_id");

		// Set cart model user id
		$this->cartItemModel->uid = $user_id;

		$count = $this->cartItemModel->countAll();
		$cartItems = $this->cartItemModel->readAll();

		$cartList = [];

		// Loop over the array of products
		foreach ($cartItems as $item) {
			$this->productModel->id = $item["product_id"];
			$product = $this->productModel->readOne();

			$this->typeModel->id = $item["type_id"];
			$type = $this->typeModel->readOne();

			$this->categoryModel->id = $product["category_id"];
			$category = $this->categoryModel->readOne();

			$this->imageModel->pid = $product["id"];
			$image = $this->imageModel->readFirst();

			$cartList[] = [
				"id" => $item["id"],
				"quantity" => $item["quantity"],
				"product" => $product,
				"image" => $image,
				"type" => $type,
				"category" => $category,
				"created" => $item["created"],
			];
		}

		$this->pageData = [
			"csrf" => $this->session->getSessionValue("csrf"),
			"cart" => $cartList,
		];

		$this->view("cart", [
			"pageTitle" => $this->pageTitle,
			"pageUrl" => $this->pageUrl,
			"pageData" => $this->pageData,
		]);
	}

	// Add to cart
	function creat($vars = null)
	{
		if ($vars["pid"] && $vars["tid"]) {
			// Get user_id from session
			$user_id = $this->session->getSessionValue("user_id");

			$quantity = $vars["quantity"] ? $vars["quantity"] : 1;

			// Set & clean post => model values
			$this->cartItemModel->uid = $user_id;
			$this->cartItemModel->pid = $vars["pid"];
			$this->cartItemModel->tid = $vars["tid"];
			$this->cartItemModel->quantity = $quantity;

			if ($this->cartItemModel->validateCreate()) {
				$this->cartItemModel->create();
				redirect("cart");
			} else {
				$item = $this->cartItemModel->readByIds();

				$this->cartItemModel->quantity =
					intval($this->cartItemModel->quantity) +
					intval($item["quantity"]);

				$this->cartItemModel->id = $item["id"];

				$this->cartItemModel->update();

				redirect("cart");
				exit();
			}
		} else {
			redirect("cart");
			exit();
		}
	}

	// Update quantity
	function update()
	{
		$post = $this->filter_post();

		// Set CSRF token to be verified
		$this->session->csrf = $post["csrf"];

		if ($this->session->validateCSRF()) {
			foreach ($post["quantity"] as $item) {
				reset($post["quantity"]);

				$this->cartItemModel->id = key($post["quantity"]);
				$this->cartItemModel->quantity = (int) end($post["quantity"]);

				if ($this->cartItemModel->validateUpdate()) {
					$this->cartItemModel->update();
					redirect("cart");
				}
			}
		}
	}

	// Remove from cart
	function delete($vars = null)
	{
		if ($vars["id"]) {
			$this->cartItemModel->id = $vars["id"];
			$this->cartItemModel->delete();

			redirect("cart");
		}
	}

	// Empty cart
	function deleteAll()
	{
		// Get user_id from session
		$user_id = $this->session->getSessionValue("user_id");

		$this->cartItemModel->uid = $user_id;
		$this->cartItemModel->deleteAll();

		redirect("cart");
	}
}
