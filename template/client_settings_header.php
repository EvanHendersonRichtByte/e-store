<?php include_once "../template/header.php"  ?>

<?php include "../components/client_dashboard_navbar.php" ?>

<section class="client--profile">
    <h1>Settings</h1>
    <hr>
    <div class="container">
        <ul class="sidebar">
            <li><a href="<?php echo $address ?>/client/settings_profile.php">Username</a></li>
            <li><a href="<?php echo $address ?>/client/settings_password.php">Password</a></li>
            <li><a href="<?php echo $address ?>/client/settings_email.php">Email</a></li>
        </ul>