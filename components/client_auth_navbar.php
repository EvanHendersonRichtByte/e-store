<nav class="navbar navbar-dark navbar-expand-lg bg-transparent">
    <div class="container">
        <a class="navbar-brand" href="<?php echo $address ?>/">The Estore</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?php echo $address ?>/client/">Home</a>
                </li>
                <?php
                session_start();

                if (isset($_SESSION['logged'])) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $address ?>/client/">Catalog</a>
                    </li>
                <?php
                }
                ?>

            </ul>
            <ul class="d-flex navbar-nav">
                <?php
                if (isset($_SESSION['logged'])) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $address ?>/auth/logout.php">Logout <i class="bi bi-box-arrow-right"></i></a>
                    </li>
                <?php
                } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $address ?>/client/login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $address ?>/client/register.php">Sign Up</a>
                    </li>
                <?php }
                ?>
            </ul>
        </div>
    </div>
</nav>