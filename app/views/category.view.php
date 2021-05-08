<?php include VIEW_DIR . DS . "partials" . DS . "header.php"; ?>

	<section class="slice slice-lg bg-gradient-dark" data-offset-top="#header-main" style="padding-top: 147.1875px;">
      <div class="container pt-5 pb-6 pt-lg-6 pb-lg-6">
        <div class="row row-grid justify-content-center">
          <div class="col-lg-7 text-center">
            <h6 class="text-uppercase text-sm ls-2 text-info font-weight-700">
	            <?= $this->pageTitle ?>
            </h6>
            <p>In a real application, it wouldn't really make sense to just list all your users. But for ease of testing, I made
                this page.</p>
          </div>
        </div>
      </div>
    </section>

<div class='container mt-3'>
	<div class="row">
		<div class="col-md-6 px-0">
			<form class="form-inline float-left "  action='<?= $pageUrl ?>' method="get">
				<input class="form-control mr-sm-2" type="search" placeholder="Type a name..." name="search" id="search" <?php echo isset(
    	$pageData["search"]
    )
    	? "value='{$pageData["search"]}'"
    	: ""; ?> aria-label="Search">
			    <button class="btn btn-primary my-2 my-sm-0" type="submit"><i class="fas fa-search"></i> Search</button>
			</form>
		</div>
	</div>
</div>

<div class='container mt-3'>
	<div class='row'>
		<?php if ($pageData["products"]): ?>
<?php foreach ($pageData["products"] as $products => $product):

	// Set image placeholder variable
	$placeholder = $this->getImage("placeholder.jpg");
	$placeholderDesc = "This product doesn't have any images."; // Check if product have any images else return placeholder
	$product["image"] != false
		? ($imgUrl = $this->getImage(
			"upload" . DS . $product["id"] . DS . $product["image"]["name"]
		))
		: ($imgUrl = $placeholder); // Check if product have any images else return placeholder
	$product["image"] != false
		? ($imgDesc = $product["image"]["description"])
		: ($imgDesc = $placeholderDesc);
	?>
		<div class="col-xl-3 col-lg-4 col-sm-6">
			<div class="card card-product">
				<a href="/category/<?= $product["category"]["id"] ?>/<?= $product["category"][
	"name"
] ?>">
					<?= $product["category"]["name"] ?>
				</a>

				<div class="card-image">
					<a href="/product/<?= strtolower($product["id"]) ?>/<?= strtolower(
	$this->slugify($product["name"])
) ?>">
						 <img class="img-center img-fluid" src="<?= $imgUrl ?>" alt="<?= $imgDesc ?>">
					</a>
				</div>

				<div class="card-body text-center pt-0">
					<h6>
						<a href="/product/<?= strtolower($product["id"]) ?>/<?= strtolower(
	$this->slugify($product["name"])
) ?>">
							  <?= $product["name"] ?>
						</a>
					</h6>

					<p class="text-sm">
						<?= $product["description"] ?>
					</p>

					<a class="btn btn-block btn-pill btn-primary mt-2" href="/product/<?= strtolower(
     	$product["id"]
     ) ?>/<?= strtolower($this->slugify($product["name"])) ?>">
						Details
					</a>
				</div>
			</div>
		</div>
		<?php
endforeach; ?>
		<?php else: ?>
		<p>
			No products were found!
		</p>
		<?php endif; ?>
		<div class='col-sm-12'>
			<?php echo $pageData["pagination"]; ?>
		</div>
	</div>
</div>

<?php include VIEW_DIR . DS . "partials" . DS . "footer.php"; ?>
