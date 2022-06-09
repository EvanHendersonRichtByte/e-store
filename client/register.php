<?php include_once "../template/header.php";
include_once "../auth/index.php";
// pageAuth($address);
?>

<section class="client--register">

    <div class="container">

        <form action="" method="post">
            <h1>Greetings!</h1>
            <div>
                <h5>Already Have Account?</h5>
                <a href="<?php echo $address ?>/client/login.php">Sign In</a>
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
                <input type="password" name="password" id="password" placeholder="Password" required>
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