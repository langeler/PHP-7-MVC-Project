<?php include VIEW_DIR . DS . "admin/partials/header.php"; ?>
    
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

<div class='container mt-3'>
	<div class='row'>
		<?php if($pageData['product']): ?>		
			<div class='col-sm-12'>
				<div class="card">
					<a href="/category/<?= $pageData['category']['id'] ?>/<?= $pageData['category']['name'] ?>">
						<?= $pageData['category']['name'] ?>
					</a>
					<h3 class="card-title">
						<?= $pageData['product']['name'] ?>
					</h3>
					
					<p class="card-text">
						<?= $pageData['product']['description'] ?>
					</p>
					
					<form method="post" action="">
						
						<input name="csrf" type="hidden" value="<?= $pageData['csrf'] ?>">
						
						<?php foreach ($pageData['types'] as $types => $type):?>						
						<select name="type" class="form-control my-3">
							<option value="<?= $type['id']?>"><?= $type['name'] . ' - ' . $type['price'] ?> kr</option>
						</select>
						<?php endforeach; ?>
						
						<input class="form-control" min="0" name="quantity" value="1" type="number">
						
						<button type="submit" class="btn btn-block btn-primary my-3">
							Add to cart
						</button>
				</div>
			</div>
		<?php else:?>
		<p>
			No products were found!
		</p>
		<?php endif; ?>	
	</div>
</div>

<?php include VIEW_DIR . DS . "admin/partials/footer.php";