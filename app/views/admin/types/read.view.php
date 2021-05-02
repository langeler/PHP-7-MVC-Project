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

			<a href="/admin/product/type/create/<?= $pageData[
   	"pid"
   ] ?>" class="btn btn-sm btn-outline-success">
				<i class="fas fa-plus"></i> Create
			</a>
		</div>
	</div>
</div>

<div class='container mt-3'>
	<div class='row'>
		<div class='col-md-12'>
			<?php if ($pageData["types"]): ?>
			<table class='table table-hover table-responsive'>
				<tr>
					<th>Name</th>
					<th>Description</th>
					<th>price</th>
					<th>stock</th>
					<th>pid</th>
					<th>Created</th>
					<th>Actions</th>
				</tr>

				<?php foreach ($pageData["types"] as $type): ?>
				<tr>
					<td>
						<?= $type["name"] ?>
					</td>
					<td>
						<?= $type["description"] ?>
					</td>
					<td>
						<?= $type["price"] ?>
					</td>
					<td>
						<?= $type["stock"] ?>
					</td>
					<td>
						<?= $type["product_id"] ?>
					</td>
					<td>
						<?= $type["created"] ?>
					</td>
					<td>
				    	<a class="btn btn-sm btn-primary" href="/admin/product/type/update/<?= strtolower(
         	$type["id"]
         ) ?>">
							Update
						</a>

						<a class="btn btn-sm btn-danger" href="/admin/product/type/delete/<?= strtolower(
      	$type["id"]
      ) ?>">
							Delete
						</a>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
			<?php else: ?>
			<p>
				No types were found!
			</p>
			<?php endif; ?>

			<?php echo $pageData["pagination"]; ?>
		</div>
	</div>
</div>

<?php include VIEW_DIR . DS . "admin" . DS . "partials" . DS . "footer.php"; ?>

 ?>
 ?>