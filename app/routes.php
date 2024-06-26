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
$router->get("category/{id}", "categoryController@index");
$router->get("category/{id}/{name}", "categoryController@index");
$router->get("product/{id}", "productController@index");
$router->get("product/{id}/{name}", "productController@index");
$router->get("product/type/{pid}/{tid}", "typeController@index");
$router->get("product/type/{pid}/{tid}/{name}", "typeController@index");
$router->get("product/type/{pid}/{tid}/{name}/{tname}", "typeController@index");

// Post product routes
$router->post("cart", "cartController@update");
$router->post("product/{id}/{name}", "productController@post");

// Get logged out routes
$router->get("change", "changeController@get");
$router->get("login", "LoginController@get");
$router->get("recover", "recoverController@get");
$router->get("register", "RegisterController@get");
$router->get("reset/{username}/{access}", "resetController@get");

// Get logged in routes
$router->get("dashboard", "DashboardController@get");
$router->get("logout", "LoginController@logout");
$router->get("profile", "ProfileController@get");
$router->get("settings", "SettingsController@get");

// Post logged out routes
$router->post("login", "LoginController@post");
$router->post("recover", "recoverController@post");
$router->post("register", "RegisterController@post");
$router->post("reset/{username}/{access}", "resetController@post");

// Post logged in routes
$router->post("change", "changeController@post");
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

// Get admin category image routes
$router->get("admin/category/images/{cid}", "adminCimages@index");
$router->get("admin/category/image/create/{cid}", "adminCimages@create");
$router->get("admin/category/image/update/{id}", "adminCimages@update");
$router->get("admin/category/image/delete/{id}", "adminCimages@delete");

// Post admin category image routes
$router->post("admin/category/image/create/{cid}", "adminCimages@createImage");
$router->post("admin/category/image/update/{id}", "adminCimages@updateImage");
$router->post("admin/category/image/delete/{id}", "adminCimages@deleteImage");

// Get admin product image routes
$router->get("admin/product/images/{pid}", "adminPimages@index");
$router->get("admin/product/image/create/{pid}", "adminPimages@create");
$router->get("admin/product/image/update/{id}", "adminPimages@update");
$router->get("admin/product/image/delete/{id}", "adminPimages@delete");

// Post admin product image routes
$router->post("admin/product/image/create/{pid}", "adminPimages@createImage");
$router->post("admin/product/image/update/{id}", "adminPimages@updateImage");
$router->post("admin/product/image/delete/{id}", "adminPimages@deleteImage");

// Get admin type image routes
$router->get("admin/type/images/{tid}", "adminTimages@index");
$router->get("admin/type/image/create/{tid}", "adminTimages@create");
$router->get("admin/type/image/update/{id}", "adminTimages@update");
$router->get("admin/type/image/delete/{id}", "adminTimages@delete");

// Post admin type image routes
$router->post("admin/type/image/create/{tid}", "adminTimages@createImage");
$router->post("admin/type/image/update/{id}", "adminTimages@updateImage");
$router->post("admin/type/image/delete/{id}", "adminTimages@deleteImage");

// Get admin product option routes
$router->get("admin/product/options/{qid}", "adminOptions@index");
$router->get("admin/product/option/create/{qid}", "adminOptions@create");
$router->get("admin/product/option/update/{id}", "adminOptions@update");
$router->get("admin/product/option/delete/{id}", "adminOptions@delete");

// Post admin product option routes
$router->post("admin/product/option/create/{qid}", "adminOptions@createOption");
$router->post("admin/product/option/update/{id}", "adminOptions@updateOption");
$router->post("admin/product/option/delete/{id}", "adminOptions@deleteOption");

// Get admin product question routes
$router->get("admin/product/questions/{tid}", "adminQuestions@index");
$router->get("admin/product/question/create/{tid}", "adminQuestions@create");
$router->get("admin/product/question/update/{id}", "adminQuestions@update");
$router->get("admin/product/question/delete/{id}", "adminQuestions@delete");

// Post admin product question routes
$router->post(
	"admin/product/question/create/{tid}",
	"adminQuestions@createQuestion"
);
$router->post(
	"admin/product/question/update/{id}",
	"adminQuestions@updateQuestion"
);
$router->post(
	"admin/product/question/delete/{id}",
	"adminQuestions@deleteQuestion"
);

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
