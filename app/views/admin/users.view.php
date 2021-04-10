<?php include __DIR__ . "/partials/header.php"; ?>

	<section class="slice slice-lg bg-gradient-dark" data-offset-top="#header-main" style="padding-top: 147.1875px;">
      <div class="container pt-5 pb-6 pt-lg-6 pb-lg-6">
        <div class="row row-grid justify-content-center">
          <div class="col-lg-7 text-center">
            <h6 class="text-uppercase text-sm ls-2 text-info font-weight-700">
	            <?= $this->pageTitle ?>
            </h6>
            <p>In a real application, it wouldn't really make sense to just list all your users. But for ease of testing, I made
                this page.</p>
          </div>
        </div>
      </div>
    </section>

	<div class="container">
		<a href="/admin/user/create/" class="btn btn-primary my-2">
			Create User
		</a>
		
            <?php foreach ($this->users as $user): ?>
                <div class="listing">
                    <span><?= $user["id"] ?></span>
                    <a class="items list-item" href="/admin/user/update/<?= strtolower(
                    	$user["id"]
                    ) ?>">
                        <?= $user["username"] ?>
                    </a>
                </div>
            <?php endforeach; ?>
   </div>

<?php include __DIR__ . "/partials/footer.php";
?>
