<?php include_once "../template/header.php" ?>

<?php
if (isset($_GET['id'])) {
    $id_penjualan = $_GET['id'];
    $query = "SELECT p.id_customer, c.username, c.alamat FROM penjualan p JOIN customer c ON p.id_customer = c.id_customer WHERE p.id_penjualan = $id_penjualan";
    $userData = $mysqli->query($query)->fetch_assoc();
    $query = "SELECT dp.id_detail_penjualan, b.id_barang, b.nama_barang namaBarang, b.harga hargaBarang, b.stok stokBarang, dp.jumlah, dp.total subtotal, p.total, p.status, p.tanggal FROM detail_penjualan dp JOIN penjualan p ON dp.id_penjualan = p.id_penjualan JOIN barang b ON dp.id_barang = b.id_barang WHERE dp.id_penjualan = $id_penjualan";
    $orderData = $mysqli->query($query);
} else {
?>
    <script>
        window.location.assign("<?php echo $address ?>/admin/active_order.php")
    </script>
<?php
}
?>

<div class="admin container-fluid p-3 min-vh-100">
    <div class="row">
        <?php include_once "../components/admin_sidebar.php" ?>
        <div class="col-8 ms-4 mt-2">
            <h4 class="fw-bold text-capitalize mb-3">Order From <?php echo $userData['username'] ?></h4>
            <div class="row">
                <div class="col-3">
                    <h5>Customer</h5>
                    <img class="w-100 mt-3" src="<?php echo $address ?>/components/view_image.php?id_customer=<?php echo $userData['id_customer'] ?>" alt="gambar">
                    <div class="d-flex mt-3 flex-column justify-content-center align-items-start">
                        <h6>Name: <?php echo $userData['username'] ?></h6>
                        <h6>Alamat: <?php echo $userData['alamat'] ?></h6>
                        <div class="mt-2 d-flex">
                            <form action="" method="post">
                                <button type="submit" class="btn btn-danger" name="deny">Deny</button>
                            </form>
                            <form action="" method="post" class="ms-2">
                                <button type="submit" class="btn btn-success" name="accept">Accept</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <h5 class="text-center">Order</h5>
                    <?php
                    foreach ($orderData as $key) {
                    ?>
                        <div class="d-flex w-100 px-4 pt-3 shadow rounded">
                            <div class="d-flex flex-column col">
                                <h6>Gudang</h6>
                                <p>Nama Barang: <?php echo $key['namaBarang'] ?></p>
                                <p>Harga Barang: <?php echo $key['hargaBarang'] ?></p>
                                <p>Stok Tersedia: <?php echo $key['stokBarang'] ?></p>
                            </div>
                            <div class="d-flex flex-column col">
                                <h6>Permintaan</h6>
                                <p>Jumlah: <?php echo $key['jumlah'] ?></p>
                                <p>Subtotal: <?php echo $key['subtotal'] ?></p>
                            </div>
                            <div class="d-flex flex-column col">
                                <h6>Detail Transaksi</h6>
                                <p>Total: <?php echo $key['total'] ?></p>
                                <p>Status: <?php echo $key['status'] ?></p>
                                <p>Tanggal: <?php echo $key['tanggal'] ?></p>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$id_petugas = $_SESSION['logged']['id'];

if (isset($_POST['deny'])) {
    $query = "UPDATE penjualan SET id_petugas =  $id_petugas, status = 'Ditolak' WHERE id_penjualan = $id_penjualan ";
    $mysqli->query($query) or die($mysqli->error);
?>
    <script>
        window.location.assign("<?php echo $address ?>/admin/active_order.php")
    </script>
<?php
} else if (isset($_POST['accept'])) {
    $query = "UPDATE penjualan SET id_petugas =  $id_petugas, status = 'Diterima' WHERE id_penjualan = $id_penjualan ";
    $mysqli->query($query) or die($mysqli->error);
    foreach ($orderData as $key) {
        $id = $key['id_barang'];
        $jumlah = $key['jumlah'];
        $query = "UPDATE barang SET stok = stok - $jumlah WHERE id_barang = $id";
        $mysqli->query($query) or die($mysqli->error);
    }
?>
    <script>
        window.location.assign("<?php echo $address ?>/admin/active_order.php")
    </script>
<?php
}

$mysqli->close();
include_once "../template/footer.php";  ?>