<?php include_once "../template/header.php"  ?>

<section class="client--login">
    <?php include_once "../components/user_auth_navbar.php" ?>

    <div class="container">
        <h1>Welcome Back!</h1>
        <div>
            <h5>Dont' Have Account?</h5>
            <a href="http://">
                <h5>Sign Up</h5>
            </a>
        </div>
        <form action="../auth">
            <div class="form-group">
                <input type="text" name="username" id="username" placeholder="Username">
                <i class="ri-file-user-fill"></i>
            </div>
            <div class="form-group">
                <input type="text" name="password" id="password" placeholder="Password">
                <i class="ri-lock-password-fill"></i>
            </div>
            <div>
                <button class="btn btn-secondary bordered" type="submit">Sign In</button>
                <a href="http://">Forgot Password</a>
            </div>
        </form>
    </div>
</section>

<?php include_once "../template/footer.php"  ?>