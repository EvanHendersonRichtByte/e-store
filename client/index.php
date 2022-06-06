<?php include_once "../template/header.php"  ?>

<?php include "../components/client_dashboard_navbar.php" ?>
<section class="client--dashboard">
    <?php
    include_once "../config/connect.php";

    include_once "../auth/index.php";

    pageAuth($address);
    // Add Item
    if (isset($_POST['addToCart'])) {
        $id_penjualan = null;
        $id_barang = $_POST['addToCart'];
        $id_customer = $_SESSION['logged']['id'];
        $harga = $_POST['harga'];
        $query = "SELECT id_penjualan FROM penjualan WHERE id_customer = $id_customer AND id_petugas IS NULL LIMIT 1";
        $data = $mysqli->query($query);
        if ($data->num_rows > 0) {
            $id_penjualan = $data->fetch_array()["id_penjualan"];
            $query = "INSERT INTO detail_penjualan SET id_penjualan = $id_penjualan, id_barang = $id_barang, jumlah = 1, total = $harga";
            if ($mysqli->query($query)) {
            } else {
                echo "Failed";
            }
        } else {
            $query = "INSERT INTO penjualan SET id_customer = $id_customer, id_petugas = NULL";
            if ($mysqli->query($query)) {
                $query = "SELECT id_penjualan FROM penjualan WHERE id_customer = $id_customer AND id_petugas IS NULL LIMIT 1";
                $id_penjualan = $mysqli->query($query)->fetch_array()["id_penjualan"];
                $query = "INSERT INTO detail_penjualan SET id_penjualan = $id_penjualan, id_barang = $id_barang, jumlah = 1, total = $harga";
                if ($mysqli->query($query)) {
                } else {
                    echo "Failed";
                }
            } else {
                echo "Failed";
            }
        }
    }

    // Load Page
    $query = "SELECT * FROM barang";
    $data = $mysqli->query($query);
    if ($data->num_rows > 0) {
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
                <form action="" method="POST">
                    <input type="hidden" name="harga" value="<?php echo $key['harga'] ?>">
                    <button class="btn-secondary" name="addToCart" value="<?php echo $key['id_barang'] ?>" type="submit">Add</button>
                </form>

            </div>
    <?php
        }
    }
    ?>
</section>

<?php include_once "../template/footer.php"  ?>