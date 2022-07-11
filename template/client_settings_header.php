<?php include_once "../template/header.php"  ?>

<?php include "../components/client_dashboard_navbar.php" ?>

<section class="client-settings container mt-4  ">
    <h3>Settings</h3>
    <hr>
    <div class="row">
        <nav class="nav flex-column col">
            <a class="nav-link text-dark active" aria-current="page" href="<?php echo $address ?>/client/settings_profile.php">Username</a>
            <a class="nav-link text-dark" href="<?php echo $address ?>/client/settings_password.php">Password</a>
            <a class="nav-link text-dark" href="<?php echo $address ?>/client/settings_email.php">Email</a>
        </nav>