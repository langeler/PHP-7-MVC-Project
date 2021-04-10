<?php include __DIR__ . "/partials/header.php"; ?>

	<section class="slice slice-lg bg-gradient-dark" data-offset-top="#header-main" style="padding-top: 147.1875px;">
      <div class="container pt-5 pb-6 pt-lg-6 pb-lg-6">
        <div class="row row-grid justify-content-center">
          <div class="col-lg-7 text-center">
            <h6 class="text-uppercase text-sm ls-2 text-info font-weight-700">
	            <?= $this->pageTitle ?>
            </h6>
            <h1 class="text-white mb-4">
            Create your list! 
            </h1>
	        <p>A list is simply a title and some associated entries. Lists are visible on <a href="/<?= strtolower(
         	$this->user["username"]
         ) ?>">your profile</a>.</p>
          </div>
        </div>
      </div>
    </section>

		<div class="container">
            <?php include __DIR__ . "/partials/message.php"; ?>

            <form method="post" id="form-create-list">
                <input name="csrf" type="hidden" value="<?= $this->csrf ?>">
                <label for="title">Title</label>
                <input type="text" name="title" id="title">

                <label for="list-items">List items</label>
                <div id="list-items">

                    <?php for ($i = 0; $i < 3; $i++): ?>
                        <div class="input-group" id="first-group">
                            <input type="text" id="<?= $i ?>" name="list_item_<?= $i ?>">
                        </div>
                    <?php endfor; ?>

                </div>

                <div class="actions">
                    <input type="submit" value="Create">
                    <a class="button accent-button" href="/lists">Back to Lists</a>
                </div>
            </form>
        </div>

<?php include __DIR__ . "/partials/footer.php"; ?>
