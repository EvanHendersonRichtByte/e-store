<?php include "../template/client_settings_header.php" ?>

<div class="col-md-8">
    <hr class="d-sm-block d-md-none">
    <form action="" method="POST">
        <div class="content" style="margin: 0;">
            <div class="form-group mb-3">
                <label class="form-label">Previous Email</label>
                <h5><?php echo $_SESSION['logged']['email'] ?></h5>
            </div>
            <div class="form-group mb-3">
                <label class="form-label" for="email">New Email</label>
                <input class="form-control" id="email" type="email" name="email">
            </div>
            <div class="form-group mb-3">
                <button type="submit" name="changeEmail" class="btn bordered btn-primary">Update</button>
            </div>
        </div>
    </form>
</div>

<?php
if (isset($_POST['changeEmail'])) {
    $email = $_POST['email'];
    $idCustomer = $_SESSION['logged']['id'];
    $query = "UPDATE customer SET email = '$email' WHERE id_customer = $idCustomer";
    if ($mysqli->query($query)) {
        $_SESSION['logged']['email'] = $email;
?>
        <script>
            alert("Email berhasil diubah");
            window.location.assign("<?php echo $address ?>/client/settings_email.php");
        </script>
<?php }
}

include "../template/client_settings_footer.php"; ?>