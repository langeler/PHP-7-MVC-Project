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
	<div class="row">
		<div class="col-md-6 px-0">
			<form class="form-inline float-left "  action='<?= $pageUrl ?>' method="get">
				<input class="form-control mr-sm-2" type="search" placeholder="Type a name..." name="search" id="search" <?php echo isset($pageData['search']) ? "value='{$pageData['search']}'" : ""; ?> aria-label="Search">
			    <button class="btn btn-primary my-2 my-sm-0" type="submit"><i class="fas fa-search"></i> Search</button>
			</form>
		</div>
		<div class="col-md-6">
			<a href="/admin/category/create/" class='btn btn-success float-right'>
				<i class='fas fa-plus'></i> Create Record
			</a>
		</div>
	</div>
</div>

<div class='container mt-3'>
	<div class='row'>
		<div class='col-md-12'>
			<?php if($pageData['categories']): ?>
			<table class='table table-hover table-responsive'>
				<tr>
					<th>Name</th>
					<th>Description</th>
					<th>Actions</th>
				</tr>
				
				<?php foreach ($pageData['categories'] as $category): ?>
				<tr>
					<td>
						<?= $category["name"] ?>
					</td>
					<td>
						<?= $category["description"] ?>
					</td>
					<td>
				    	<a class="btn btn-sm btn-primary" href="/admin/category/update/<?= strtolower($category["id"]) ?>">
							Update
						</a>
						
						<a class="btn btn-sm btn-danger" href="/admin/category/delete/<?= strtolower($category["id"]) ?>">
							Delete
						</a>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
			<?php else:?>
			<p>
				No categories were found!
			</p>
			<?php endif; ?>
			
			<?php echo $pageData['pagination'];?>
		</div>
	</div>
</div>
   
<?php include VIEW_DIR . DS . "admin/partials/footer.php";
?>
