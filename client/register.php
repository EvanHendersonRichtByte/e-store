<?php include_once "../template/header.php" ?>

<section class="client--register">

    <div class="container">

        <form action="../auth">
            <h1>Greetings!</h1>
            <div>
                <h5>Already Have Account?</h5>
                <a href="http://">
                    <h5>Sign In</h5>
                </a>
            </div>
            <div class="form-group">
                <input type="text" name="email" id="email" placeholder="Email">
                <i class="ri-mail-fill"></i>
            </div>
            <div class="form-group">
                <input type="text" name="username" id="username" placeholder="Username">
                <i class="ri-file-user-fill"></i>
            </div>
            <div class="form-group">
                <input type="text" name="password" id="password" placeholder="Password">
                <i class="ri-lock-password-fill"></i>
            </div>
            <div>
                <button class="btn btn-secondary bordered" type="submit">Sign Up</button>
            </div>
        </form>
    </div>
    <div class="image">
        <img src="../assets/static_images/registeruser.jpg" alt="Register">
    </div>
</section>

<?php include_once "../template/footer.php" ?>