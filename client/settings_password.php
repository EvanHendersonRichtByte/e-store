<?php include "../template/client_settings_header.php" ?>
<?php include_once "../auth/index.php";
pageAuth($address);
?>
<div class="form">
    <form action="">
        <div class="content" style="margin: 0;">
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password">
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input id="confirmPassword" type="password" name="confirmPassword">
            </div>
            <div class="form-group">
                <button class="btn bordered btn-primary">Update</button>
            </div>
        </div>
    </form>
</div>

<?php include "../template/client_settings_footer.php" ?>