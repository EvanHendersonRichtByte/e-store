<nav class="col-3 nav flex-column justify-content-around border-end  min-vh-100">
    <div class="sidebar row align-items-center">
        <div class="col-md-4 d-flex justify-content-center">
            <img src="../assets/static_images/dummy.png">
        </div>
        <div class="col">
            <h4>Anonymous</h4>
            <h6>Officer</h6>
        </div>
    </div>
    <h5 class="nav-link text-dark fw-semibold m-0 mt-3 ms-2">Menu</h5>
    <a class="nav-link" aria-current="page" href="<?php echo $address ?>/admin/"><i class="mx-2 bi bi-speedometer2"></i>Dashboard</a>
    <a class="nav-link" href="<?php echo $address ?>/admin/product.php"><i class="mx-2 bi bi-box"></i>Products</a>
    <a class="nav-link" href="<?php echo $address ?>/admin/active_order.php"><i class="mx-2 bi bi-card-checklist"></i>Active Orders</a>
    <a class="nav-link" href="<?php echo $address ?>/admin/transaction_list.php"><i class="mx-2 bi bi-handbag"></i>Transaction List</a>
    <h5 class="nav-link text-dark fw-semibold m-0 ms-2 mt-5">Settings</h5>
    <a class="nav-link" href="<?php echo $address ?>/admin/settings_profile.php"><i class="mx-2 bi bi-person-badge"></i>Change Profile</a>
    <a class="nav-link" href="<?php echo $address ?>/admin/settings_password.php"><i class="mx-2 bi bi-file-lock"></i>Change Password</a>
    <a class="nav-link" href="<?php echo $address ?>/admin/settings_email.php"><i class="mx-2 bi bi-envelope"></i>Change Email</a>
    <a class="nav-link" href="<?php echo $address ?>/auth/logout.php"><i class="mx-2 bi bi-door-open"></i>Logout</a>
</nav>

<script>
    const address = window.location.href;
    $(document).ready(() => {
        console.log('ok')
    })
</script>