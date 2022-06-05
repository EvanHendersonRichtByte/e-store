<?php include "../template/client_settings_header.php" ?>

<div class="form">
    <form action="">
        <div class="header">
            <div class="header__background">&nbsp;</div>
            <div class="header__content">
                <div class="header__image"><img src="../assets/static_images/dummy.png" alt="duymmy"></div>
                <div class="header__title">
                    <h3>Profile</h3>
                    <p>Update your photo and personal details</p>
                </div>
                <button class="btn bordered btn-primary" type="submit">Save</button>
            </div>
        </div>
        <div class="content">
            <div class="form-group">
                <label for="username">Username</label>
                <input id="username" type="text" name="username">
            </div>
            <div class="form-group">
                <label for="image">Your Photo</label>
                <div>
                    <label for="image"><img src="../assets/static_images/dummy.png" alt="dummy"></label>
                    <input id="image" type="file" name="image" value=" " title=" ">
                    <button class="btn bordered btn-primary ">Update</button>
                </div>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input id="alamat" type="text" name="alamat">
            </div>
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input id="tanggal_lahir" type="text" name="tanggal_lahir">
            </div>
        </div>
    </form>
</div>
<?php include "../template/client_settings_footer.php" ?>