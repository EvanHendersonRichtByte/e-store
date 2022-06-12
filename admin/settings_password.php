<?php include_once "../template/header.php" ?>

<div class="admin container-fluid p-3 min-vh-100">
    <div class="row">
        <?php include_once "../components/admin_sidebar.php" ?>
        <div class="col-8 ms-4 mt-2">
            <div class="col-md-8 w-100">
                <h4 class="mb-3">Change Password</h4>
                <hr class="d-sm-block d-md-none">
                <form action="" method="POST">
                    <div class="form-group mb-3">
                        <label class="form-label" for="password">Password</label>
                        <input class="form-control" id="password" type="password" name="password">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="confirmPassword">Confirm Password</label>
                        <input class="form-control" id="confirmPassword" type="password" name="confirmPassword">
                    </div>
                    <div class="form-group mb-3">
                        <button class="btn btn-primary" name="changePassword" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_POST['changePassword'])) {
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $idPetugas = $_SESSION['logged']['id'];
    if ($password === $confirmPassword) {
        $password = md5($password);
        $query = "UPDATE Petugas SET password = '$password' WHERE id_petugas = $idPetugas";
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
$mysqli->close();
include_once "../template/footer.php"; ?>