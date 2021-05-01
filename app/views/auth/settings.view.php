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
                                    Create your account
                                </h6>

                                <p class="text-muted mb-0">
                                    Made with love for designers &amp; developers.
                                </p>
                            </div>

                            <span class="clearfix"></span>

                            <?php include VIEW_DIR .
                            	DS .
                            	"partials" .
                            	DS .
                            	"message.php"; ?>

                            <nav class="nav nav-pills nav-justified my-4">
                                <a class="nav-link active" href="/settings">
                                    Settings
                                </a>

                                <a class="nav-link" href="/change-password">
                                    Password
                                </a>

								<a class="nav-link" href="/logout">
									Logout
								</a>
                            </nav>

                            <form method="post" action="">
								<input name="csrf" type="hidden" value="<?= $pageData["csrf"] ?>">

								<div class="form-group">
                    				<label for="email">
										Email
									</label>

									<input class="form-control" type="text" name="email" id="email" value="<?= $pageData[
         	"account"
         ]["email"] ?>">
								</div>

								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
                    						<label for="forename">
												Forename
											</label>

											<input class="form-control" type="text" name="forename" id="forename" value="<?= $pageData[
           	"account"
           ]["forename"] ?>">
										</div>
									</div>

									<div class="col-sm-6">
										<div class="form-group">
                    						<label for="surname">
												Surname
											</label>

											<input class="form-control" type="text" name="surname" id="surname" value="<?= $pageData[
           	"account"
           ]["surname"] ?>">
										</div>
									</div>
								</div>

								<div class="form-group">
                					<label for="phone">
										Phone
									</label>

									<input class="form-control" type="tel" name="phone" id="phone" value="<?= $pageData[
         	"account"
         ]["phone"] ?>">
								</div>

								<div class="mt-4">
									<button type="submit" class="btn btn-block btn-primary">
										Create my account
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
