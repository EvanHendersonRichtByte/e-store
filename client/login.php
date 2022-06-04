<?php include_once "../template/header.php"  ?>

<section class="client--login">
    <?php include_once "../components/client_auth_navbar.php" ?>

    <div class="container">
        <h1>Welcome Back!</h1>
        <div>
            <h5>Dont' Have Account?</h5>
            <a href="<?php echo $address ?>/client/register.php">
                <h5>Sign Up</h5>
            </a>
        </div>
        <form action="<?php echo $address ?>/auth/" method="post">
            <div class="form-group">
                <input type="text" name="username" id="username" placeholder="Username" required>
                <i class="ri-file-user-fill"></i>
            </div>
            <div class="form-group">
                <input type="text" name="password" id="password" placeholder="Password" required>
                <i class="ri-lock-password-fill"></i>
            </div>
            <div>
                <button class="btn btn-secondary bordered" name="client__login" value="submit" type="submit">Sign In</button>
                <a href="http://">Forgot Password</a>
            </div>
        </form>
    </div>
</section>

<?php include_once "../template/footer.php"  ?>