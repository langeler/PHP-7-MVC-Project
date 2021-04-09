<?php

/**
 * Controller Class
 * 
 * Connects the database and session models to the front-end views
 */
namespace App\Core;

use App\Models\Admin;
use App\Models\Comment;
use App\Models\ListClass;
use App\Models\Session;
use App\Models\User;

abstract class Controller
{
    protected $pageTitle;
    protected $message;
    protected $session;
    protected $userControl;
    protected $list;
    protected $admin;

    /**
     * Initialize controller with Session, User, Comment, and List classes.
     */
    public function __construct()
    {
        $this->admin = new Admin();
        $this->session = new Session();
        $this->userControl = new User();
        $this->list = new ListClass();
        $this->comment = new Comment();
    }

    public function escape($html)
    {
        return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    /**
     * Shortcut to retrieve JavaScript file from the /js/ directory.
     * Returns a URL.
     */
    protected function getScript($filename)
    {
        $file = strtolower($filename);

        return PROTOCOL . $_SERVER['HTTP_HOST'] . '/assets/js/' . $file . '.js';
    }
    
    /**
     * Shortcut to retrieve Library script file from the /libs/ directory.
     * Returns a URL.
     */
    protected function getLibScript($filename)
    {
        $file = strtolower($filename);

        return PROTOCOL . $_SERVER['HTTP_HOST'] . '/assets/libs/' . $file . '.js';
    }    
    
    /**
     * Shortcut to retrieve Library style file from the /libs/ directory.
     * Returns a URL.
     */
    protected function getLibStyle($filename)
    {
        $file = strtolower($filename);

        return PROTOCOL . $_SERVER['HTTP_HOST'] . '/assets/libs/' . $file . '.css';
    }

    /**
     * Shortcut to retrieve stylesheet file from the /css/ directory.
     * Returns a URL.
     */
    protected function getStylesheet($filename)
    {
        $file = strtolower($filename);

        return PROTOCOL . $_SERVER['HTTP_HOST'] . '/assets/css/' . $file . '.css';
    }

    /**
     * Shortcut to retrieve image file from the /images/ directory.
     * Returns a URL.
     */
    protected function getImage($filename)
    {
        $file = strtolower($filename);

        return PROTOCOL . $_SERVER['HTTP_HOST'] . '/assets/img/' . $file;
    }
    
    protected function post()
	{
		$args = func_get_args();

		if (count($args) == 1) {
			return isset($_POST[$args[0]]) ? $_POST[$args[0]] : null;
		}

		return $_POST;
	}

	protected function get()
	{
		$args = func_get_args();

		if (count($args) == 1) {
			return isset($_GET[$args[0]]) ? $_GET[$args[0]] : null;
		}

		return $_GET;
	}

    /**
     * Retrieve a view URL by filename.
     * Requires a file.
     */
    protected function view($view, $data = [])
    {
       
        $view = strtolower($view);

		extract($data, EXTR_SKIP);

        require_once VIEW_DIR . DS . $view . '.view.php';
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
        $redirect = ltrim($_SERVER['REDIRECT_URL'], DS);

        return $redirect === '';
    }

    /**
     * Check if the current page is specified page.
     * Returns a Boolean.
     */
    protected function isPage($view)
    {
        $view = strtolower($view);

        $redirect = ltrim($_SERVER['REDIRECT_URL'], DS);

        return $redirect === $view;
    }

    /**
     * Redirects to the specified page.
     */
    protected function redirect($view)
    {
        $view = strtolower($view);

        header('Location:' . DS . $view);
        exit;
    }

    /**
     * Securely hash a password.
     * Returns hashed password.
     */
    protected function encryptPassword($password)
    {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

        return $passwordHash;
    }

    /**
     * Vertify a submitted password against existing password.
     * Return a Boolean.
     */
    protected function verifyPassword($submittedPassword, $password)
    {
        $validPassword = password_verify($submittedPassword, $password);

        return $validPassword;
    }

    /**
     * Check if a username is in the list of disallowed usernames.
     * Return a Boolean.
     */
    protected function isApprovedUsername($username)
    {
        $approved = in_array($username, DISALLOWED_USERNAMES) ? false : true;

        return $approved;
    }

    /**
     * Check if username is empty, and make sure it only contains
     * alphanumeric characters, numbers, dashes, and underscores.
     * Return an error or null.
     */
    protected function validateUsername($username)
    {
        if (!empty($username)) {
            if (strlen($username) < '3') {
                $this->errors[] = USERNAME_TOO_SHORT;
            }
            if (strlen($username) > '50') {
                $this->errors[] = USERNAME_TOO_LONG;
            }
            // Match a-z, A-Z, 1-9, -, _.
            if (!preg_match("/^[a-zA-Z\d\-_]+$/i", $username)) {
                $this->errors[] = USERNAME_CONTAINS_DISALLOWED;
            }
        } else {
            $this->errors[] = USERNAME_MISSING;
        }
    }

    /**
     * Check if password is empty, and make sure it conforms
     * to password security standards.
     * Return an error or null.
     */
    protected function validatePassword($password)
    {
        if (!empty($password)) {
            if (strlen($password) < '8') {
                $this->errors[] = PASSWORD_TOO_SHORT;
            }
            if (!preg_match("#[0-9]+#", $password)) {
                $this->errors[] = PASSWORD_NEEDS_NUMBER;
            }
            if (!preg_match("#[A-Z]+#", $password)) {
                $this->errors[] = PASSWORD_NEEDS_UPPERCASE;
            }
            if (!preg_match("#[a-z]+#", $password)) {
                $this->errors[] = PASSWORD_NEEDS_LOWERCASE;
            }
        } else {
            $this->errors[] = PASSWORD_MISSING;
        }
    }

    /**
     * Check if email is empty, and test it against PHP built in
     * email validation.
     * Return an error or null.
     */
    protected function validateEmail($email)
    {
        if (!empty($email)) {
            // Remove all illegal characters from email
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);

            // Validate e-mail
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->errors[] = EMAIL_NOT_VALID;
            }
        } else {
            $this->errors[] = EMAIL_MISSING;
        }
    }

    /**
     * Get list of errors from validation.
     * Return a string.
     */
    protected function getErrors($errors)
    {
        foreach ($errors as $error) {
            $this->errorList .= $error . "\n";
        }
        return $this->errorList;
    }
}
