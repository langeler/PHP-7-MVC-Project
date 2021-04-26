<?php include __DIR__ . "/partials/header.php"; ?>

	<section class="slice slice-lg bg-gradient-dark" data-offset-top="#header-main" style="padding-top: 147.1875px;">
      <div class="container pt-5 pb-6 pt-lg-6 pb-lg-6">
        <div class="row row-grid justify-content-center">
          <div class="col-lg-7 text-center">
            <h6 class="text-uppercase text-sm ls-2 text-info font-weight-700">
	            <?= $this->pageTitle ?>
            </h6>
            <h1 class="text-white mb-4">
				Sign in to your account
			</h1>
			 <p class="lead text-muted lh-180 mb-0">Sign in with your username and password. <br />Don't have an account? <a href="/register">Register here</a>.</p>
		 </div>
        </div>
      </div>
    </section>

    	<div class="container">
		  <?php include __DIR__ . "/partials/message.php"; ?>
			<form method="post" action="">
                <input name="csrf" type="hidden" value="<?= $this->csrf ?>">
                <label for="username">Username</label>
                <input type="text" id="username" name="username">

                <label for="password">Password</label>
                <input type="password" id="password" name="password">

                <div class="actions">
                    <?php include __DIR__ . "/partials/message.php"; ?>
                    <input type="submit" class="accent-button" value="Log In">
                    <a class="button" href="/forgot-password">Forgot Password?</a>
                </div>
            </form>
        </div>

<?php include __DIR__ . "/partials/footer.php";
?>
