<?php include VIEW_DIR . DS . "admin" . DS . "partials" . DS . "header.php"; ?>
<?php include VIEW_DIR . DS . "admin/partials/message.php"; ?>

<form method="post" id="form-settings">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="name">
					Name
				</label>

				<input type="text" class="form-control" id="name" name="name">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label for="description">
					Description
				</label>

				<input type="text" class="form-control" id="description" name="description">
			</div>
		</div>
	</div>

	<input name="csrf" type="hidden" value="<?= $pageData["csrf"] ?>">

	<div class="mt-4">
		<button type="submit" class="btn btn-sm btn-primary">
			Create category
		</button>
	</div>
</form>

<?php include VIEW_DIR . DS . "admin" . DS . "partials" . DS . "footer.php"; ?>
