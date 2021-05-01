<?php include VIEW_DIR . DS . "admin" . DS . "partials" . DS . "header.php"; ?>
<form method="post" id="form-settings">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="forename" class="form-control-label">
					Forename
				</label>

				<input type="text" class="form-control" id="forename" name="forename">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label for="surname" class="form-control-label">
					Surname
				</label>

				<input type="text" class="form-control" id="surname" name="surname">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label for="phone" class="form-control-label">
					Phone
				</label>

				<input type="text" class="form-control" id="phone" name="phone">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label for="username" class="form-control-label">
					Username
				</label>

				<input type="text" class="form-control" id="username" name="username">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label for="password" class="form-control-label">
					Password
				</label>

				<input type="password" class="form-control" id="password" name="password">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label for="cpassword" class="form-control-label">Confirm
					Password
				</label>

				<input type="password" class="form-control" id="cpassword" name="cpassword">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label for="email" class="form-control-label">
					Email
				</label>

				<input type="email" class="form-control" id="email" name="email">
			</div>
		</div>

		<div class="col-md-6">
			<div class="form-group">
				<label for="role" class="form-control-label">
					Role
				</label>

				<select id="role" name="role" class="form-control">
				<?php foreach ($pageData["roles"] as $role): ?>
					<option value="<?php echo $role; ?>">
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
			Create account
		</button>
	</div>
</form>

<?php include VIEW_DIR . DS . "admin" . DS . "partials" . DS . "footer.php";
?>
