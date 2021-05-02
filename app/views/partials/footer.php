</main>

<footer id="footer-main">
	<div class="footer footer-dark bg-gradient-dark">
		<div class="container">
			<div class="row pt-md">
				<div class="col-lg-4 mb-5 mb-lg-0">
					<a href="/">
						<img src="assets/img/logo/text.png" alt="Footer logo" style="height: 70px;">
					</a>

					<p class="my-3"><?= SITE_NAME ?> is a unique and beautiful collection of UI elements that are all flexible and modular. A complete and customizable solution to building the website of your dreams.</p>
				</div>

				<div class="col-lg-2 col-6 col-sm-4 ml-lg-auto mb-5 mb-lg-0">
					<h6 class="heading mb-3">
						Account
					</h6>

					<ul class="list-unstyled">
						<?php if ($this->isUserLoggedIn()): ?>

						<li><a href="/dashboard">Dashboard</a></li>
						<li><a href="/profile">Profile</a></li>
						<li><a href="/settings">Settings</a></li>
						<li><a href="/logout">Logout</a></li>

						<?php else: ?>

						<li><a href="/login">Login</a></li>
						<li><a href="/register">Register</a></li>
						<li><a href="/recover">Recover</a></li>

						<?php endif; ?>
					</ul>
				</div>

				<div class="col-lg-2 col-6 col-sm-4 mb-5 mb-lg-0">
					<h6 class="heading mb-3">
						About
					</h6>

					<ul class="list-unstyled text-small">
						<li><a href="/">Home</a></li>
						<li><a href="/about">About</a></li>
						<li><a href="/contact">Contact</a></li>
						<li><a href="/products">Products</a></li>
					</ul>
				</div>

				<div class="col-lg-2 col-sm-4 mb-5 mb-lg-0">
					<h6 class="heading mb-3">
						Company
					</h6>

					<ul class="list-unstyled">
						<li><a href="/terms">Terms</a></li>
						<li><a href="/privacy">Privacy</a></li>
						<li><a href="/faq">FAQ</a></li>
					</ul>
				</div>
			</div>

			<div class="row align-items-center justify-content-md-between py-4 mt-4 delimiter-top">
				<div class="col-md-6">
					<div class="copyright text-sm font-weight-bold text-center text-md-left">
						© 2018-2019
						<a href="/" class="font-weight-bold" target="_blank">
							<?= SITE_NAME ?>
						</a>. All rights reserved.
					</div>
				</div>

				<div class="col-md-6">
					<ul class="nav justify-content-center justify-content-md-end mt-3 mt-md-0">
						<li class="nav-item">
							<a class="nav-link" href="https://dribbble.com/webpixels" target="_blank">
								<i class="fab fa-dribbble"></i>
							</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="https://www.instagram.com/webpixelsofficial" target="_blank">
								<i class="fab fa-instagram"></i>
							</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="https://github.com/webpixels" target="_blank">
								<i class="fab fa-github"></i>
							</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="https://www.facebook.com/webpixels" target="_blank">
								<i class="fab fa-facebook"></i>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</footer>

<script src="<?php echo $this->getScript("web.core"); ?>"></script>
<script src="<?php echo $this->getLibScript(
	"swiper/dist/js/swiper.min"
); ?>"></script>
<script src="<?php echo $this->getScript("web"); ?>"></script>
</body>
</html>
