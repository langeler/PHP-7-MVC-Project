<?php include VIEW_DIR . DS . "admin" . DS . "partials" . DS . "header.php"; ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

	<form class="form-inline float-left "  action='<?= $pageUrl ?>' method="get">
		<div class="input-group mb-3">
			<input class="form-control" type="search" placeholder="Type a name..." name="search" id="search" <?php echo isset(
   	$pageData["search"]
   )
   	? "value='{$pageData["search"]}'"
   	: ""; ?> aria-label="Search">

			<div class="input-group-append">
				<button class="btn btn-outline-primary" type="submit">
					<i class="fas fa-search"></i>
				</button>
			</div>
		</div>
	</form>

	<div class="btn-toolbar mb-2 mb-md-0">
		<div class="btn-group mr-2">
			<button type="button" class="btn btn-sm btn-outline-danger">
				<i class="fas fa-trash"></i> Delete
			</button>

			<a href="/admin/product/create" class="btn btn-sm btn-outline-success">
				<i class="fas fa-plus"></i> Create
			</a>
		</div>
	</div>
</div>

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

<?php echo $pageData["pagination"]; ?>

<?php else: ?>
	<p>
		No products were found!
	</p>
<?php endif; ?>

<?php include VIEW_DIR . DS . "admin" . DS . "partials" . DS . "footer.php";
?>
