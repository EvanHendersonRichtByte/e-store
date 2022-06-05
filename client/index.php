<?php include_once "../template/header.php"  ?>

<?php include "../components/client_dashboard_navbar.php" ?>
<section class="client--dashboard">
    <?php

    include_once "../config/connect.php";

    include_once "../auth/index.php";

    pageAuth($address);

    $query = "SELECT * FROM barang";
    $data = $mysqli->query($query);
    if ($data) {
        $data->fetch_assoc();
        foreach ($data as $key) {
    ?>
            <div class="card">
                <div class="image">
                    <img src=<?php echo $key['image'] ? $key['image'] : "../assets/static_images/dummy.png" ?> alt="dummy">
                </div>
                <div class="details">
                    <a href="<?php echo $address ?>/client/item.php" class="title"><?php echo $key['nama_barang'] ?></a>
                    <p class="description"><?php echo $key['deskripsi'] ?></p>
                    <p class="stock">Stok: <?php echo $key['stok'] ?></p>
                    <p class="price">Rp. <?php echo $key['harga'] ?></p>
                </div>
                <button class="btn-secondary">Add</button>
            </div>
    <?php
        }
    }
    ?>

</section>

<?php include_once "../template/footer.php"  ?>