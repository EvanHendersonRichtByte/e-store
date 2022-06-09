<?php include "../template/client_settings_header.php" ?>

<div class="form">
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="header">
            <div class="header__background">&nbsp;</div>
            <div class="header__content">
                <div class="header__image"><img src="<?php echo $_SESSION['logged']['image'] ? $address . '/assets/images/' . $_SESSION['logged']['image'] : '../assets/static_images/dummy.png' ?>" alt="image"></div>
                <div class="header__title">
                    <h3>Profile</h3>
                    <p>Update your photo and personal details</p>
                </div>
                <button class="btn bordered btn-primary" type="submit" name="changeData">Save</button>
            </div>
        </div>
        <div class="content">
            <div class="form-group">
                <label for="username">Username</label>
                <input id="username" type="text" name="username" value="<?php echo $_SESSION['logged']['username'] ?>">
            </div>
            <div class="form-group">
                <label for="image">Your Photo</label>
                <div>
                    <label for="image"><img src="<?php echo $_SESSION['logged']['image'] ? $address . '/assets/images/' . $_SESSION['logged']['image'] : '../assets/static_images/dummy.png' ?>" alt="image"></label>
                    <input id="image" type="file" name="image" value="<?php echo $_SESSION['logged']['image'] ?>" title=" ">
                    <button type="submit" name="changeImage" class="btn bordered btn-primary ">Update</button>
                </div>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input id="alamat" type="text" name="alamat" value="<?php echo $_SESSION['logged']['alamat'] ?>">
            </div>
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir</label>
                <input id="tanggal_lahir" type="date" name="tanggal_lahir" value="<?php echo $_SESSION['logged']['tgl_lahir'] ?>">
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