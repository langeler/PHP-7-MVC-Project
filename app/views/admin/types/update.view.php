<?php include VIEW_DIR . DS . "admin" . DS . "partials" . DS . "header.php"; ?>
<?php include VIEW_DIR . DS . "admin/partials/message.php"; ?>

<form method="post" id="form-settings">

                        <input name="csrf" type="hidden" value="<?= $pageData[
                        	"csrf"
                        ] ?>">

						<div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" type="text" name="name" id="name" value="<?= $pageData[
                        	"type"
                        ]["name"] ?>">
						</div>

						<div class="form-group">
                        <label for="description">Description</label>
                        <input class="form-control" type="text" name="description" id="description" value="<?= $pageData[
                        	"type"
                        ]["description"] ?>">
						</div>

						<div class="form-group">
                        <label for="price">Price</label>
                        <input class="form-control" type="text" name="price" id="price" value="<?= $pageData[
                        	"type"
                        ]["price"] ?>">
						</div>

						<div class="form-group">
                        <label for="stock">Stock</label>
                        <input class="form-control" type="number" name="stock" id="stock" value="<?= $pageData[
                        	"type"
                        ]["stock"] ?>">
						</div>

						<div class="form-group">
                        <input class="btn btn-primary" type="submit" value="Update">
						</div>
</form>

<?php include VIEW_DIR . DS . "admin" . DS . "partials" . DS . "footer.php"; ?>
