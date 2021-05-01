<?php include VIEW_DIR . DS . "partials" . DS . "header.php"; ?>

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
		<?php if ($pageData["cart"]): ?>
			<?php foreach ($pageData["cart"] as $items => $item):

   	// Set image placeholder variable
   	$placeholder = $this->getImage("placeholder.jpg");
   	$placeholderDesc = "This product doesn't have any images.";

   	// Check if product have any images else return placeholder
   	$item["image"] != false
   		? ($imgUrl = $this->getImage(
   			"upload" .
   				DS .
   				$item["product"]["id"] .
   				DS .
   				$item["image"]["name"]
   		))
   		: ($imgUrl = $placeholder);

   	// Check if product have any images else return placeholder
   	$item["image"] != false
   		? ($imgDesc = $item["image"]["description"])
   		: ($imgDesc = $placeholderDesc);
   	?>
			<div class='col-sm-6 col-md-9'>
				<form action="" method="post">

					<input name="csrf" type="hidden" value="<?= $pageData["csrf"] ?>">

						<?= $item["id"] ?>
						<?= $item["product"]["id"] ?>
						<?= $item["product"]["name"] ?>
						<?= $item["category"]["id"] ?>
						<?= $item["category"]["name"] ?>
						<?= $item["type"]["id"] ?>
						<?= $item["type"]["name"] ?>

						<label for="quantity[<?= $item["id"] ?>]">
						Quantity
						</label>
						<input type="number" name="quantity[<?= $item["id"] ?>]" id="quantity[<?= $item[
	"quantity"
] ?>]" class="form-control" value="<?= $item["quantity"] ?>">

						<input type="submit" class="btn btn-primary my-3" value="Update">
						<a href="cart/remove/<?= $item["id"] ?>" class="btn btn-danger my-3">
							Remove
						</a>
				</form>
			</div>

			<div class='col-sm-6 col-md-3'>
				<a href="cart/empty" class="btn btn-danger my-3">
					Empty cart
				</a>
			</div>
			<?php
   endforeach; ?>
		<?php else: ?>
		<p>
			Your cart is empty!
		</p>
		<?php endif; ?>
	</div>
</div>

<?php include VIEW_DIR . DS . "partials" . DS . "footer.php";
?>
