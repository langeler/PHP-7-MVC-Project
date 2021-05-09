<?php include VIEW_DIR . DS . "partials" . DS . "header.php"; ?>

<!-- Intro Header (v6) -->
<section class="slice slice-xl pb-250 bg-neutral">
	<div class="d-flex align-items-center">
		<div class="container py-6 py-xl-9">
    		<div class="row row-grid align-items-center justify-content-center">
        		<div class="col-lg-6">
    				<div class="py-lg-5 text-center">
        				<h2 class="h1 text-white mb-3">
							Deploy your app in seconds
						</h2>

						<p class="lead lh-180 text-white">Build responsive, mobile-first projects on the web with the world's most popular front-end component library.

						</p>

						<a href="/products" class="btn btn-white btn-icon rounded-pill hover-translate-y-n3 mt-5">
            				<span class="btn-inner--icon">
        						<i class="fas fa-boxes"></i>
        					</span>
        					<span class="btn-inner--text">
								View products
							</span>
        				</a>
    				</div>
    			</div>
    		</div>
		</div>
	</div>

	<div class="shape-container" data-shape-position="bottom">
		<svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1437.24 372.58" class="ie-shape-clouds">
			<path class="fill-section-primary" d="M1.35,97.76.5-189l16,8.88s28.43-111.93,145.68-53.3c0,0,42.13-28.11,63.71,9.81,0,0,30.73-57.54,90.88-11.11,0,0,136-132.07,196.8,86.3,0,0,86.3-171.3,234.72,5.23,0,0,39.23-102.65,143.19-22.23,0,0,5.88-113.11,149.07-61.46,0,0,68.65-100,189-11.11,0,0,126.84-28.11,151.69,87,0,0,34.65-34.65,56.23-18.31l.33,267.1Z" transform="translate(-0.5 400)" />
    		<path class="fill-section-primary opacity-5" d="M.56-113.82,1.35,97.76H1437.74l-.55-207.55s-62.35-102.82-192-23.19c0,0-50.05-64.84-110.35-5.69,0,0-22.75-37.54-52.33-13.65,0,0-18.2-75.08-87.59-30.71,0,0-29.58-18.2-36.4,8,0,0-101.25-122.86-167.23,18.2,0,0-78.49-60.29-137.65,12.51,0,0-35.27-26.16-52.33-1.14,0,0-2.28-27.3-36.4-11.38,0,0-31.85-52.33-91-21.61,0,0-48.92-64.84-111.48-6.83,0,0-62.88-21.69-72.81,29.58,0,0-44.91-23.4-43.23,19.34,0,0-39.82-51.19-81.91,4.55,0,0-54.6-44.37-94.42,9.1C70-122.74,17.56-154.95.56-113.82Z" transform="translate(-0.5 274.83)" />
		</svg>
	</div>
</section>

<!-- Search Products (v2) -->
<section class="slice pt-1">
	<div class="container">
		<form class="row justify-content-center" action="/products" method="get">
    		<div class="col-lg-7">
        		<div class="form-group">
        			<div class="input-group input-group-lg input-group-merge rounded-pill shadow bg-neutral">
        				<input type="text" class="form-control form-control-flush" placeholder="Search product.." name="search">

						<div class="input-group-append">
        					<button type="submit" class="btn btn-block btn-neutral border-0">
								<i class="fas fa-search"></i>
							</button>
        				</div>
        			</div>
        		</div>
    		</div>
		</form>
	</div>
</section>

<section class="slice pt-lg-0 bg-section-secondary">
	<div class="container swiper-js-container">
		<div class="row align-items-center">
			<div class="col-lg-12">
				<div class="swiper-container" data-swiper-items="2" data-swiper-space-between="20" data-swiper-sm-items="4" data-swiper-sm-space-between="20" data-swiper-lg-items="6" data-swiper-lg-space-between="20">
					<div class="swiper-wrapper">

						<?php foreach ($this->getCategories() as $category): ?>
							<div class="swiper-slide p-3">
								<div class="hover-scale-110">
									<a href="/category/
										<?= $category["id"] ?>/
										<?= $this->slugify($category["name"]) ?>
									">
										<img alt="Image placeholder" src="assets/img/placeholder.jpg" class="img-fluid img-center">
									</a>
								</div>

								<div class="text-center mt-3">
									<a href="/category/
										<?= $category["id"] ?>/
										<?= $this->slugify($category["name"]) ?>
									" class="h6 font-weight-bolder">
										<?= $category["name"] ?>
									</a>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Features 13 -->
