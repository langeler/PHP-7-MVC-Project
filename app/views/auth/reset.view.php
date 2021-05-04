<?php include VIEW_DIR . DS . "partials" . DS . "header.php"; ?>

<!-- Main content -->
<section class="section-half-rounded bg-cover bg-size--cover py-4 py-sm-0" style="background-image: url(../../assets/img/backgrounds/img-3.jpg);">
	<div class="container-fluid d-flex flex-column py-4 py-sm-0 py-lg-5 py-xl-0">
		<div class="row align-items-center min-vh-100">
			<div class="col-md-8 col-lg-6 mx-auto">
				<div class="card shadow-lg border-0 mb-0">
					<div class="card-body py-5 px-sm-5">
						<div>
							<div class="mb-5 text-center">
								<h6 class="h3 mb-1">
									Reset your password
								</h6>

								<p class="text-muted mb-0">
									Made with love for designers &amp; developers.
								</p>
							</div>

							<span class="clearfix"></span>

							<?php include VIEW_DIR . DS . "partials" . DS . "message.php"; ?>

							<form method="post" action="">
								<input name="csrf" type="hidden" value="<?= $pageData["csrf"] ?>">

								<input name="access" type="hidden" value="<?= $pageData["access"] ?>">

								<input name="username" type="hidden" value="<?= $pageData["username"] ?>">

								<div class="form-group">
									<label for="npassword">
										New password
									</label>

									<input class="form-control" type="password" name="password" id="password" value="">
								</div>

								<div class="form-group">
									<label for="cpassword">
										Confirm password
									</label>

									<input class="form-control" type="password" name="cpassword" id="cpassword" value="">
								</div>

								<div class="mt-4">
									<button type="submit" class="btn btn-block btn-primary">
										Reset Password
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php include VIEW_DIR . DS . "partials" . DS . "footer.php";
?>
