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

			<a href="/admin/product/option/create/<?= $pageData[
   	"qid"
   ] ?>" class="btn btn-sm btn-outline-success">
				<i class="fas fa-plus"></i> Create
			</a>
		</div>
	</div>
</div>

<div class='container mt-3'>
	<div class='row'>
		<div class='col-md-12'>
			<?php if ($pageData["options"]): ?>
			<table class='table table-hover table-responsive'>
				<tr>
					<th>Name</th>
					<th>Description</th>
					<th>qid</th>
					<th>Created</th>
					<th>Actions</th>
				</tr>

				<?php foreach ($pageData["options"] as $option): ?>
				<tr>
					<td>
						<?= $option["name"] ?>
					</td>
					<td>
						<?= $option["description"] ?>
					</td>
					<td>
						<?= $option["question_id"] ?>
					</td>
					<td>
						<?= $option["created"] ?>
					</td>
					<td>
				    	<a class="btn btn-sm btn-primary" href="/admin/product/option/update/<?= strtolower(
         	$option["id"]
         ) ?>">
							Update
						</a>

						<a class="btn btn-sm btn-danger" href="/admin/product/option/delete/<?= strtolower(
      	$option["id"]
      ) ?>">
							Delete
						</a>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
			<?php else: ?>
			<p>
				No options were found!
			</p>
			<?php endif; ?>

			<?php echo $pageData["pagination"]; ?>
		</div>
	</div>
</div>

<?php include VIEW_DIR . DS . "admin" . DS . "partials" . DS . "footer.php";
?>
