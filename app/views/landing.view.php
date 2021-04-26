<?php include __DIR__ . "/partials/header.php"; ?>

	<section class="slice slice-lg bg-gradient-dark" data-offset-top="#header-main" style="padding-top: 147.1875px;">
      <div class="container pt-5 pb-6 pt-lg-6 pb-lg-6">
        <div class="row row-grid justify-content-center">
          <div class="col-lg-7 text-center">
            <h6 class="text-uppercase text-sm ls-2 text-info font-weight-700">
	            <?= $this->pageTitle ?>
            </h6>
            <h1 class="text-white mb-4">
	        	Perunio
            </h1>
        <p class="lead text-muted lh-180 mb-0">Perunio is a project created by <a href="https://www.langeler.se" target="_blank">Joakim Langeler</a> to learn how to make a modern MVC framework from scratch without using any libraries or dependencies. Since Laconia has no external frameworks, it can be a helpful starting point for beginner PHP developers to learn the concepts of authentication, object-oriented architecture, Model-View-Controller concepts, routing, and creating a database schema.</p>
          </div>
        </div>
      </div>
    </section>

<section class="content-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="card text-center">
                    <h3>MVC</h3>
                    <p>Uses Model View Controller architecture.</p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card text-center">
                    <h3>Routing</h3>
                    <p>Route all your pages through a single entry point.</p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card text-center">
                    <h3>Authentication</h3>
                    <p>Create secure users with hashed passwords.</p>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include __DIR__ . "/partials/footer.php";
?>
