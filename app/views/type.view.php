<?php include VIEW_DIR . DS . "partials" . DS . "header.php"; ?>

<?php if ($pageData["product"]): ?>
<section class="slice">
	<div class="container">
		<div class="row row-grid">
			<div class="col-lg-6">
				<div data-toggle="sticky" data-sticky-offset="30" class="" style="">
				<?php if ($pageData["images"]): ?>
					<?php foreach ($pageData["images"] as $images => $image): ?>
						<?php
      // Set image placeholder variable
      $placeholder = $this->getImage("placeholder.jpg");
      $placeholderDesc = "This product doesn't have any images.";

      // Check if product have any images else return placeholder
      $image["type_id"] != false
      	? ($imgUrl = $this->getImage(
      		"upload" . DS . $image["type_id"] . DS . $image["name"]
      	))
      	: ($imgUrl = $placeholder);

      // Check if product have any images else return placeholder
      $image["description"] != false
      	? ($imgDesc = $image["description"])
      	: ($imgDesc = $placeholderDesc);
      ?>
					<a href="<?php $imgUrl; ?>" data-fancybox="">
						<img class="img-fluid" src="<?= $imgUrl ?>" alt="<?= $imgDesc ?>">
					</a>
					<?php endforeach; ?>
				<?php endif; ?>
				</div>
			</div>

			<div class="col-lg-6">
				<div class="pl-lg-5">
					<h5 class="h4">
						<?= $pageData["type"]["name"] ?>
					</h5>

					<h6 class="text-sm">
						<?= $pageData["product"]["name"] ?>
					</h6>

					<div class="py-4 my-4 border-top border-bottom">
						<h6 class="text-sm">
							<?= $pageData["type"]["description"] ?>:
						</h6>

						<p class="text-sm mb-0">
							<?= $pageData["product"]["description"] ?>
						</p>
					</div>

					<form method="post" action="">

						<input name="csrf" type="hidden" value="<?= $pageData["csrf"] ?>">

						<?php foreach ($pageData["questions"] as $question): ?>
						<div class=" py-4 my-4 border-top border-bottom">
							<h6 class="mt-5">
								<?= $question["name"] ?>
							</h6>

							<div class="btn-group-toggle btn-group-options row mx-0 mt-3 mb-5" data-toggle="buttons">
							<?php $counter = 0; ?>
							<?php $this->optionModel->qid = $question["id"]; ?>
							<?php foreach ($this->optionModel->readAll() as $option): ?>
								<?php if ($question["id"] == $option["question_id"]): ?>


									<?php if ($counter == 0): ?>
									<label class="btn btn-lg btn-neutral col-12 mb-2 text-left text-sm active">
										<input type="radio" name="<?= $question["id"] ?>" value="<?= $option[
	"id"
] ?>" checked="">
										<?= $option["name"] . $option["description"] ?>
									</label>
									<?php else: ?>
									<label class="btn btn-lg btn-neutral col-12 mb-2 text-left text-sm">
										<input type="radio" name="<?= $question["id"] ?>" value="<?= $option["id"] ?>">
										<?= $option["name"] . $option["description"] ?>
									</label>
									<?php endif; ?>
								<?php $counter = $counter + 1; ?>
								<?php endif; ?>
							<?php endforeach; ?>
							</div>
						<?php endforeach; ?>

							<input name="product" value="<?= $pageData["product"]["id"] ?>" type="hidden">

							<input name="type" value="<?= $pageData["type"]["id"] ?>" type="hidden">

							<input class="form-control" min="0" name="quantity" value="1" type="number">

							<div class="row align-items-center mt-4">
								<div class="col-sm-6 mb-4 mb-sm-0">
									<span class="d-block h3 mb-0">
										<?= $pageData["type"]["price"] ?> Kr
									</span>
								</div>

								<div class="col-sm-6 text-sm-right">

									<!-- Add to cart -->
									<button type="submit" class="btn btn-primary btn-icon">
										<span class="btn-inner--icon">
											<i class="fas fa-shopping-bag"></i>
										</span>

										<span class="btn-inner--text">
											Add to bag
										</span>
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
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
