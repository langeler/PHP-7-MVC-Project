<?php include VIEW_DIR . DS . "admin" . DS . "partials" . DS . "header.php"; ?>
<?php include VIEW_DIR . DS . "admin/partials/message.php"; ?>

<form method="post" id="form-settings" enctype="multipart/form-data">

                        <input name="csrf" type="hidden" value="<?= $pageData[
                        	"csrf"
                        ] ?>">

						<div class="form-group">
						<label for="files">Images</label>
						<input type="file" name="files[]" id="files" class='form-control' multiple>
						</div>

						 <div class="form-group">
						 <label for="description">Description</label>
						 <input type="text" class="form-control" id="description" name="description">
						 </div>

						<div class="form-group">
						<input type="submit" class="btn btn-success" value="Create">
						</div>
</form>

<?php include VIEW_DIR . DS . "admin" . DS . "partials" . DS . "footer.php"; ?>
