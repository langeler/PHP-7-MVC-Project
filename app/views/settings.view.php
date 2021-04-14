<?php include __DIR__ . "/partials/header.php"; ?>

	<section class="slice slice-lg bg-gradient-dark" data-offset-top="#header-main" style="padding-top: 147.1875px;">
      <div class="container pt-5 pb-6 pt-lg-6 pb-lg-6">
        <div class="row row-grid justify-content-center">
          <div class="col-lg-7 text-center">
            <h6 class="text-uppercase text-sm ls-2 text-info font-weight-700">
	            <?= $this->pageTitle ?>
            </h6>
            <h1 class="text-white mb-4">
	        	Welcome, <?= $this->user["username"] ?>
            </h1>
            <p class="lead text-muted lh-180 mb-0">Welcome to your settings page. Here you can update your email address and other information on your profile. Your profile will be <a href="/<?= strtolower(
            	$this->user["username"]
            ) ?>">publicly visible here</a>.</p>
          </div>
        </div>
      </div>
    </section>
                    <?php include __DIR__ . "/partials/message.php"; ?>
					<div class="container">
                    <form method="post" id="form-settings">
                        <input name="csrf" type="hidden" value="<?= $this->csrf ?>">

                        <label for="email">Username</label>
                        <input readonly type="text" value="<?= $this->user[
                        	"username"
                        ] ?>">
                        <small>Username cannot be changed.</small>

                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" value="<?= $this
                        	->user["email"] ?>">

                        <label for="forename">Forename</label>
                        <input type="text" name="forename" id="forename" value="<?= $this
                        	->user["forename"] ?>">

                        <label for="surname">Surname</label>
                        <input type="text" name="surname" id="surname" value="<?= $this
                        	->user["surname"] ?>">

                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" value="<?= $this
                        	->user["phone"] ?>">

                        <input type="submit" value="Update">
                    </form>
                    </div>
 
            <div class="flex-large">
                <div class="card solo">
                    <h2>Delete account</h2>
                    <p>Warning! There is no undoing this action! All of your user data and associated list data will be permanently removed
                        from the database.</p>

                    <form id="form-delete-user">
                        <input name="csrf" type="hidden" value="<?= $this->csrf ?>">
                        <input type="hidden" name="delete_user" value="true">
                        <input type="hidden" name="list_id" value="<?= $this
                        	->user["id"] ?>">
                        <input type="submit" value="Delete">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . "/partials/footer.php"; ?>
