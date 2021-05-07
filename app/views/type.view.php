<?php include VIEW_DIR . DS . "partials" . DS . "header.php"; ?>

<div class='container mt-3'>
	<div class='row'>
		<?php if ($pageData["product"]): ?>
			<div class='col-sm-12'>
				<div class="card">
					<a href="/category/<?= $pageData["category"]["id"] ?>/<?= $pageData["category"][
	"name"
] ?>">
						<?= $pageData["category"]["name"] ?>
					</a>
					<h3 class="card-title">
						<?= $pageData["product"]["name"] ?>
					</h3>

					<p class="card-text">
						<?= $pageData["product"]["description"] ?>
					</p>

					<form method="post" action="">

						<input name="csrf" type="hidden" value="<?= $pageData["csrf"] ?>">


						<?php foreach ($pageData["questions"] as $question): ?>
							<label for="options">
								<?= $question["name"] ?>
							</label>
							<select name="options" id="options" class="form-control my-3">
							<?php
       $this->optionModel->qid = $question["id"];
       foreach ($this->optionModel->readAll() as $option): ?>
							<?php if ($question["id"] == $option["question_id"]): ?>
							<option value="<?= $option["id"] ?>"><?= $option["name"] ?></option>
							<?php endif; ?>
							<?php endforeach;
       ?>
							</select>
						<?php endforeach; ?>

						<input class="form-control" name="product" value="<?= $pageData["product"][
      	"id"
      ] ?>" type="hidden">

						<input class="form-control" min="0" name="quantity" value="1" type="number">

						<button type="submit" class="btn btn-block btn-primary my-3">
							Add to cart
						</button>
				</div>
			</div>
		<?php else: ?>
		<p>
			No products were found!
		</p>
		<?php endif; ?>
	</div>
</div>

<?php include VIEW_DIR . DS . "partials" . DS . "footer.php";
?>
