<?php include __DIR__ . "/partials/header.php"; ?>
    
  <div class="main-content mt-4">
    <section class="slice slice-lg min-vh-100 d-flex align-items-center bg-section-secondary">
      <!-- SVG background -->
      <div class="bg-absolute-cover bg-size--contain d-none d-lg-block">
        <figure class="w-100">
          <img alt="Image placeholder" src="../../assets/img/svg/backgrounds/bg-3.svg" class="svg-inject">
        </figure>
      </div>
      <div class="container py-5 px-md-0 d-flex align-items-center">
        <div class="w-100">
          <div class="row row-grid justify-content-center justify-content-lg-between align-items-center">
            <div class="col-sm-8 col-lg-6 col-xl-5 order-lg-2">
              <div class="card shadow zindex-100 mb-0">
                <div class="card-body px-md-5 py-5">
                  <div class="mb-5">
                    <h6 class="h3">
	                	<?= $this->pageTitle ?>
                    </h6>
                    <p class="text-muted mb-0">
	                    elcome to your settings page. Here you can update your email address and other information on your profile. Your profile will be <a href="/<?= strtolower(
            	$this->account["username"]
            ) ?>">publicly visible here</a>.
	                </p>
                  </div>
                  <span class="clearfix"></span>
      				<?php include __DIR__ . "/partials/message.php"; ?>
	  				<form method="post" id="form-settings">
                        
                        <input name="csrf" type="hidden" value="<?= $this->csrf ?>">
						
						 <div class="form-group">
                        <label for="email">Username</label>
                        <input readonly class="form-control" type="text" value="<?= $this->account[
                        	"username"
                        ] ?>">
                        <small>Username cannot be changed.</small>
						</div>
						
						  <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" type="text" name="email" id="email" value="<?= $this
                        	->account["email"] ?>">
						</div>
						
						<div class="form-group">
                        <label for="forename">Forename</label>
                        <input class="form-control" type="text" name="forename" id="forename" value="<?= $this
                        	->account["forename"] ?>">
						</div>
						
						<div class="form-group">
                        <label for="surname">Surname</label>
                        <input class="form-control" type="text" name="surname" id="surname" value="<?= $this
                        	->account["surname"] ?>">
						</div>
						
						<div class="form-group">
                        <label for="phone">Phone</label>
                        <input class="form-control" type="tel" name="phone" id="phone" value="<?= $this
                        	->account["phone"] ?>">
						</div>
						
                        <input class="btn btn-primary" type="submit" value="Update">
                    </form>
                    
                    <p class="mt-3">Warning! There is no undoing this action! All of your user data and associated list data will be permanently removed
                        from the database.</p>
                    
                    <form id="form-delete-user">
                        <input name="csrf" type="hidden" value="<?= $this->csrf ?>">
                        <input type="hidden" name="delete_user" value="true">
                        <input type="hidden" name="list_id" value="<?= $this
                        	->account["id"] ?>">
                        <input class="btn btn-danger" type="submit" value="Delete">
                    </form>
				</div>
        </div>
	</div>
</div>
</section>

<?php include __DIR__ . "/partials/footer.php"; ?>
