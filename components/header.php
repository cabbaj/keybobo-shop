<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img class="me-2" src="img/logo.png" width="40" height="40" alt="logo">Keybobo Shop
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="index.php">Home</a>
                </li>
            </ul>

            <?php if ($authenticated): ?>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Admin
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            <?php else: ?>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="btn btn-outline-primary me-2" href="register.php">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary" href="login.php">Login</a>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</nav>