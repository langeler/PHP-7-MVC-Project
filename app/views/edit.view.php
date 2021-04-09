<?php include __DIR__ . '/partials/header.php'; ?>

	<section class="slice slice-lg bg-gradient-dark" data-offset-top="#header-main" style="padding-top: 147.1875px;">
      <div class="container pt-5 pb-6 pt-lg-6 pb-lg-6">
        <div class="row row-grid justify-content-center">
          <div class="col-lg-7 text-center">
            <h6 class="text-uppercase text-sm ls-2 text-info font-weight-700">
	            <?= $this->pageTitle; ?>
            </h6>
            <h1 class="text-white mb-4">
            Edit your list
            </h1>
          </div>
        </div>
      </div>
    </section>
	
		<div class="container">
            <?php include __DIR__ . '/partials/message.php'; ?>

            <form method="post" id="form-edit-list">
                <input name="csrf" type="hidden" value="<?= $this->csrf; ?>">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="<?= $this->listTitle['title']; ?>">

                <label for="list-items">List items</label>
                <div id="list-items">

                    <?php foreach ($this->editList as $list) : ?>
                        <div class="input-group" id="first-group">
                            <input type="text" name="<?= $list['id']; ?>" value="<?= $list['name']; ?>">
                        </div>
                    <?php endforeach ?>

                </div>

                <div class="actions">
                    <input type="submit" value="Update">
                    <a class="button accent-button" href="/lists">Back to Lists</a>
                </div>
            </form>
        </div>

<?php include __DIR__ . '/partials/footer.php'; ?>