<section class="slice slice-lg bg-gradient-dark">
	<div class="container">
		<div class="mb-5 text-center">
			<h3 class="text-white mt-4">
				Powerful features
			</h3>

			<div class="fluid-paragraph mt-3">
				<p class="lead lh-180 text-white">
					Start building fast, beautiful and modern looking websites in no time using our theme.
				</p>
			</div>
		</div>

		<div class="row row-grid align-items-center">
			<div class="col-lg-4">
				<div class="d-flex align-items-start mb-5">
					<div class="pr-4">
						<div class="icon icon-shape bg-white text-primary box-shadow-3 rounded-circle">
							<i class="fas fa-expand"></i>
						</div>
					</div>

					<div class="icon-text">
						<h5 class="h5 text-white">
							Responsive web design
						</h5>

						<p class="mb-0 text-white">
							Modular and interchangable componente between layouts and even demos.
						</p>
					</div>
				</div>

				<div class="d-flex align-items-start mb-5">
					<div class="pr-4">
						<div class="icon icon-shape bg-white text-primary box-shadow-3 rounded-circle">
							<i class="fas fa-box-open"></i>
						</div>
					</div>

					<div class="icon-text">
						<h5 class="text-white">
							Loaded with features
						</h5>

						<p class="mb-0 text-white">
							Modular and interchangable componente between layouts and even demos.
						</p>
					</div>
				</div>

				<div class="d-flex align-items-start">
					<div class="pr-4">
						<div class="icon icon-shape bg-white text-primary box-shadow-3 rounded-circle">
							<i class="fas fa-smile"></i>
						</div>
					</div>

					<div class="icon-text">
						<h5 class="text-white">
							Friendly online support
						</h5>

						<p class="mb-0 text-white">
							Modular and interchangable componente between layouts and even demos.
						</p>
					</div>
				</div>
			</div>

			<div class="col-lg-4">
				<div class="position-relative" style="z-index: 10;">
					<img alt="Image placeholder" src="<?= $this->getImage(
     	"logo/bear.png"
     ) ?>" class="img-center img-fluid">
				</div>
			</div>

			<div class="col-lg-4">
				<div class="d-flex align-items-start mb-5">
					<div class="pr-4">
						<div class="icon icon-shape bg-white text-primary box-shadow-3 rounded-circle">
							<i class="fas fa-file-archive"></i>
						</div>
					</div>

					<div class="icon-text">
						<h5 class="text-white">
							Free updates forever
						</h5>

						<p class="mb-0 text-white">
							Modular and interchangable componente between layouts and even demos.
						</p>
					</div>
				</div>

				<div class="d-flex align-items-start mb-5">
					<div class="pr-4">
						<div class="icon icon-shape bg-white text-primary box-shadow-3 rounded-circle">
							<i class="fab fa-sass"></i>
						</div>
					</div>

					<div class="icon-text">
						<h5 class="text-white">
							Built with Sass
						</h5>

						<p class="mb-0 text-white">
							Modular and interchangable componente between layouts and even demos.
						</p>
					</div>
				</div>

				<div class="d-flex align-items-start">
					<div class="pr-4">
						<div class="icon icon-shape bg-white text-primary box-shadow-3 rounded-circle">
							<i class="fas fa-palette"></i>
						</div>
					</div>

					<div class="icon-text">
						<h5 class="text-white">
							Infinite colors
						</h5>

						<p class="mb-0 text-white">
							Modular and interchangable componente between layouts and even demos.
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="slice slice-lg">
	<div class="container">
		<div class="mb-5 text-center">
			<h3 class=" mt-4">
				Subscribe for weekly news
			</h3>

			<div class="fluid-paragraph mt-3">
				<p class="lead lh-180">
					Customization has never been easier. Purpose has all the right tools in order to make your website building process a breeze.
				</p>
			</div>
		</div>

		<div class="row justify-content-center">
			<div class="col-lg-5 col-md-7">
				<form class="mt-4">
					<div class="form-group mb-0">
						<div class="input-group input-group-lg input-group-merge rounded-pill bg-dark">
							<input type="email" class="form-control form-control-flush" name="email" placeholder="Enter your email address" aria-label="Enter your email address">

							<div class="input-group-append">
								<button class="btn btn-dark" type="button">
									<span class="fas fa-paper-plane"></span>
								</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

<?php include VIEW_DIR . DS . "partials" . DS . "footer.php";
?>
