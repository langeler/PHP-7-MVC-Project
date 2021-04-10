<?php

// Get routes
$router->get("", "LandingController@get");
$router->get("about", "AboutController@get");
$router->get("404", "ExceptionNotFoundController@get");

// Get logged out routes
$router->get("forgot-password", "ForgotPasswordController@get");
$router->get("reset-password", "ResetPasswordController@get");
$router->get("create-password", "CreatePasswordController@get");
$router->get("login", "LoginController@get");
$router->get("register", "RegisterController@get");

// Get logged in routes
$router->get("dashboard", "DashboardController@get");
$router->get("logout", "LogoutController@get");
$router->get("profile", "UserProfileController@get");
$router->get("settings", "SettingsController@get");

// Post logged out routes
$router->post("create-password", "CreatePasswordController@post");
$router->post("forgot-password", "ForgotPasswordController@post");
$router->post("login", "LoginController@post");
$router->post("register", "RegisterController@post");
$router->post("reset-password", "ResetPasswordController@post");
$router->post("settings", "SettingsController@post");

// Get admin pages
$router->get("admin/home", "adminController@home");

// Get admin category routes
$router->get("admin/categories", "adminController@readAllCategories");
$router->get("admin/category/create", "adminController@readCategory");
$router->get("admin/category/update/{id}", "adminController@readOneCategory");
$router->get("admin/category/delete/{id}", "adminController@deleteCategory");

// Post admin category routes
$router->post("admin/category/create", "adminController@createCategory");
$router->post("dmin/category/update/{id}", "adminController@updateCategory");

// Get admin user routes
$router->get("admin/users", "adminController@readAllUsers");
$router->get("admin/user/create", "adminController@readUser");
$router->get("admin/user/update/{id}", "adminController@readOneUser");
$router->get("admin/user/delete/{id}", "adminController@deleteUser");

// Post admin user routes
$router->post("admin/user/create", "adminController@createUser");
$router->post("admin/user/update/{id}", "adminController@updateUser");
