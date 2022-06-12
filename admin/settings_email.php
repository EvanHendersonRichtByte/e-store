<?php include_once "../template/header.php" ?>

<div class="admin container-fluid p-3 min-vh-100">
    <div class="row">
        <?php include_once "../components/admin_sidebar.php" ?>
        <div class="col-8 ms-4 mt-2">
            <div class="col-md-8 w-100">
                <h4 class="mb-3">Change Email</h4>
                <hr class="d-sm-block d-md-none">
                <form action="" method="POST">
                    <h6 class="mb-3">Previous Email: <?php echo $_SESSION['logged']['email'] ?></h6>
                    <div class="form-group mb-3">
                        <label class="form-label" for="email">Email</label>
                        <input class="form-control" id="email" type="email" name="email">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="changeEmail">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['changeEmail'])) {
    $email = $_POST['email'];
    $idPetugas = $_SESSION['logged']['id'];
    $query = "UPDATE petugas SET email = '$email' WHERE id_petugas = $idPetugas";
    if ($mysqli->query($query) or die($mysqli->error)) {
        $_SESSION['logged']['email'] = $email;
?>
        <script>
            alert("Email berhasil diubah");
            window.location.assign("<?php echo $address ?>/admin/settings_email.php");
        </script>
<?php }
}
$mysqli->close();
include_once "../template/footer.php"; ?>