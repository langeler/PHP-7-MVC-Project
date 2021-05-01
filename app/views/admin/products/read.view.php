<?php include VIEW_DIR . DS . "admin" . DS . "partials" . DS . "header.php"; ?>
<form class="form-inline float-left "  action='<?= $pageUrl ?>' method="get">
	<input class="form-control mr-sm-2" type="search" placeholder="Type a name..." name="search" id="search" <?php echo isset(
 	$pageData["search"]
 )
 	? "value='{$pageData["search"]}'"
 	: ""; ?> aria-label="Search">

	<button class="btn btn-primary my-2 my-sm-0" type="submit">
		<i class="fas fa-search"></i> Search
	</button>
</form>

<a href="/admin/product/create/" class='btn btn-success float-right'>
	<i class='fas fa-plus'></i> Create Record
</a>

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

<?php include VIEW_DIR . DS . "admin" . DS . "partials" . DS . "footer.php"; ?>

 ?>
 ?>
 ?>
 ?>
 ?>
 ?>
 ?>
 ?>
 ?>
 ?>
 ?>
 ?>
 ?>
 ?>
 ?>
 ?>
 ?>
 ?>
 ?>