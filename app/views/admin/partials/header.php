<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Purpose is a unique and beautiful collection of UI elements that are all flexible and modular. A complete and customizable solution to building the website of your dreams.">
  <meta name="author" content="Webpixels">
  
  <title><?= $this->pageTitle ? $this->pageTitle  . ' &ndash; ' . SITE_NAME : SITE_NAME  . ' &mdash; MVC Framework'; ?></title>  
  
  <!-- Favicon -->
  <link rel="icon" href="../../assets/img/brand/favicon.png" type="image/png">
  
  <!-- Font Awesome 5 -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" integrity="sha384-vSIIfh2YWi9wW0r9iZe7RJPrKwp6bG+s9QZMoITbCckVJqGCCRhc+ccxNcdpHuYu" crossorigin="anonymous">
  
  <!-- Page CSS -->
  <link rel="stylesheet" href="<?= $this->getLibStyle('animate.css/animate.min'); ?>">
  <link rel="stylesheet" href="<?= $this->getLibStyle('swiper/dist/css/swiper.min'); ?>">
  
  <!-- Purpose CSS -->
  <link href="<?= $this->getStylesheet('purpose'); ?>?<?= date('d-m-Y'); ?>" rel="stylesheet">
</head>
<body>
	
	<header class="header header-transparent" id="header-main">
		<?php include __DIR__ . '/navigation.php'; ?>
	</header>
	
	<?php include __DIR__ . '/search.php'; ?>

<!-- Main content div -->
<div class="main-content">
