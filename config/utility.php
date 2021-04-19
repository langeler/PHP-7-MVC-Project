<?php

/**
 * Get URI path.
 * Return a string.
 */
function getUri()
{
	$uri = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), DS);

	return $uri;
}

/** Get request method.
 * Return a string.
 */
function getMethod()
{
	$method = $_SERVER["REQUEST_METHOD"];

	return $method;
}

function cleanString($value) 
{					
	$value = trim($value);

	$value = htmlspecialchars($value, ENT_QUOTES | ENT_HTML5);

	if(!$value) {
		$value = null;
	}
	
	return $value;
}

/**
 * 
 */
function dd($value)
{
	echo "<pre>";

	die(var_dump($value));
	
	echo "</pre>";
}