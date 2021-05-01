<?php include VIEW_DIR . DS . "admin" . DS . "partials" . DS . "header.php"; ?>
<?php include VIEW_DIR . DS . "admin/partials/message.php"; ?>

<form method="post" id="form-settings">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
            	<label for="email">
					Username
				</label>

				<input readonly class="form-control" type="text" value="<?= $pageData[
    	"account"
    ]["username"] ?>">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
        		<label for="email">
					Email
				</label>

				<input class="form-control" type="text" name="email" id="email" value="<?= $pageData[
    	"account"
    ]["email"] ?>">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
        		<label for="forename">
					Forename
				</label>

				<input class="form-control" type="text" name="forename" id="forename" value="<?= $pageData[
    	"account"
    ]["forename"] ?>">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
            	<label for="surname">
					Surname
				</label>

				<input class="form-control" type="text" name="surname" id="surname" value="<?= $pageData[
    	"account"
    ]["surname"] ?>">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
            	<label for="phone">
					Phone
				</label>

				<input class="form-control" type="tel" name="phone" id="phone" value="<?= $pageData[
    	"account"
    ]["phone"] ?>">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">					<div class="form-group">
				<label for="role">
					Role
				</label>

				<select id="role" name="role" class="form-control">
				<?php foreach ($pageData["roles"] as $role): ?>
					<option value="<?php echo $role; ?>"<?php echo $role ==
$pageData["account"]["role"]
	? " selected"
	: ""; ?>>
						<?php echo $role; ?>
					</option>
				<?php endforeach; ?>
				</select>
			</div>
		</div>
	</div>

	<input name="csrf" type="hidden" value="<?= $pageData["csrf"] ?>">

	<div class="mt-4">
		<button type="submit" class="btn btn-sm btn-primary">
			Update account
		</button>
	</div>
</form>

<?php include VIEW_DIR . DS . "admin" . DS . "partials" . DS . "footer.php"; ?>
