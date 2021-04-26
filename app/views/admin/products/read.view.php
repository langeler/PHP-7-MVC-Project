<?php include VIEW_DIR . DS . "admin/partials/header.php"; ?>

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
		<div class="col-md-6">
			<a href="/admin/product/create/" class='btn btn-success float-right'>
				<i class='fas fa-plus'></i> Create Record
			</a>
		</div>
	</div>
</div>

<div class='container mt-3'>
	<div class='row'>
		<div class='col-md-12'>
			<?php if ($pageData["products"]): ?>
			<table class='table table-hover table-responsive'>
				<tr>
					<th>Name</th>
					<th>Description</th>
					<th>cid</th>
					<th>Status</th>
					<th>Created</th>
					<th>Actions</th>
				</tr>

				<?php foreach ($pageData["products"] as $product):

    	// shorten the product name, if it's too long
    	$short_desc = substr($product["description"], 0, 37);

    	// check if any letters were stripped
    	if ($short_desc != $product["description"]) {
    		// if letters were stripped, add ...
    		$short_desc = $short_desc . "...";
    	}
    	?>
				<tr>
					<td>
						<?= $product["name"] ?>
					</td>
					<td>
						<?= $short_desc ?>
					</td>
					<td>
						<?= $product["category_id"] ?>
					</td>
					<td>
						<?= $product["status"] ?>
					</td>
					<td>
						<?= $product["created"] ?>
					</td>
					<td>
				    	<a class="btn btn-sm btn-info" href="/admin/product/images/<?= strtolower(
         	$product["id"]
         ) ?>">
							Images
						</a>
				    	<a class="btn btn-sm btn-secondary" href="/admin/product/types/<?= strtolower(
         	$product["id"]
         ) ?>">
							Types
						</a>
				    	<a class="btn btn-sm btn-primary" href="/admin/product/update/<?= strtolower(
         	$product["id"]
         ) ?>">
							Update
						</a>

						<a class="btn btn-sm btn-danger" href="/admin/product/delete/<?= strtolower(
      	$product["id"]
      ) ?>">
							Delete
						</a>
					</td>
				</tr>
				<?php
    endforeach; ?>
			</table>
			<?php else: ?>
			<p>
				No products were found!
			</p>
			<?php endif; ?>

			<?php echo $pageData["pagination"]; ?>
		</div>
	</div>
</div>

<?php include VIEW_DIR . DS . "admin/partials/footer.php";
?>
