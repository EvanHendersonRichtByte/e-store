<?php include_once "../template/header.php" ?>

<?php include "../components/client_dashboard_navbar.php" ?>

<section class="client--cart">
    <form action="" method="post">
        <div class="form-group">
            <label for="username">Atas Nama:</label>
            <input type="text" name="username" id="username" value="<?php echo $_SESSION['logged']['username'] ?>">
        </div>
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <input type="text" name="alamat" id="alamat" value="<?php echo $_SESSION['logged']['alamat'] ?>">
        </div>
        <label for="">Sistem Pembayaran:</label>
    </form>
    <div class="items">
        <?php
        include_once "../config/connect.php";
        $id_customer = $_SESSION['logged']['id'];
        $query = "UPDATE detail_penjualan INNER JOIN barang ON detail_penjualan.id_barang = barang.id_barang SET detail_penjualan.total = detail_penjualan.jumlah * barang.harga";
        $mysqli->query($query);
        $query = "SELECT * FROM penjualan p JOIN detail_penjualan dp ON p.id_penjualan = dp.id_penjualan JOIN barang b ON b.id_barang = dp.id_barang WHERE id_customer = $id_customer";
        $data = $mysqli->query($query);
        $image = null;
        if ($data->num_rows > 0) {
            $data->fetch_assoc();
            foreach ($data as $key) {
        ?>
                <div class="item">
                    <div class="image"><img src="<?php $key['image'] ? print $key['image'] : print '../assets/static_images/dummy.png' ?>" alt="dummy"></div>
                    <h3><?php echo $key['nama_barang'] ?></h3>
                    <h3>x<?php echo $key['jumlah'] ?></h3>
                    <h3><?php echo $key['total'] ?></h3>
                    <a href="<?php echo $address ?>/client/cart.php?deleteItem=<?php echo $key['id_detail_penjualan'] ?>"><i class="ri-delete-bin-line"></i></a>
                </div>
        <?php
            }
        }
        ?>
        <hr>
        <?php
        if (isset($_GET['deleteItem'])) {
            $itemId = $_GET['deleteItem'];
            $query = "DELETE FROM detail_penjualan WHERE id_detail_penjualan = $itemId";
            $mysqli->query($query);
            header("location: " . $address . "/client/cart.php");
        }

        $query = "SELECT SUM(dp.total) AS total FROM penjualan p JOIN detail_penjualan dp ON p.id_penjualan = dp.id_penjualan WHERE id_customer = $id_customer";
        $data = $mysqli->query($query);
        if ($data->num_rows > 0) {
            $total = $data->fetch_assoc()['total'];
            echo "<h1>Total: Rp. " . $total . " </h1>";
            echo "<input type='hidden' name='total' value='$total'>";
        }
        ?>

        <button class="btn btn-secondary" type="submit" name="placeOrder">Place Order</button>
    </div>
</section>

<?php include_once "../template/footer.php"  ?>