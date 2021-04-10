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
	
	<h2><?php echo $pageTitle; ?></h2>

    <form action="" method="post" class="form responsive-width-100">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" placeholder="Name" value="" required>
       
        <label for="description">Description</label>
        <input type="text" id="description" name="description" placeholder="Description" value="" required>

        <div class="submit-btns">
        	<input type="submit" name="submit" value="Submit">
        </div>
    </form>
   </div>

<?php include __DIR__ . "/partials/footer.php"; ?>
