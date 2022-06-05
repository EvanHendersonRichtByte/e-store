<?php include "../template/client_settings_header.php" ?>
<?php include_once "../auth/index.php";
pageAuth($address);
?>

<div class="form">
    <form action="">
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
                <button class="btn bordered btn-primary">Update</button>
            </div>
        </div>
    </form>
</div>

<?php include "../template/client_settings_footer.php" ?>