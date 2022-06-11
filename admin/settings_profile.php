<?php include_once "../template/header.php" ?>

<div class="admin container-fluid p-3 min-vh-100">
    <div class="row">
        <?php include_once "../components/admin_sidebar.php" ?>
        <div class="col-8 ms-4 mt-2">
            <div class="col-md-8 w-100">
                <hr class="d-sm-block d-md-none">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="header position-relative">
                        <div class="header__background">&nbsp;</div>
                        <div class="header__content d-flex justify-content-between align-items-end w-100">
                            <div class="header__image"><img src="../components/view_image.php?id_customer=<?php echo $idCustomer ?>" alt="image"></div>
                            <div class="header__title">
                                <h4>Profile</h4>
                                <p class="mb-0">Update your photo and personal details</p>
                            </div>
                            <button class="btn bordered btn-primary" type="submit" name="changeData">Save</button>
                        </div>
                    </div>
                    <div class="content">
                        <div class="form-group mt-3">
                            <label class="form-label" for="username">Username</label>
                            <input class="form-control" id="username" type="text" name="username" value="<?php echo $_SESSION['logged']['username'] ?>">
                        </div>
                        <div class="form-group mt-3 d-flex justify-content-between align-items-center">
                            <label for="image">Your Photo</label>
                            <label class="form-label" for="image"><img src="<?php echo $address ?>/components/view_image.php?id_customer=<?php echo $idCustomer ?>" alt="image"></label>
                            <div class="d-flex">
                                <input class="form-control rounded-0" id="image" type="file" name="image" title=" ">
                                <button type="submit" name="changeImage" class="btn bordered btn-primary rounded-0">Update</button>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label class="form-label" for="alamat">Alamat</label>
                            <input class="form-control" id="alamat" type="text" name="alamat" value="<?php echo $_SESSION['logged']['alamat'] ?>">
                        </div>
                        <div class="form-group mt-3">
                            <label class="form-label" for="tanggal_lahir">Tanggal Lahir</label>
                            <input class="form-control" id="tanggal_lahir" type="date" name="tanggal_lahir" value="<?php echo $_SESSION['logged']['tgl_lahir'] ?>">
                        </div>
                    </div>
                </form>
            </div>
            <?php
            if (isset($_POST['changeImage'])) {
                $imgData = addslashes(file_get_contents($_FILES['image']['tmp_name']));
                $imgType = getimageSize($_FILES['image']['tmp_name']);
                $query = "UPDATE customer SET imageType = '{$imgType['mime']}', imageData = '$imgData' WHERE id_customer = $idCustomer";
                if ($mysqli->query($query)) {
                    $_SESSION['logged']['image'] = $imgData; ?>
                    <script>
                        alert("Foto profil telah diubah");
                        window.location.assign('<?php echo $address ?>/client/settings_profile.php');
                    </script>
                <?php
                }
            } else if (isset($_POST['changeData'])) {
                $username = $_POST['username'];
                $alamat = $_POST['alamat'];
                $tanggal_lahir = $_POST['tanggal_lahir'];
                $query = "UPDATE customer SET username = '$username', alamat = '$alamat', tgl_lahir = '$tanggal_lahir'";
                if ($mysqli->query($query)) {
                    $_SESSION['logged']['username'] = $username;
                    $_SESSION['logged']['alamat'] = $alamat;
                    $_SESSION['logged']['tgl_lahir'] = $tanggal_lahir;
                ?>
                    <script>
                        alert("Data diri telah diubah");
                    </script>
            <?php
                    header("location: " . $address . '/client/settings_profile.php');
                }
            } ?>
        </div>
    </div>
</div>

<?php include_once "../template/footer.php"  ?>