<?php include VIEW_DIR . DS . "admin" . DS . "partials" . DS . "header.php"; ?>
<?php include VIEW_DIR . DS . "admin/partials/message.php"; ?>

<form method="post" id="form-settings">

                        <input name="csrf" type="hidden" value="<?= $pageData[
                        	"csrf"
                        ] ?>">

						 <div class="form-group">
						 <label for="name">Name</label>
						 <input type="text" class="form-control" id="name" name="name">
						 </div>

						 <div class="form-group">
						 <label for="description">Description</label>
						 <input type="text" class="form-control" id="description" name="description">
						 </div>

						 <div class="form-group">
						 <label for="price">Price</label>
						 <input type="text" class="form-control" id="price" name="price">
						 </div>

						 <div class="form-group">
						 <label for="stock">Stock</label>
						 <input type="number" class="form-control" id="stock" name="stock">
						 </div>

						<div class="form-group">
						<input type="submit" class="btn btn-success" value="Create">
						</div>
</form>

<?php include VIEW_DIR . DS . "admin" . DS . "partials" . DS . "footer.php"; ?>
