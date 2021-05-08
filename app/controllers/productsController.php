<?php

namespace App\Controllers;

use App\Core\Controller;

class productsController extends Controller
{
	protected $pageTitle;
	protected $pageUrl;
	protected $pageData;
	protected $message;
	protected $csrf;

	function index()
	{
		$get = $this->filter_get();

		$this->pageTitle = "All Products";
		$this->pageUrl = DOMAIN . "products/";

		// Pagination
		$page = isset($get["page"]) ? $get["page"] : 1;
		$search = isset($get["search"]) ? $get["search"] : "";

		// Pagination settings
		$perPage = 10;
		$displayArrows = true;
		$fromRecords = $perPage * $page - $perPage;

		// If a search is made
		if ($search) {
			$records = $this->productModel->countAllBySearch($search);
			$products = $this->productModel->searchWithPaging(
				$search,
				$fromRecords,
				$perPage
			);
		}

		// If no search is made
		else {
			$records = $this->productModel->countAll();
			$products = $this->productModel->readAllWithPaging(
				$fromRecords,
				$perPage
			);
		}

		// Product list array, containing all relevant product, type and image data
		$productList = [];

		// Loop over the array of products
		foreach ($products as $product) {
			$this->categoryModel->id = $product["category_id"];
			$category = $this->categoryModel->readOne();

			$this->pImageModel->pid = $product["id"];
			$image = $this->pImageModel->readFirst();

			$this->typeModel->pid = $product["id"];
			$types = $this->typeModel->readAll();

			$productList[] = [
				"id" => $product["id"],
				"name" => $product["name"],
				"description" => $product["description"],
				"image" => $image,
				"types" => $types,
				"category" => $category,
				"created" => $product["created"],
			];
		}

		// Pagination variable
		$pagination = $this->pagination->paging(
			$records,
			$this->pageUrl,
			$page,
			$perPage,
			$displayArrows
		);

		$this->pageData = [
			"search" => $search,
			"products" => $productList,
			"pagination" => $pagination,
		];

		$this->view("products", [
			"pageTitle" => $this->pageTitle,
			"pageUrl" => $this->pageUrl,
			"pageData" => $this->pageData,
		]);
	}
}
