<?php include "../template/client_settings_header.php"; ?>
<div class="col-md-8">
    <hr class="d-sm-block d-md-none">
    <form action="" method="POST">
        <div class="content" style="margin: 0;">
            <div class="form-group mb-3">
                <label class="form-label" for="password">Password</label>
                <input class="form-control" id="password" type="password" name="password">
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="confirmPassword">Confirm Password</label>
                <input class="form-control" id="confirmPassword" type="password" name="confirmPassword">
            </div>
            <div class="form-group mb-3">
                <button type="submit" name="changePassword" class="btn bordered btn-primary">Update</button>
            </div>
        </div>
    </form>
</div>

<?php
if (isset($_POST['changePassword'])) {
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $idCustomer = $_SESSION['logged']['id'];
    if ($password === $confirmPassword) {
        $password = md5($password);
        $query = "UPDATE customer SET password = '$password' WHERE id_customer = $idCustomer";
        if ($mysqli->query($query)) {
            $_SESSION['logged']['password'] = $password; ?>
            <script>
                alert("Password berhasil diubah");
            </script>
        <?php }
    } else { ?>
        <script>
            alert("Pastikan data yang telah dimasukkan benar");
        </script>
<?php }
}


include "../template/client_settings_footer.php"; ?>