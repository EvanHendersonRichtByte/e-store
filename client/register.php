<?php include_once "../template/header.php" ?>

<section class="client--register">

    <div class="container">

        <form action="" method="post">
            <h1>Greetings!</h1>
            <div>
                <h5>Already Have Account?</h5>
                <a href="http://localhost/the-Estore/client/login.php">
                    <h5>Sign In</h5>
                </a>
            </div>
            <div class="form-group">
                <input type="text" name="email" id="email" placeholder="Email" required>
                <i class="ri-mail-fill"></i>
            </div>
            <div class="form-group">
                <input type="text" name="username" id="username" placeholder="Username" required>
                <i class="ri-file-user-fill"></i>
            </div>
            <div class="form-group">
                <input type="text" name="password" id="password" placeholder="Password" required>
                <i class="ri-lock-password-fill"></i>
            </div>
            <div>
                <button class="btn btn-secondary bordered" name="register" value="register" type="submit">Sign Up</button>
            </div>
        </form>
    </div>
    <div class="image">
        <img src="../assets/static_images/registeruser.jpg" alt="Register">
    </div>
</section>

<?php
if (isset($_POST['register'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $query = "INSERT INTO customer SET email = '$email', username = '$username', password = '$password'";
    echo $query;
    if ($mysqli->query($query)) {
        header("location: " . $address . "/client/login.php");
    } else { ?>
        <script>
            alert("Gagal registrasi");
        </script>
<?php
    }
}

?>

<?php include_once "../template/footer.php" ?>