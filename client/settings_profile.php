<?php include "../template/client_settings_header.php" ?>

<div class="client-settings--profile col-md-8">
    <hr class="d-sm-block d-md-none">
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="header position-relative">
            <div class="header__background">&nbsp;</div>
            <div class="header__content d-flex justify-content-around align-items-end w-100">
                <div class="header__image"><img src="<?php echo $_SESSION['logged']['image'] ? $address . '/assets/images/' . $_SESSION['logged']['image'] : '../assets/static_images/dummy.png' ?>" alt="image"></div>
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
                <label class="form-label" for="image"><img src="<?php echo $_SESSION['logged']['image'] ? $address . '/assets/images/' . $_SESSION['logged']['image'] : '../assets/static_images/dummy.png' ?>" alt="image"></label>
                <div class="d-flex">
                    <input class="form-control rounded-0" id="image" type="file" name="image" value="<?php echo $_SESSION['logged']['image'] ?>" title=" ">
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
    $idCustomer = $_SESSION['logged']['id'];
    // var_dump($_FILES['image']);
    // $dest = $address . '/assets/images/' . 'customer' . $_SESSION['logged']['id'];
    $dest = '../assets/images/';
    $filename = 'customer' . $_SESSION['logged']['id'] . substr($_FILES['image']['name'], -4);
    $file = $_FILES['image']['tmp_name'];
    move_uploaded_file($file, $dest . $filename);
    $query = "UPDATE customer SET image = '$filename' WHERE id_customer = $idCustomer";
    if ($mysqli->query($query)) {
        $_SESSION['logged']['image'] = $filename; ?>
        <script>
            alert("Foto profil telah diubah");
        </script>
    <?php
        header("location: " . $address . '/client/settings_profile.php');
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
}

include "../template/client_settings_footer.php"; ?>