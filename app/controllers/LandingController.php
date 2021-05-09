<?php
namespace App\Controllers;

use App\Core\Controller as Controller;

class LandingController extends Controller
{
	protected $pageTitle;
	protected $pageUrl;
	protected $pageData;

	public function get()
	{
		$this->pageTitle = "Landing";
		$this->pageUrl = DOMAIN;

		$categories = $this->categoryModel->readAll();

		// Category list array, containing all relevant category image data
		$categoryList = [];

		// Loop over the array of products
		foreach ($categories as $category) {
			$this->cImageModel->cid = $category["id"];
			$image = $this->cImageModel->readFirst();

			$categoryList[] = [
				"id" => $category["id"],
				"name" => $category["name"],
				"description" => $category["description"],
				"image" => $image,
				"created" => $category["created"],
			];
		}

		$this->pageData = [
			"categories" => $categoryList,
		];

		$this->view("landing", [
			"pageTitle" => $this->pageTitle,
			"pageUrl" => $this->pageUrl,
			"pageData" => $this->pageData,
		]);
	}
}
