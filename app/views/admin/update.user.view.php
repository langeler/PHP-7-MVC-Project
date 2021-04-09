<?php include __DIR__ . '/partials/header.php'; ?>

	<section class="slice slice-lg bg-gradient-dark" data-offset-top="#header-main" style="padding-top: 147.1875px;">
      <div class="container pt-5 pb-6 pt-lg-6 pb-lg-6">
        <div class="row row-grid justify-content-center">
          <div class="col-lg-7 text-center">
            <h6 class="text-uppercase text-sm ls-2 text-info font-weight-700">
	            <?= $this->pageTitle; ?>
            </h6>
            <p>In a real application, it wouldn't really make sense to just list all your users. But for ease of testing, I made
                this page.</p>
          </div>
        </div>
      </div>
    </section>

	<div class="container">
	
	<h2><?php echo $pageTitle ?></h2>

    <form action="" method="post" class="form responsive-width-100">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Username" value="<?php echo $account['username'] ?>" required>
        
        <label for="email">Email</label>
        <input type="text" id="email" name="email" placeholder="Email" value="<?php echo $account['email'] ?>" required>
        <label for="fullname">Full name</label>
        <input type="text" id="fullname" name="fullname" placeholder="fullname" value="<?php echo $account['fullname'] ?>">
        
        <label for="description">Description</label>
        <input type="text" id="description" name="description" placeholder="description" value="<?php echo $account['description'] ?>">
        
        <label for="role">Role</label>
        <select id="role" name="role" style="margin-bottom: 30px;">
            <?php foreach ($roles as $role): ?>
            <option value="<?php echo $role ?>"<?php echo $role == $account['role'] ? ' selected' : '' ?>><?php echo $role ?></option>
            <?php endforeach ?>
        </select>
        <div class="submit-btns">
        	<input type="submit" name="submit" value="Submit">
        </div>
    </form>
   </div>

<?php include __DIR__ . '/partials/footer.php'; ?>