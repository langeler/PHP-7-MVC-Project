<?php include VIEW_DIR . DS . "admin" . DS . "partials" . DS . "header.php"; ?>
<?php include VIEW_DIR . DS . "admin/partials/message.php"; ?>

<form method="post" id="form-settings">

                        <input name="csrf" type="hidden" value="<?= $pageData[
                        	"csrf"
                        ] ?>">

						 <div class="form-group">
                        <label for="id">Type id</label>
                        <input readonly class="form-control" type="text" value="<?= $pageData[
                        	"id"
                        ] ?>">
						</div>

						<div class="form-group">
                        <input class="btn btn-danger" type="submit" value="Delete">
						</div>
</form>

<?php include VIEW_DIR . DS . "admin" . DS . "partials" . DS . "footer.php"; ?>
