<nav class="client_auth">
    <div><a href="<?php echo $address ?>/" class="brand">The E-Store</a>
        <?php
        session_start();

        if (isset($_SESSION['logged'])) {
        ?>
            <a href="<?php echo $address ?>/client/">Home</a>
            <a href="<?php echo $address ?>/client/">Catalog</a>
        <?php
        }
        ?>
    </div>
    <div>
        <?php

        if (isset($_SESSION['logged'])) {
        ?>
            <a href="<?php echo $address ?>/auth/logout.php">Logout</a>
        <?php
        } else { ?>
            <a href="<?php echo $address ?>/client/login.php">Login</a>
            <a href="<?php echo $address ?>/client/register.php" class="btn btn-outline-light bordered">Sign Up</a>
        <?php }
        ?>

    </div>
</nav>