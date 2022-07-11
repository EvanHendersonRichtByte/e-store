<?php include_once "../template/header.php" ?>

<div class="admin-login container-fluid min-vh-100 d-flex align-items-center position-relative overflow-hidden">
    <div class="col-md-6 col-sm-12 mx-auto bg-light p-5 rounded">
        <h3>Welcome back</h3>
        <p>Welcome back! Please enter your details.</p>
        <form action="<?php echo $address ?>/auth/" method="POST">
            <div class="form-group mb-3">
                <label for="username" class="form-label">Username</label>
                <input id="username" type="username" name="username" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" name="password" class="form-control">
            </div>
            <div class="form-group mb-3">
                <button type="submit" class="btn btn-dark" name="admin-login" >Sign in</button>
            </div>
        </form>
    </div>
</div>

<?php
$mysqli->close();
include_once "../template/footer.php"; ?>