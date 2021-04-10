<?php include __DIR__ . "/partials/header.php"; ?>

	<section class="slice slice-lg bg-gradient-dark" data-offset-top="#header-main" style="padding-top: 147.1875px;">
      <div class="container pt-5 pb-6 pt-lg-6 pb-lg-6">
        <div class="row row-grid justify-content-center">
          <div class="col-lg-7 text-center">
            <h6 class="text-uppercase text-sm ls-2 text-info font-weight-700">
	            <?= $this->pageTitle ?>
            </h6>
            <h1 class="text-white mb-4">
	        	<?= $this->user["username"] ?>
            </h1>
		
        <?php if (!empty($this->user["description"])): ?>
            <p> <?= $this->user["description"] ?> </p>
        <?php endif; ?>
        

        <?php if (empty($this->user["description"])): ?>
           <p><div> Welcome to the <?= $this->user[
           	"username"
           ] ?>'s public Laconia page! <?= $this->user[
	"username"
] ?> has not written a description yet. Please check back later.</div></p>
        <?php endif; ?>
    </div>
 </div>
 </div>
</section>

<section class="content-section">
    <div class="container">

        <?php if (!empty($this->lists)): ?>
            <div class="flex-grid">
                <?php foreach ($this->lists as $list): ?>
                    <div class="card lists">
                        <h3 class="list-title">
                            <?= $list["title"] ?>
                        </h3>

                        <div class="list-items">
                            <ul>
                                <?php foreach (
                                	$this->list->getListItemsByListId(
                                		$list["id"]
                                	)
                                	as $listItem
                                ): ?>
                                    <li>
                                        <?= $listItem["name"] ?>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="card text-center">
                <h3 class="no-margin-bottom"><?= $this->user[
                	"username"
                ] ?> hasn't made any lists yet.</h3>
            </div>
        <?php endif; ?>

    </div>
</section>

<?php include __DIR__ . "/partials/footer.php"; ?>
