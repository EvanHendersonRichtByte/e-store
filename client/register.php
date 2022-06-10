<?php include_once "../template/header.php";
include_once "../auth/index.php";
// pageAuth($address);
?>

<section class="client-register">
    <div class="row w-100 justify-content-between m-0">
        <div class="col-md-6 d-flex p-0 justify-content-center mt-5 pt-5">
            <form action="" method="post" class="d-block w-50 mt-5">
                <h1>Greetings!</h1>
                <div class="d-flex">
                    <h5>Already Have Account?</h5>
                    <a class="text-success text-decoration-none ms-2" href="<?php echo $address ?>/client/login.php">
                        <h5>Sign In</h5>
                    </a>
                </div>
                <input class="form-control mt-3" type="text" name="email" id="email" placeholder="Email" required>
                <input class="form-control mt-3" type="text" name="username" id="username" placeholder="Username" required>
                <input class="form-control mt-3" type="password" name="password" id="password" placeholder="Password" required>
                <button class="mt-3 btn btn-secondary bordered" name="register" value="register" type="submit">Sign Up</button>
            </form>
        </div>
        <div class="col-md-6 image p-0 d-none d-sm-none d-md-block">
            <img class="img-fluid" src="../assets/static_images/registeruser.jpg" alt="Register">
        </div>
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