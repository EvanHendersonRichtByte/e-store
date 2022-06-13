<?php include_once "../config/config.php";
include_once '../auth/index.php';
checkUser();

$query = "SELECT COUNT(*) 'total_cart' FROM detail_penjualan dp JOIN penjualan p ON dp.id_penjualan = p.id_penjualan WHERE p.status = 'Listed' AND p.id_customer = " . $_SESSION['logged']['id'];
$total_cart = $mysqli->query($query)->fetch_assoc() or die($mysqli->error);
$total_cart = $total_cart['total_cart'] > 0 ? ($total_cart['total_cart'] > 9 ? '9+' : $total_cart['total_cart']) : null;
?>
<nav class="client-dashboard-navbar navbar navbar-light navbar-expand-lg shadow">
    <div class="container">
        <a class="navbar-brand fadeInTop delay" href="<?php echo $address ?>/">The Estore</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active fadeInTop delay-1" aria-current="page" href="<?php echo $address ?>/client/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fadeInTop delay-2" href="<?php echo $address ?>/client/">Catalog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fadeInTop delay-3" href="<?php echo $address ?>/client/transaction.php">Your Transaction</a>
                </li>
            </ul>
            <ul class="d-flex navbar-nav justify-content-sm-start align-items-center">
                <li class="nav-item">
                    <a class="cart nav-link position-relative" href="<?php echo $address ?>/client/cart.php">
                        <i class="bi bi-cart2"></i>
                        <?php
                        if ($total_cart) {
                        ?>
                            <span class="position-absolute translate-middle badge rounded-pill bg-danger"><?php echo $total_cart ?></span>
                        <?php
                        }
                        ?>

                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo $address ?>/components/view_image.php?id_customer=<?php echo $_SESSION['logged']['id'] ?>" alt="image">
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?php echo $address ?>/client/settings_profile.php">Change Profile</a></li>
                        <li><a class="dropdown-item" href="<?php echo $address ?>/client/settings_email.php">Change Email</a></li>
                        <li><a class="dropdown-item" href="<?php echo $address ?>/client/settings_password.php">Change Password</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="<?php echo $address ?>/auth/logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>