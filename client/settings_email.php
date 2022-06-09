<?php include "../template/client_settings_header.php" ?>

<div class="form">
    <form action="" method="POST">
        <div class="content" style="margin: 0;">
            <div class="form-group">
                <label>Previous Email</label>
                <h3><?php echo $_SESSION['logged']['email'] ?></h3>
            </div>
            <div class="form-group">
                <label for="email">New Email</label>
                <input id="email" type="email" name="email">
            </div>
            <div class="form-group">
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
        </script>
<?php }
}

include "../template/client_settings_footer.php"; ?>