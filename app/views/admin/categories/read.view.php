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

<a href="/admin/category/create/" class='btn btn-success float-right'>
	<i class='fas fa-plus'></i> Create Record
</a>

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
