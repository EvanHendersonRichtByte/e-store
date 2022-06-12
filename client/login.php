<?php include_once "../template/header.php";

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
    if ($msg === '404user') {
?>
        <script>
            alert("Customer tidak ditemukan")
        </script>
        <?php
    }
} else if (isset($_POST['changePassword'])) {
    $username = $_POST['setUsername'];
    $email = $_POST['setEmail'];
    $password = $_POST['setPassword'];
    $confirmPassword = $_POST['setConfirmPassword'];
    if ($password === $confirmPassword) {
        $query = "SELECT id_customer FROM customer WHERE username = '$username' AND email = '$email'";
        $data = $mysqli->query($query);
        if ($data->num_rows > 0) {
            $data = $data->fetch_assoc();
            $id_customer = $data['id_customer'];
            $password = md5($password);
            $query = "UPDATE customer SET password = '$password' WHERE id_customer = '$id_customer'";
            $mysqli->query($query); ?>
            <script>
                alert("Password telah diubah")
            </script>
        <?php } else { ?>
            <script>
                alert("Data tidak ditemukan")
            </script>
        <?php }
    } else {
        ?>
        <script>
            alert("Pastikan data yang telah dimasukkan benar")
        </script>
<?php
    }
}
?>
<section class="client-login min-vh-100">
    <?php include_once "../components/client_auth_navbar.php" ?>

    <div class="container">
        <div class="col-md-3 mt-5">
            <h1>Welcome Back!</h1>
            <div class="d-flex align-items-center">
                <h5 class="fw-light">Dont' Have Account?</h5>
                <a class="ms-2 link-success text-decoration-none" href="<?php echo $address ?>/client/register.php">
                    <h5 class="fw-light">Sign Up</h5>
                </a>
            </div>
            <form action="<?php echo $address ?>/auth/" method="post">
                <input class="form-control mt-3 bg-transparent placeholder-light text-light" type="text" name="username" id="username" placeholder="Username" required>
                <input class="form-control mt-3 bg-transparent placeholder-light text-light" type="password" name="password" id="password" placeholder="Password" required>
                <div class="d-flex mt-3">
                    <button class="btn btn-success" name="client-login" value="submit" type="submit">Sign In</button>
                    <button type="button" class="ms-auto btn btn-transparent text-light" data-bs-toggle="modal" data-bs-target="#forgotPassword">
                        Forgot Password
                    </button>
                </div>
            </form>
            <div class="modal fade" id="forgotPassword" tabindex="-1" aria-hidden="true">
                <form action="" method="POST">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-dark">Forgot Password</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input class="form-control bg-transparent text-light" type="text" name="changeUsername" id="username" placeholder="Username" required>
                                <input class="form-control mt-3 bg-transparent text-light" type="email" name="changeEmail" id="email" placeholder="Email" required>
                                <input class="form-control mt-3 bg-transparent text-light" type="password" name="changePassword" id="password" placeholder="Password" required>
                                <input class="form-control mt-3 bg-transparent text-light" type="password" name="changeConfirmPassword" id="password" placeholder="Confirm Password" required>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary" name="changePassword">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- <div class="overlay"></div>
    <div class="popup">
        <button class="popup-close"><i class="ri-close-line"></i></button>
        <h1>Forgot Password?</h1>
        <form action="" method="post">
            <div class="form-group">
                <input type="text" name="setUsername" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="email" name="setEmail" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" name="setPassword" placeholder="Password" required>
            </div>
            <div class="form-group">
                <input type="password" name="setConfirmPassword" placeholder="Confirm Password" required>
            </div>
            <div>
                <button type="submit" class="btn btn-primary bordered" name="changePassword">Submit</button>
            </div>
        </form>
    </div> -->

    <!-- <script>
        const togglePopup = (popupStatus) => {
            if (popupStatus) {
                document.querySelector('.client--login .overlay').style.display = 'block';
                document.querySelector('.client--login .popup').style.display = 'flex';
            } else {
                document.querySelector('.client--login .overlay').style.display = 'none';
                document.querySelector('.client--login .popup').style.display = 'none';
            }
        }
        document.querySelector('#togglePopup').addEventListener('click', () => togglePopup(true))
        document.querySelector('.overlay').addEventListener('click', () => togglePopup(false))
        document.querySelector('.client--login .popup .popup-close').addEventListener('click', () => togglePopup(false))
        document.addEventListener('keydown', e => e.key === "Escape" && togglePopup(false))
    </script> -->
</section>

<?php include_once "../template/footer.php";  ?>