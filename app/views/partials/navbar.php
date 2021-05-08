<!-- Navbar primary -->
    <nav class="navbar navbar-horizontal navbar-expand-lg navbar-dark bg-gradient-dark">
        <div class="container">

            <a class="navbar-brand" href="/">
                <?= SITE_NAME ?>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-primary" aria-controls="navbar-primary" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbar-primary">
                <ul class="navbar-nav align-items-lg-center">
                    <li class="nav-item ">
                        <a class="nav-link" href="/">
                            Home
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link" href="/about">
                            About
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link" href="/contact">
                            Contact
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link" href="/products">
                            Products
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="navbar-primary_dropdown_1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Categories <i class="fas fa-caret-down"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-primary_dropdown_1">
                            <?php foreach (
                            	$this->getCategories()
                            	as $category
                            ): ?>

                                <a class="dropdown-item" href="/category/<?= $category[
                                	"id"
                                ] ?>/<?= $category["name"] ?>">
                                    <?= $category["name"] ?>
                                </a>

                            <?php endforeach; ?>
                        </div>
                    </li>
                </ul>

                <ul class="navbar-nav ml-lg-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/cart">
                            Cart
                        </a>
                    </li>

                    <?php if ($this->isAdmin()): ?>

                    <li class="nav-item">
                        <a class="nav-link" href="/admin">
                            Admin
                        </a>
                    </li>

                    <?php endif; ?>

                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="navbar-primary_dropdown_1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Account
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-primary_dropdown_1">

                            <?php if ($this->isUserLoggedIn()): ?>

                            <a class="dropdown-item" href="/profile">
                                Profile
                            </a>

                            <a class="dropdown-item" href="/settings">
                                Settings
                            </a>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="/logout">
                                Logout
                            </a>

                            <?php else: ?>

                            <a class="dropdown-item" href="/login">
                                Login
                            </a>

                            <a class="dropdown-item" href="/register">
                                Register
                            </a>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="/recover">
                                Recover
                            </a>
                            <?php endif; ?>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
