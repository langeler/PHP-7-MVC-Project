<?php include VIEW_DIR . DS . "admin/partials/header.php"; ?>
    
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
                    <a href="/admin/users/" class="btn btn-secondary my-2">
	                    Go back
                    </a>
                    <h6 class="h3">
	                	<?= $this->pageTitle ?>
                    </h6>
                  </div>
                  <span class="clearfix"></span>
      				
      				<?php include VIEW_DIR . DS . "admin/partials/message.php"; ?>
	  				
	  				<form method="post" id="form-settings">
                        
                        <input name="csrf" type="hidden" value="<?= $pageData['csrf'] ?>">
						
						 <div class="form-group">
						 <label for="forename">Forename</label>
						 <input type="text" class="form-control" id="forename" name="forename">
						 </div>
						 
						 <div class="form-group">
						 <label for="surname">Surname</label>
						 <input type="text" class="form-control" id="surname" name="surname">
						 </div>
						 
						 <div class="form-group">
						 <label for="phone">Phone</label>
						 <input type="text" class="form-control" id="phone" name="phone">
						 </div>
						 
						 <div class="form-group">
						 <label for="username">Username</label>
						 <input type="text" class="form-control" id="username" name="username">
						 </div>
						 
						 <div class="form-group">
						 <label for="password">Password</label>
						 <input type="password" class="form-control" id="password" name="password">
						 </div>
						 
						 <div class="form-group">
						 <label for="cpassword">Confirm Password</label>
						 <input type="password" class="form-control" id="cpassword" name="cpassword">
						 </div>
						 
						 <div class="form-group">
						 <label for="email">Email</label>
						 <input type="email" class="form-control" id="email" name="email">
						 <small>You can register with a fake email.</small>
						 </div>
						 
						<div class="form-group">
						<label for="role">Role</label>
						<select id="role" name="role" class="form-control">
						<?php foreach ($pageData['roles'] as $role): ?>
							<option value="<?php echo $role ?>"><?php echo $role ?></option>
						<?php endforeach ?>
						</select>
						</div>
						 
						<div class="form-group">
						<input type="submit" class="btn btn-success" value="Create">
						</div>
                    </form>
				</div>
        </div>
	</div>
</div>
</section>

<?php include VIEW_DIR . DS . "admin/partials/footer.php";