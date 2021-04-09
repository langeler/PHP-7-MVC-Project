<?php include __DIR__ . '/partials/header.php'; ?>

	<section class="slice slice-lg bg-gradient-dark" data-offset-top="#header-main" style="padding-top: 147.1875px;">
      <div class="container pt-5 pb-6 pt-lg-6 pb-lg-6">
        <div class="row row-grid justify-content-center">
          <div class="col-lg-7 text-center">
            <h6 class="text-uppercase text-sm ls-2 text-info font-weight-700">
	            <?= $this->pageTitle; ?>
            </h6>
            <h1 class="text-white mb-4"> 
	        <a class="button accent-button" href="/create">
		        Create a new list
		        </a></h1>
          </div>
        </div>
      </div>
    </section>
    
		<div class="container">
          <?php include __DIR__ . '/partials/message.php'; ?>
            <?php if (!empty($this->lists)) : ?>

                <?php foreach ($this->lists as $list) : ?>
                    <div class="items card">
                        <div class="list-item">
                            <?= $list['title']; ?>
                        </div>
                        <div class="list-options">
                            <a class="button" href="/<?= strtolower($this->user['username']); ?>">View</a>
                            <a href="/edit/<?= $list['id']; ?>" class="button">Edit</a>
                            <form id="form-delete-list_<?= $list['id']; ?>">
                                <input name="csrf" type="hidden" value="<?= $this->csrf; ?>">
                                <input type="hidden" name="delete" value="true">
                                <input type="hidden" name="list_id" value="<?= $list['id']; ?>">
                                <input type="submit" value="Delete">
                            </form>
                        </div>
                    </div>
                <?php endforeach ?>
            <?php else : ?>
                <p>No lists to display. <a href="/create">Create a new list?</a></p>
            <?php endif; ?>
		</div>

<?php include __DIR__ . '/partials/footer.php'; ?>