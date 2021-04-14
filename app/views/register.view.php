<?php include __DIR__ . "/partials/header.php"; ?>

	<section class="slice slice-lg bg-gradient-dark" data-offset-top="#header-main" style="padding-top: 147.1875px;">
      <div class="container pt-5 pb-6 pt-lg-6 pb-lg-6">
        <div class="row row-grid justify-content-center">
          <div class="col-lg-7 text-center">
            <h6 class="text-uppercase text-sm ls-2 text-info font-weight-700">
	            <?= $this->pageTitle ?>
            </h6>
            <h1 class="text-white mb-4">
				Register an account
			</h1>
			 <p class="lead text-muted lh-180 mb-0">Already have an account? <a href="/login">Log in here</a>.</p>
		 </div>
        </div>
      </div>
    </section>
		
	   <div class="container">
          <?php include __DIR__ . "/partials/message.php"; ?>
            <form method="post" id="form-register">
                <h3>Sign up for Laconia</h3>

                <p>This website is a demo. You're not signing up for any product, just testing out the front end of Laconia. Your password is securely encrypted, and you can fully delete all your information at any time.</p>

                <input name="csrf" type="hidden" value="<?= $this->csrf ?>">

                <label for="forename">Forename</label>
                <input type="text" id="forename" name="forename">

                <label for="surname">Surname</label>
                <input type="text" id="surname" name="surname">

                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone">

                <label for="username">Username</label>
                <input type="text" id="username" name="username">

                <label for="password">Password</label>
                <input type="password" id="password" name="password">

                <label for="email">Email</label>
                <input type="email" id="email" name="email">
                <small>You can register with a fake email.</small>

                <div class="actions">
                    <?php include __DIR__ . "/partials/message.php"; ?>
                    <input type="submit" value="Register">
                </div>
            </form>
      </div>

<?php include __DIR__ . "/partials/footer.php"; ?>
