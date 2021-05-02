<?php

/**
 * Controller Class
 *
 * Connects the database and session models to the front-end views
 */
namespace App\Core;

use App\Core\Pagination;
use App\Core\Session;

use App\Models\Article;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Subject;
use App\Models\Types;
use App\Models\User;

abstract class Controller
{
	protected $pagination;
	protected $session;

	protected $article;
	protected $cartItemModel;
	protected $categoryModel;
	protected $contact;
	protected $order_item;
	protected $order;
	protected $productModel;
	protected $pImageModel;
	protected $subject;
	protected $typeModel;
	protected $userModel;
	protected $pageTitle;

	/**
	 * Initialize controller with Session, User, Comment, and List classes.
	 */
	public function __construct()
	{
		$this->pagination = new Pagination();
		$this->session = new Session();

		$this->article = new Article();
		$this->cartItemModel = new CartItem();
		$this->categoryModel = new Category();
		$this->contact = new Contact();
		$this->order_item = new OrderItem();
		$this->order = new Order();
		$this->productModel = new Product();
		$this->imageModel = new ProductImage();
		$this->subject = new Subject();
		$this->typeModel = new Types();
		$this->userModel = new User();
	}

	/**
	 * Get filtered $_POST values.
	 * Return an array.
	 */
	protected function filter_post()
	{
		$post = filter_input_array(INPUT_POST);
		$post = array_map("clean", $post);

		return $post;
	}

	/**
	 * Get filtered $_GET values.
	 * Return an array.
	 */
	protected function filter_get()
	{
		$get = filter_input_array(INPUT_GET);
		$get = array_map("clean", $get);

		return $get;
	}

	/**
	 * Retrieve a view URL by filename.
	 * Requires a file.
	 */
	protected function view($view, $data = [])
	{
		$view = strtolower($view);
		extract($data, EXTR_SKIP);

		// Check for view file
		if (file_exists(VIEW_DIR . DS . $view . ".view.php")) {
			require_once VIEW_DIR . DS . $view . ".view.php";
		} else {
			die("View does not exist!");
		}
	}

	// Custom view templating engine, with cache support
	// function view($file, $arr = [])
	// {
	// View::make($file, $arr);
	// }

	/**
	 * Check if the current page is the Index.
	 * Returns a Boolean.
	 */
	protected function isIndex()
	{
		$redirect = ltrim($_SERVER["REDIRECT_URL"], DS);

		return $redirect === "";
	}

	/**
	 * Check if the current page is specified page.
	 * Returns a Boolean.
	 */
	protected function isPage($view)
	{
		$view = strtolower($view);

		$redirect = ltrim($_SERVER["REDIRECT_URL"], DS);

		return $redirect === $view;
	}

	// Function to read all categories
	protected function getCategories()
	{
		$categories = $this->categoryModel->readAll();

		return $categories;
	}

	protected function isUserLoggedIn()
	{
		return $this->session->isUserLoggedIn();
	}

	protected function isAdmin()
	{
		return $this->session->isAdmin();
	}

	// function to generate a random token
	protected function random()
	{
		// generate random token
		$token = bin2hex(random_bytes(32));

		// return the token
		return $token;
	}

	/**
	 * Shortcut to retrieve JavaScript file from the /js/ directory.
	 * Returns a URL.
	 */
	protected function getScript($filename)
	{
		$file = strtolower($filename);

		return PROTOCOL . $_SERVER["HTTP_HOST"] . "/assets/js/" . $file . ".js";
	}

	/**
	 * Shortcut to retrieve Library script file from the /libs/ directory.
	 * Returns a URL.
	 */
	protected function getLibScript($filename)
	{
		$file = strtolower($filename);

		return PROTOCOL .
			$_SERVER["HTTP_HOST"] .
			"/assets/libs/" .
			$file .
			".js";
	}

	/**
	 * Shortcut to retrieve Library style file from the /libs/ directory.
	 * Returns a URL.
	 */
	protected function getLibStyle($filename)
	{
		$file = strtolower($filename);

		return PROTOCOL .
			$_SERVER["HTTP_HOST"] .
			"/assets/libs/" .
			$file .
			".css";
	}

	/**
	 * Shortcut to retrieve stylesheet file from the /css/ directory.
	 * Returns a URL.
	 */
	protected function getStylesheet($filename)
	{
		$file = strtolower($filename);

		return PROTOCOL .
			$_SERVER["HTTP_HOST"] .
			"/assets/css/" .
			$file .
			".css";
	}

	/**
	 * Shortcut to retrieve image file from the /images/ directory.
	 * Returns a URL.
	 */
	protected function getImage($filename)
	{
		$file = strtolower($filename);

		return PROTOCOL . $_SERVER["HTTP_HOST"] . "/assets/img/" . $file;
	}
}
