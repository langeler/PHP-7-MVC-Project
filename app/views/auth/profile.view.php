<?php include VIEW_DIR . DS . "partials" . DS . "header.php"; ?>

	<section class="slice slice-lg bg-gradient-dark" data-offset-top="#header-main" style="padding-top: 147.1875px;">
      <div class="container pt-5 pb-6 pt-lg-6 pb-lg-6">
        <div class="row row-grid justify-content-center">
          <div class="col-lg-7 text-center">
            <h6 class="text-uppercase text-sm ls-2 text-info font-weight-700">
	            <?= $this->pageTitle ?>
            </h6>
            <h1 class="text-white mb-4">
	        	<?= $pageData["account"]["username"] ?>
            </h1>

		<p>
        <?php if (!empty($pageData["account"]["forename"])): ?>
        	<?= $pageData["account"]["forename"] ?>
        <?php endif; ?>

        <?php if (!empty($pageData["account"]["surname"])): ?>
       		<?= $pageData["account"]["surname"] ?>
        <?php endif; ?>
        </p>

        <?php if (!empty($pageData["account"]["email"])): ?>
       		<?= $pageData["account"]["email"] ?>
        <?php endif; ?>
        </p>
    </div>
 </div>
 </div>
</section>

<section class="content-section">
    <div class="container">

    </div>
</section>

<?php include VIEW_DIR . DS . "partials" . DS . "footer.php";
?>
