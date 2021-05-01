<?php include VIEW_DIR . DS . "admin" . DS . "partials" . DS . "header.php"; ?>

<form class="form-inline float-left "  action='<?= $pageUrl ?>' method="get">
	<input class="form-control mr-sm-2" type="search" placeholder="Type a name..." name="search" id="search" <?php echo isset(
 	$pageData["search"]
 )
 	? "value='{$pageData["search"]}'"
 	: ""; ?> aria-label="Search">

	<button class="btn btn-primary my-2 my-sm-0" type="submit">
		<i class="fas fa-search"></i> Search
	</button>
</form>

<a href="/admin/user/create/" class='btn btn-success float-right'>
	<i class='fas fa-plus'></i> Create Record
</a>

<?php if ($pageData["accounts"]): ?>
	<table class='table table-hover table-responsive'>
		<tr>
			<th>Forename</th>
			<th>Surname</th>
			<th>Username</th>
			<th>Email</th>
			<th>Status</th>
			<th>Role</th>
			<th>Actions</th>
		</tr>

		<?php foreach ($pageData["accounts"] as $account): ?>

		<tr>
			<td>
				<?= $account["forename"] ?>
			</td>

			<td>
				<?= $account["surname"] ?>
			</td>

			<td>
				<?= $account["username"] ?>
			</td>

			<td>
				<?= $account["email"] ?>
			</td>

			<td>
				<?= $account["status"] ?>
			</td>

			<td>
				<?= $account["role"] ?>
			</td>

			<td>
			   	<a class="btn btn-sm btn-primary" href="/admin/user/update/<?= strtolower(
       	$account["id"]
       ) ?>">
					Update
				</a>

				<a class="btn btn-sm btn-danger" href="/admin/user/delete/<?= strtolower(
    	$account["id"]
    ) ?>">
					Delete
				</a>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>

<?php echo $pageData["pagination"]; ?>

<?php else: ?>
	<p>
		No users were found!
	</p>
<?php endif; ?>

<?php include VIEW_DIR . DS . "admin" . DS . "partials" . DS . "footer.php";
?>
