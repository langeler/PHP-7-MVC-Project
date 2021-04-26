<?php include __DIR__ . "/partials/header.php"; ?>

	<section class="slice slice-lg bg-gradient-dark" data-offset-top="#header-main" style="padding-top: 147.1875px;">
      <div class="container pt-5 pb-6 pt-lg-6 pb-lg-6">
        <div class="row row-grid justify-content-center">
          <div class="col-lg-7 text-center">
            <h6 class="text-uppercase text-sm ls-2 text-info font-weight-700">
	            <?= $this->pageTitle ?>
            </h6>
            <h1 class="text-white mb-4">
	        	Welcome, <?= $this->account["username"] ?>
            </h1>
            <p class="lead text-muted lh-180 mb-0">This is the place where you can find the custom built shortcodes especially for this theme based on the components, already, described in the Documentation.</p>
          </div>
        </div>
      </div>
    </section>

<section class="content-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="card text-center">
                    <h3>My profile</h3>
                    <p>View your public profile.</p>
                    <a class="button" href="/<?= strtolower(
                    	$this->account["username"]
                    ) ?>">View Profile</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card text-center">
                    <h3>My settings</h3>
                    <p>Update your settings.</p>
                    <a class="button" href="/settings">Update Settings</a>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . "/partials/footer.php";
?>
