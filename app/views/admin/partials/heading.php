<!-- Header (account) -->
<section class="header-account-page bg-gradient-dark d-flex align-items-end" data-offset-top="#header-main">

	<!-- Header container -->
	<div class="container pt-4 pt-lg-0">
		<div class="row">
			<div class=" col-lg-12">

				<!-- Salute + Small stats -->
				<div class="row align-items-center mb-4">
					<div class="col-md-5 mb-4 mb-md-0">
						<span class="h2 mb-0 text-white d-block">
							Welcome, <?= $this->session->getsessionvalue("username") ?>
						</span>

						<span class="text-white">
							You're currently viewing, <?= $pageTitle ?>
						</span>
					</div>

					<div class="col-auto flex-fill d-none d-xl-block">
						<p class="text-right">Test text</p>
					</div>
				</div>

				<!-- Account navigation -->
				<div class="d-flex">
					<a href="/admin" class="btn btn-icon btn-group-nav shadow btn-neutral">
						<span class="btn-inner--icon">
							<i class="fas fa-cogs"></i>
						</span>

						<span class="btn-inner--text d-none d-md-inline-block">
							Dashboard
						</span>
					</a>

					<div class="btn-group btn-group-nav shadow ml-auto" role="group" aria-label="Basic example">

						<div class="btn-group" role="group">

							<button class="btn btn-neutral btn-icon d-none d-inline-block d-sm-none" type="button" data-toggle="collapse" data-target="#nav-toggleable-md">

								<span class="btn-inner--icon">
									<i class="fas fa-bars"></i>
								</span>

								<span class="btn-inner--text d-none d-sm-inline-block">
									Account
								</span>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
