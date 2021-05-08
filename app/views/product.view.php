<?php include VIEW_DIR . DS . "partials" . DS . "header.php"; ?>


<?php if ($pageData["product"]): ?>
<section class="section-process">
	<div class="section-process-step">
		<div class="container">
			<div class="mb-5 text-center">
				<h1 class=" mt-4">
					<?= $pageData["product"]["name"] ?>
				</h1>

				<div class="fluid-paragraph mt-3">
					<p class="lead lh-180">
						<?= $pageData["product"]["description"] ?>
					</p>
				</div>
			</div>
			<div class="row row-grid align-items-center justify-content-between">
				<?php foreach ($pageData["types"] as $types => $type): ?>
					<div class="col-xl-5 col-lg-6 order-lg-2">
						<div class="pr-md-4">
							<span class="badge badge-soft-info badge-pill">
								<a href="/category/<?= $pageData["category"]["id"] ?>/<?= $pageData["category"][
	"name"
] ?>">
									<?= $pageData["category"]["name"] ?>
								</a>
							</span>

							<h3 class="mt-4">
								<?= $type["name"] ?>
							</h3>

							<p class="lead my-4">
								<?= $type["description"] ?>
							</p>

							<div class="row align-items-center">
								<div class="col-sm-6 mb-4 mb-sm-0 mt-4">
									<span class="d-block h3 mb-0">
										<?= $type["price"] ?> Kr
									</span>
								</div>

								<div class="col-sm-6 text-sm-right">
									<a href="/product/type/<?= $pageData["product"]["id"] ?>/<?= $type[
	"id"
] ?>/<?= $this->slugify($pageData["product"]["name"]) ?>/<?= $this->slugify(
	$type["name"]
) ?>" class="btn btn-primary btn-icon rounded-pill mt-4">
										<span class="btn-inner--icon">
											<i class="fas fa-cart-plus"></i>
										</span>

										<span class="btn-inner--text">
											Purchase
										</span>
									</a>
								</div>
							</div>

							<?php $this->questionModel->tid = $type["id"]; ?>
							<?php foreach ($this->questionModel->readAll() as $question): ?>

								<?php if ($type["id"] == $question["type_id"]): ?>
								<div class="d-flex align-items-center my-5">
									<div class="icon text-primary">
										<img alt="Image placeholder" src="<?= DOMAIN ?>assets/img/svg/icons/Coupon_2.svg" "class="svg-inject">
									</div>

									<div class="icon-text pl-4">
										<h5>
											<?= $question["name"] ?>
										</h5>

										<p class="mb-0">
											<?= $question["description"] ?>
										</p>
									</div>
								</div>
								<?php endif; ?>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>

<?php else: ?>
	<p>
		No products were found!
	</p>
<?php endif; ?>

<?php include VIEW_DIR . DS . "partials" . DS . "footer.php";
?>
