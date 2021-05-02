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

			<a href="/admin/category/create" class="btn btn-sm btn-outline-success">
				<i class="fas fa-plus"></i> Create
			</a>
		</div>
	</div>
</div>

<?php if ($pageData["categories"]): ?>
	<table class='table table-hover table-responsive'>
		<tr>
			<th>Name</th>
			<th>Description</th>
			<th>Actions</th>
		</tr>

		<?php foreach ($pageData["categories"] as $category): ?>

		<tr>
			<td>
				<?= $category["name"] ?>
			</td>

			<td>
				<?= $category["description"] ?>
			</td>

			<td>
				<a class="btn btn-sm btn-primary" href="/admin/category/update/<?= strtolower(
    	$category["id"]
    ) ?>">
					Update
				</a>

				<a class="btn btn-sm btn-danger" href="/admin/category/delete/<?= strtolower(
    	$category["id"]
    ) ?>">
					Delete
				</a>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>

<?php echo $pageData["pagination"]; ?>

<?php else: ?>
	<p>
		No categories were found!
	</p>
<?php endif; ?>

<?php include VIEW_DIR . DS . "admin" . DS . "partials" . DS . "footer.php";
?>
