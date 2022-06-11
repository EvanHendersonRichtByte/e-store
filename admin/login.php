<?php include_once "../template/header.php" ?>

<div class="admin-login container-fluid min-vh-100 d-flex align-items-center position-relative">
    <div class="col-md-6 col-sm-12 mx-auto bg-light p-5 rounded">
        <h3>Welcome back</h3>
        <p>Welcome back! Please enter your details.</p>
        <form action="" method="POST">
            <div class="form-group mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" class="form-control">
            </div>
            <div class="form-group mb-3">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" class="form-control">
            </div>
            <div class="form-group mb-3">
                <button type="submit" class="btn btn-dark">Sign in</button>
            </div>
        </form>
    </div>
</div>

<?php include_once "../template/footer.php" ?>