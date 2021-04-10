<?php include __DIR__ . "/partials/header.php"; ?>

	<section class="slice slice-lg bg-gradient-dark" data-offset-top="#header-main" style="padding-top: 147.1875px;">
      <div class="container pt-5 pb-6 pt-lg-6 pb-lg-6">
        <div class="row row-grid justify-content-center">
          <div class="col-lg-7 text-center">
            <h6 class="text-uppercase text-sm ls-2 text-info font-weight-700">
	            <?= $this->pageTitle ?>
            </h6>
            <h1 class="text-white mb-4">
				Create a new password
			</h1>
			 <p class="lead text-muted lh-180 mb-0">Make sure your password conforms to all proper security standards.</p>
		 </div>
        </div>
      </div>
    </section>

		<div class="container">
            <?php include __DIR__ . "/partials/message.php"; ?>

            <form id="form-create-password">
                <input name="csrf" type="hidden" value="<?= $this->csrf ?>">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">

                <input type="submit" name="create" value="Create Password">
            </form>
        </div>

<?php include __DIR__ . "/partials/footer.php"; ?>
