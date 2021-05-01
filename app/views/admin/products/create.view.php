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
						<label for="category">Category</label>
						<select id="category" name="category" class="form-control">
						<?php foreach ($pageData["categories"] as $category): ?>
							<option value="<?php echo $category["id"]; ?>"><?php echo $category[
	"name"
]; ?></option>
						<?php endforeach; ?>
						</select>
						</div>

						<div class="form-group">
						<label for="status">Status</label>
						<select id="status" name="status" class="form-control">
						<?php foreach ($pageData["status"] as $key => $value): ?>
							<option value="<?php echo $value; ?>"><?php echo $key; ?></option>
						<?php endforeach; ?>
						</select>
						</div>

						<div class="form-group">
						<input type="submit" class="btn btn-success" value="Create">
						</div>
</form>

<?php include VIEW_DIR . DS . "admin" . DS . "partials" . DS . "footer.php"; ?>
