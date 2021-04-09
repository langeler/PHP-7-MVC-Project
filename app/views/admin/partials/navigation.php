    <!-- Topbar -->
    <div id="navbar-top-main" class="navbar-top  navbar-dark bg-dark border-bottom">
      <div class="container px-0">
        <div class="navbar-nav align-items-center">
          <div>
            <ul class="nav">
              <li class="nav-item dropdown ml-lg-2">
                <a class="nav-link px-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="0,10">
                  <img alt="Image placeholder" src="../../assets/img/icons/flags/us.svg">
                  <span class="d-none d-lg-inline-block">English</span>
                  <span class="d-lg-none">EN</span>
                </a>
                <div class="dropdown-menu dropdown-menu-sm">
                  <a href="#" class="dropdown-item"><img alt="Image placeholder" src="../../assets/img/icons/flags/se.svg">Swedish</a>
                  <a href="#" class="dropdown-item"><img alt="Image placeholder" src="../../assets/img/icons/flags/es.svg">Spanish</a>
                </div>
              </li>
            </ul>
          </div>
          <div class="ml-auto">
            <ul class="nav">
              <li class="nav-item">
                <a href="#" class="nav-link" data-action="omnisearch-open" data-target="#omnisearch"><i class="fas fa-2x fa-search"></i></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../../pages/shop/checkout-cart.html">
	                <i class="fas fa-2x fa-shopping-cart"></i></a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-2x fa-user-circle"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                  <h6 class="dropdown-header">Account</h6>
                  
                  <?php if ($this->session->isUserLoggedIn()) : ?> 
                  <a class="dropdown-item" href="/dashboard">
                    <i class="fas fa-user"></i>Dashboard
                  </a>
                  <a class="dropdown-item" href="/lists">
                    <span class="float-right badge badge-primary">1</span>
                    <i class="fas fa-list"></i>Lists
                  </a>
                 <a class="dropdown-item" href="/<?= $this->session->getSessionValue('username'); ?>">
                    <i class="fas fa-user"></i>Profile
                  </a>
             
                  <a class="dropdown-item" href="/settings">
                    <i class="fas fa-cog"></i>Settings
                  </a>
                  <div class="dropdown-divider" role="presentation"></div>
                  <a class="dropdown-item" href="/logout">
                    <i class="fas fa-sign-out-alt"></i>Sign out
                  </a>
                  <?php else : ?>
                  
                  <a class="dropdown-item" href="/login">
                    <i class="fas fa-sign-in-alt"></i>Sign in
                  </a>
                  <a class="dropdown-item" href="/register">
                    <i class="fas fa-plus"></i>Sign up
                  </a>
                  <?php endif; ?>
                </div>
              </li>
            </ul>

          </div>
        </div>
      </div>
    </div><!-- End of top navbar -->
	
	<!-- Main navbar -->
    <nav class="navbar navbar-main navbar-expand-lg navbar-transparent navbar-dark bg-dark" id="navbar-main">
      <div class="container px-lg-0">
        <!-- Logo -->
        <a class="navbar-brand mx-3" href="/">
          <img alt="Image placeholder" src="<?= $this->getImage('text.png'); ?>" id="navbar-logo" style="height: 50px;">
        </a>
        <!-- Navbar collapse trigger -->
        <button class="navbar-toggler pr-0" type="button" data-toggle="collapse" data-target="#navbar-main-collapse" aria-controls="navbar-main-collapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Navbar nav -->
        <div class="collapse navbar-collapse" id="navbar-main-collapse">
          <ul class="navbar-nav pt-3 ml-2 align-items-lg-center">
            <!-- Home - Overview  -->
            <li class="nav-item">
              <a class="nav-link" href="/">Home</a>
            </li>
                        <!-- Home - Overview  -->
            <li class="nav-item">
              <a class="nav-link" href="/about">About</a>
            </li>
            
            <?php if ($this->session->isUserLoggedIn()) : ?> 
            <li class="nav-item">
              <a class="nav-link" href="/lists">Lists</a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="/settings">Settings</a>
            </li>
            
			<li class="nav-item">
              <a class="nav-link" href="/dashboard">Dashboard</a>
            </li>
            <?php endif; ?>
          </ul>
          
          <ul class="navbar-nav pt-3 align-items-lg-center ml-lg-auto">
			<li class="nav-item d-lg-none d-xl-block">
              <a class="nav-link" href="../../docs/changelog.html" target="_blank">
	              Delightful Meal'N'Snacks
	          </a>
            </li>
            
            <li class="nav-item mr-0">
              <a href="/" target="_blank" class="nav-link d-lg-none">
	              Order now
	           </a>
              
              <a href="/" target="_blank" class="btn btn-sm btn-dark btn-icon rounded-pill d-none d-lg-inline-flex" data-toggle="tooltip" data-placement="left" title="Breakfast, Lunch'N'Brunch">
                <span class="btn-inner--icon">
                	<i class="fas fa-shopping-cart"></i>
                </span>
                <span class="btn-inner--text">
                	Order now
                </span>
              </a>
            </li>
          </ul>
		</div>
	  </div>
	</nav>