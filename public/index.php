<?php

define("ROOT_DIR", dirname(__DIR__, 1));

require ROOT_DIR . "/vendor/autoload.php";

use App\Core\{Router, Request};

//This is where we load the routes from the routes file.
Router::load(APP_DIR . DS . "routes.php")->direct(
	Request::uri(),
	Request::method()
);
