<?php include __DIR__ . "/partials/header.php"; ?>

	<section class="slice slice-lg bg-gradient-dark" data-offset-top="#header-main" style="padding-top: 147.1875px;">
      <div class="container pt-5 pb-6 pt-lg-6 pb-lg-6">
        <div class="row row-grid justify-content-center">
          <div class="col-lg-7 text-center">
            <h6 class="text-uppercase text-sm ls-2 text-info font-weight-700">
	            <?= $this->pageTitle ?>
            </h6>
            <h1 class="text-white mb-4">
				Reset your password
			</h1>
			 <p class="lead text-muted lh-180 mb-0">Enter the email address you signed up with and we'll email you a link to reset your password.</p>
		 </div>
        </div>
      </div>
    </section>
		
		<div class="container">
            <?php include __DIR__ . "/partials/message.php"; ?>

            <form method="post" id="form-forgot-password">
                <input name="csrf" type="hidden" value="<?= $this->csrf ?>">
                <label for="email">Email</label>
                <input type="email" id="email" name="email">

                <input type="submit" value="Reset Password">
            </form>
        </div>
        
<?php include __DIR__ . "/partials/footer.php"; ?>
