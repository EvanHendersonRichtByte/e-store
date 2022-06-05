<?php include_once "../template/header.php";
include_once "../auth/index.php";
pageAuth($address);
?>

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
                    <button>X</button>
                </div>
        <?php
            }
        }
        ?>
        <hr>
        <?php
        $query = "SELECT SUM(total) AS total FROM penjualan p JOIN detail_penjualan dp ON p.id_penjualan = dp.id_penjualan WHERE id_customer = $id_customer";
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