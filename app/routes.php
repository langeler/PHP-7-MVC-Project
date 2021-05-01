<?php

// Get routes
$router->get("", "LandingController@get");
$router->get("about", "AboutController@get");
$router->get("401", "InternalExceptionController@get");
$router->get("404", "NotFoundExceptionController@get");
$router->get("500", "unauthorizedExceptionController@get");

// Get product routes
$router->get("cart", "cartController@index");
$router->get("cart/add/{pid}/{tid}", "cartController@creat");
$router->get("cart/add/{pid}/{tid}/{quantity}", "cartController@creat");
$router->get("cart/remove/{id}", "cartController@delete");
$router->get("cart/empty", "cartController@deleteAll");
$router->get("products", "productsController@index");
$router->get("category/{id}/{name}", "categoryController@index");
$router->get("product/{id}/{name}", "productController@index");

// Post product routes
$router->post("cart", "cartController@update");
$router->post("product/{id}/{name}", "productController@post");

// Get logged out routes
$router->get("forgot-password", "ForgotPasswordController@get");
$router->get("reset-password", "ResetPasswordController@get");
$router->get("create-password", "CreatePasswordController@get");
$router->get("login", "LoginController@get");
$router->get("register", "RegisterController@get");

// Get logged in routes
$router->get("dashboard", "DashboardController@get");
$router->get("logout", "LoginController@logout");
$router->get("profile", "ProfileController@get");
$router->get("settings", "SettingsController@get");

// Post logged out routes
$router->post("create-password", "CreatePasswordController@post");
$router->post("forgot-password", "ForgotPasswordController@post");
$router->post("login", "LoginController@post");
$router->post("register", "RegisterController@post");
$router->post("reset-password", "ResetPasswordController@post");
$router->post("settings", "SettingsController@post");

// Get admin pages
$router->get("admin", "adminController@index");

// Get admin category routes
$router->get("admin/categories", "adminCategories@index");
$router->get("admin/category/create", "adminCategories@create");
$router->get("admin/category/update/{id}", "adminCategories@update");
$router->get("admin/category/delete/{id}", "adminCategories@delete");

// Post admin category routes
$router->post("admin/category/create", "adminCategories@createCategory");
$router->post("admin/category/update/{id}", "adminCategories@updateCategory");
$router->post("admin/category/delete/{id}", "adminCategories@deleteCategory");

// Get admin product routes
$router->get("admin/products", "adminProducts@index");
$router->get("admin/product/create", "adminProducts@create");
$router->get("admin/product/update/{id}", "adminProducts@update");
$router->get("admin/product/delete/{id}", "adminProducts@delete");

// Post admin product routes
$router->post("admin/product/create", "adminProducts@createProduct");
$router->post("admin/product/update/{id}", "adminProducts@updateProduct");
$router->post("admin/product/delete/{id}", "adminProducts@deleteProduct");

// Get admin product type routes
$router->get("admin/product/images/{pid}", "adminImages@index");
$router->get("admin/product/image/create/{pid}", "adminImages@create");
$router->get("admin/product/image/update/{id}", "adminImages@update");
$router->get("admin/product/image/delete/{id}", "adminImages@delete");

// Post admin product type routes
$router->post("admin/product/image/create/{pid}", "adminImages@createImage");
$router->post("admin/product/image/update/{id}", "adminImages@updateImage");
$router->post("admin/product/image/delete/{id}", "adminImages@deleteImage");

// Get admin product type routes
$router->get("admin/product/types/{pid}", "adminTypes@index");
$router->get("admin/product/type/create/{pid}", "adminTypes@create");
$router->get("admin/product/type/update/{id}", "adminTypes@update");
$router->get("admin/product/type/delete/{id}", "adminTypes@delete");

// Post admin product type routes
$router->post("admin/product/type/create/{pid}", "adminTypes@createType");
$router->post("admin/product/type/update/{id}", "adminTypes@updateType");
$router->post("admin/product/type/delete/{id}", "adminTypes@deleteType");

// Get admin user routes
$router->get("admin/users", "adminUsers@index");
$router->get("admin/user/create", "adminUsers@create");
$router->get("admin/user/update/{id}", "adminUsers@update");
$router->get("admin/user/delete/{id}", "adminUsers@delete");

// Post admin user routes
$router->post("admin/user/create", "adminUsers@createUser");
$router->post("admin/user/update/{id}", "adminUsers@updateUser");
$router->post("admin/user/delete/{id}", "adminUsers@deleteUser");
