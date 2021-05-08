<?php

namespace App\Controllers;

use App\Core\Controller;

class categoryController extends Controller
{
	protected $pageTitle;
	protected $pageUrl;
	protected $pageData;
	protected $message;
	protected $csrf;

	function index($vars = null)
	{
		if ($vars["id"]) {
			$this->productModel->cid = $vars["id"];
			$this->categoryModel->id = $vars["id"];
			$category = $this->categoryModel->readOne();

			$get = $this->filter_get();

			$this->pageTitle = $category["name"];
			$this->pageUrl =
				DOMAIN .
				"category/" .
				$category["id"] .
				"/" .
				$category["name"];

			// Pagination
			$page = isset($get["page"]) ? $get["page"] : 1;
			$search = isset($get["search"]) ? $get["search"] : "";

			// Pagination settings
			$perPage = 10;
			$displayArrows = true;
			$fromRecords = $perPage * $page - $perPage;

			// If a search is made
			if ($search) {
				$records = $this->productModel->countAllByCategorySearch(
					$search
				);
				$products = $this->productModel->searchByCategoryWithPaging(
					$search,
					$fromRecords,
					$perPage
				);
			}

			// If no search is made
			else {
				$records = $this->productModel->countAllByCategory();
				$products = $this->productModel->readAllByCategoryWithPaging(
					$fromRecords,
					$perPage
				);
			}

			// Product list array, containing all relevant product, type and image data
			$productList = [];

			// Loop over the array of products
			foreach ($products as $product) {
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
				"category" => $category,
				"pagination" => $pagination,
			];

			$this->view("category", [
				"pageTitle" => $this->pageTitle,
				"pageUrl" => $this->pageUrl,
				"pageData" => $this->pageData,
			]);
		}
	}
}
