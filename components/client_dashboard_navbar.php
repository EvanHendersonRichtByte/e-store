<?php include_once "../config/config.php" ?>
<nav class="client_dashboard">
    <div>
        <a href="<?php echo $address ?>/" class="brand">The E-Store</a>
        <a href="<?php echo $address ?>/client/">Home</a>
        <a href="<?php echo $address ?>/client/">Catalog</a>
    </div>
    <div>
        <a class="cart" href="<?php echo $address ?>/client/cart.php">
            <i class="ri-shopping-cart-fill"></i>
        </a>
        <div class="image">
            <img src="../assets/static_images/dummy.png" alt="dummy">
        </div>
        <div class="popup_menu">
            <input id="toggle_popup" type="checkbox">
            <label for="toggle_popup"><i class="ri-arrow-down-s-fill"></i></label>
            <ul class="menu">
                <li><a href="<?php echo $address ?>/client/settings_profile.php">Settings Profile</a></li>
                <li><a href="<?php echo $address ?>/client/settings_password.php">Settings Password</a></li>
                <li><a href="<?php echo $address ?>/client/settings_email.php">Settings Email</a></li>
                <li><a href="<?php echo $address ?>/logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>