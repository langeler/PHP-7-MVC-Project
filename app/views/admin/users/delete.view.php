<?php include VIEW_DIR . DS . "admin" . DS . "partials" . DS . "header.php"; ?>
<?php include VIEW_DIR . DS . "admin/partials/message.php"; ?>

<form method="post" id="form-settings">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="id">
					User id
				</label>

				<input readonly class="form-control" type="text" value="<?= $pageData["id"] ?>">
			</div>
		</div>
	</div>

	<input name="csrf" type="hidden" value="<?= $pageData["csrf"] ?>">

	<div class="mt-4">
		<button type="submit" class="btn btn-sm btn-danger">
			Delete account
		</button>
	</div>
</form>



<?php include VIEW_DIR . DS . "admin" . DS . "partials" . DS . "footer.php"; ?>
