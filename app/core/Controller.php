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
use App\Models\CategoryImage;
use App\Models\Contact;
use App\Models\Options;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Questions;
use App\Models\Subject;
use App\Models\Types;
use App\Models\TypeImage;
use App\Models\User;
use App\Models\UserImage;

abstract class Controller
{
	protected $pagination;
	protected $session;

	protected $article;
	protected $cartItemModel;
	protected $categoryModel;
	protected $cImageModel;
	protected $contact;
	protected $optionModel;
	protected $order_item;
	protected $order;
	protected $productModel;
	protected $pImageModel;
	protected $questionModel;
	protected $subject;
	protected $typeModel;
	protected $tImageModel;
	protected $userModel;
	protected $uImageModel;
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
		$this->cImageModel = new CategoryImage();
		$this->contact = new Contact();
		$this->optionModel = new Options();
		$this->order_item = new OrderItem();
		$this->order = new Order();
		$this->productModel = new Product();
		$this->pImageModel = new ProductImage();
		$this->questionModel = new Questions();
		$this->subject = new Subject();
		$this->typeModel = new Types();
		$this->tImageModel = new TypeImage();
		$this->userModel = new User();
		$this->uImageModel = new UserImage();
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

	// get string slug, used for product names in URLs
	public function slugify($string, $separator = "-")
	{
		setlocale(LC_ALL, "en_US.UTF8");

		// remove double quote
		$string = str_replace("\"", "", $string);

		// remove single quote
		$string = str_replace("'", "", $string);

		// remove dots
		$string = str_replace(".", "", $string);

		// do the slug
		$accents_regex =
			"~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i";
		$special_cases = ["&" => "and"];
		$string = mb_strtolower(trim($string), "UTF-8");
		$string = str_replace(
			array_keys($special_cases),
			array_values($special_cases),
			$string
		);
		$string = preg_replace(
			$accents_regex,
			'$1',
			htmlentities($string, ENT_QUOTES, "UTF-8")
		);
		$string = preg_replace("/[^a-z0-9]/u", "$separator", $string);
		$string = preg_replace("/[$separator]+/u", "$separator", $string);

		return $string;
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

	// send email using built in php mailer
	protected function sendEmailViaPhpMail(
		$from_name,
		$from_email,
		$to_email,
		$subject,
		$body
	) {
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= "From: {$from_name} <{$from_email}> \n";

		if (mail($to_email, $subject, $body, $headers)) {
			return true;
		} else {
			echo "<pre>";
			print_r(error_get_last());
			echo "</pre>";
		}

		return false;
	}

	// function to generate a random token
	protected function random()
	{
		if (function_exists("random_bytes")) {
			$token = bin2hex(random_bytes(32));
		} elseif (function_exists("mcrypt_create_iv")) {
			$token = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
		} else {
			$token = bin2hex(openssl_random_pseudo_bytes(32));
		}

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

		return DOMAIN . DS . "assets" . DS . "js" . DS . $file . ".js";
	}

	/**
	 * Shortcut to retrieve Library script file from the /libs/ directory.
	 * Returns a URL.
	 */
	protected function getLibScript($filename)
	{
		$file = strtolower($filename);

		return DOMAIN . DS . "assets" . DS . "libs" . DS . $file . ".js";
	}

	/**
	 * Shortcut to retrieve Library style file from the /libs/ directory.
	 * Returns a URL.
	 */
	protected function getLibStyle($filename)
	{
		$file = strtolower($filename);

		return DOMAIN . DS . "assets" . DS . "libs" . DS . $file . ".css";
	}

	/**
	 * Shortcut to retrieve stylesheet file from the /css/ directory.
	 * Returns a URL.
	 */
	protected function getStylesheet($filename)
	{
		$file = strtolower($filename);

		return DOMAIN . DS . "assets" . DS . "css" . DS . $file . ".css";
	}

	/**
	 * Shortcut to retrieve image file from the /images/ directory.
	 * Returns a URL.
	 */
	protected function getImage($filename)
	{
		$file = strtolower($filename);

		return DOMAIN . DS . "assets" . DS . "img" . DS . $file;
	}
}
