<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Purpose is a unique and beautiful collection of UI elements that are all flexible and modular. A complete and customizable solution to building the website of your dreams.">
  <meta name="author" content="Webpixels">

  <title><?= $this->pageTitle
  	? $this->pageTitle . " &ndash; " . SITE_NAME
  	: SITE_NAME . " &mdash; MVC Framework" ?></title>

  <!-- Favicon -->
  <link rel="icon" href="../../assets/img/brand/favicon.png" type="image/png">

<!-- Font Awesome 5 -->
  <link rel="stylesheet" href="<?= $this->getLibStyle(
  	"@fortawesome/fontawesome-free/css/all.min"
  ) ?>">

  <!-- Page CSS -->
  <link rel="stylesheet" href="<?= $this->getLibStyle(
  	"animate.css/animate.min"
  ) ?>">

<!-- Swiper CSS -->
  <link rel="stylesheet" href="<?= $this->getLibStyle(
  	"swiper/dist/css/swiper.min"
  ) ?>">

  <!-- Purpose CSS -->
  <link href="<?= $this->getStylesheet("web") ?>?<?= date(
	"d-m-Y"
) ?>" rel="stylesheet">

<!-- Purpose CSS -->
  <link href="<?= $this->getStylesheet("style") ?>?<?= date(
	"d-m-Y"
) ?>" rel="stylesheet">
</head>
<body>

<header class="header header-transparent" id="header-main">
	<!-- Top navigation -->
	<?php include VIEW_DIR . DS . "partials" . DS . "navbar.php"; ?>
</header>

<!-- Main (content) -->
<main class="main-content">

<!-- Top Heading -->
<?php include VIEW_DIR . DS . "admin" . DS . "partials" . DS . "heading.php"; ?>

<!-- Content -->
<section class="slice">
	<div class="container">
		<div class="row row-grid">
			<div class="col-lg-3 order-lg-1 sidebar">
      <?php include VIEW_DIR .
      	DS .
      	"admin" .
      	DS .
      	"partials" .
      	DS .
      	"sidenav.php"; ?>
			</div>

			<div class="col-lg-9 order-lg-2">
