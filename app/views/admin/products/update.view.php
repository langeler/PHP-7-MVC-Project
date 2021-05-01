<?php include VIEW_DIR . DS . "admin" . DS . "partials" . DS . "header.php"; ?>
<?php include VIEW_DIR . DS . "admin/partials/message.php"; ?>

<form method="post" id="form-settings">

                        <input name="csrf" type="hidden" value="<?= $pageData[
                        	"csrf"
                        ] ?>">

						<div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" type="text" name="name" id="name" value="<?= $pageData[
                        	"product"
                        ]["name"] ?>">
						</div>

						<div class="form-group">
                        <label for="description">Description</label>
                        <input class="form-control" type="text" name="description" id="description" value="<?= $pageData[
                        	"product"
                        ]["description"] ?>">
						</div>

						<div class="form-group">
						<label for="category">Status</label>
						<select id="category" name="category" class="form-control">
						<?php foreach ($pageData["categories"] as $category): ?>
							<option value="<?php echo $category["id"]; ?>"<?php echo $category["id"] ==
$pageData["product"]["category_id"]
	? " selected"
	: ""; ?>><?php echo $category["name"]; ?></option>
						<?php endforeach; ?>
						</select>
						</div>

						<div class="form-group">
						<label for="status">Status</label>
						<select id="status" name="status" class="form-control">
						<?php foreach ($pageData["status"] as $key => $value): ?>
							<option value="<?php echo $value; ?>"<?php echo $value ==
$pageData["product"]["status"]
	? " selected"
	: ""; ?>><?php echo $key; ?></option>
						<?php endforeach; ?>
						</select>
						</div>

						<div class="form-group">
                        <input class="btn btn-primary" type="submit" value="Update">
						</div>
</form>

<?php include VIEW_DIR . DS . "admin" . DS . "partials" . DS . "footer.php"; ?>
