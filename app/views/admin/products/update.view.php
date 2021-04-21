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
                        <label for="name">Name</label>
                        <input class="form-control" type="text" name="name" id="name" value="<?= $pageData["product"]["name"] ?>">
						</div>
						
						<div class="form-group">
                        <label for="description">Description</label>
                        <input class="form-control" type="text" name="description" id="description" value="<?= $pageData["product"]["description"] ?>">
						</div>

						<div class="form-group">
						<label for="category">Status</label>
						<select id="category" name="category" class="form-control">
						<?php foreach ($pageData['categories'] as $category): ?>
							<option value="<?php echo $category['id'] ?>"<?php echo $category['id'] == $pageData["product"]["category_id"] ? ' selected' : '' ?>><?php echo $category['name'] ?></option>
						<?php endforeach ?>
						</select>
						</div>						

						<div class="form-group">
						<label for="status">Status</label>
						<select id="status" name="status" class="form-control">
						<?php foreach ($pageData['status'] as $key => $value): ?>
							<option value="<?php echo $value ?>"<?php echo $value == $pageData["product"]["status"] ? ' selected' : '' ?>><?php echo $key ?></option>
						<?php endforeach ?>
						</select>
						</div>
						
						<div class="form-group">
                        <input class="btn btn-primary" type="submit" value="Update">
						</div>
                    </form>
				</div>
        </div>
	</div>
</div>
</section>

<?php include VIEW_DIR . DS . "admin/partials/footer.php";