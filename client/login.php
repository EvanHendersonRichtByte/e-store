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

<section class="client--login">
    <?php include_once "../components/client_auth_navbar.php" ?>

    <div class="container">
        <h1>Welcome Back!</h1>
        <div>
            <h5>Dont' Have Account?</h5>
            <a href="<?php echo $address ?>/client/register.php">Sign Up</a>
        </div>
        <form action="<?php echo $address ?>/auth/" method="post">
            <div class="form-group">
                <input type="text" name="username" id="username" placeholder="Username" required>
                <i class="ri-file-user-fill"></i>
            </div>
            <div class="form-group">
                <input type="password" name="password" id="password" placeholder="Password" required>
                <i class="ri-lock-password-fill"></i>
            </div>
            <div>
                <button class="btn btn-secondary bordered" name="client__login" value="submit" type="submit">Sign In</button>
                <button type="button" id="togglePopup" class="forgot-password">Forgot Password</button>
            </div>
        </form>
    </div>
    <div class="overlay"></div>
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
    </div>
    <script>
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
    </script>
</section>

<?php include_once "../template/footer.php";  ?>