<?php include_once "../template/header.php" ?>

<?php include "../components/client_dashboard_navbar.php" ?>

<section class="client-cart">
    <div class="container pt-5">
        <div class="row justify-content-between">
            <form class="col-md-4" action="" method="post">
                <div class="form-group mb-3">
                    <label class="form-label" for="username">Atas Nama:</label>
                    <input class="form-control" type="text" name="username" id="username" value="<?php echo $_SESSION['logged']['username'] ?>">
                </div>
                <div class="form-group mb-3">
                    <label class="form-label" for="alamat">Alamat:</label>
                    <input class="form-control" type="text" name="alamat" id="alamat" value="<?php echo $_SESSION['logged']['alamat'] ?>">
                </div>
                <label for="">Sistem Pembayaran:</label>
            </form>
            <div class="col-md-6 items">
                <?php
                include_once "../config/connect.php";
                $id_customer = $_SESSION['logged']['id'];
                $query = "UPDATE detail_penjualan INNER JOIN barang ON detail_penjualan.id_barang = barang.id_barang SET detail_penjualan.total = detail_penjualan.jumlah * barang.harga";
                $mysqli->query($query);
                $query = "SELECT * FROM penjualan p JOIN detail_penjualan dp ON p.id_penjualan = dp.id_penjualan JOIN barang b ON b.id_barang = dp.id_barang WHERE id_customer = $id_customer";
                $data = $mysqli->query($query);
                $image = null;
                $total = 0;
                if ($data->num_rows > 0) {
                    $data->fetch_assoc();
                    foreach ($data as $key) {
                        $total += $key['total'];
                ?>
                        <div class="item d-flex">
                            <div class="row w-100">
                                <div class="col-md-6 image"><img class="w-25 h-100" src="<?php echo $address ?>/components/view_image.php?id_barang=<?php echo $key['id_barang'] ?>" alt="image"></div>
                                <div class="col-md-6 d-flex justify-content-around align-items-center">
                                    <h6 class="m-0"><?php echo $key['nama_barang'] ?></h6>
                                    <h6 class="m-0">x<?php echo $key['jumlah'] ?></h6>
                                    <h6 class="m-0">Rp.<?php echo $key['total'] ?></h6>
                                </div>
                            </div>
                            <a class="d-flex align-items-center" href="<?php echo $address ?>/client/cart.php?deleteItem=<?php echo $key['id_detail_penjualan'] ?>"><i class="bi bi-trash text-danger"></i></a>
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
                    echo "<h5>Total: Rp. " . $total . " </h5>";
                    echo "<input type='hidden' name='total' value='$total'>";
                }
                ?>
                <form action="" method="post">
                    <input type="hidden" name="total" value="<?php echo $total ?>">
                    <button class="btn btn-secondary" type="submit" name="placeOrder" value="<?php echo $key['id_penjualan'] ?>">Place Order</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
if (isset($_POST['placeOrder'])) {
    $id_penjualan = $_POST["placeOrder"];
    $total = $_POST["total"];
    $query = "UPDATE penjualan SET total = $total WHERE id_penjualan = $id_penjualan";
    $mysqli->query($query) or die($mysqli->error);
    $query = "DELETE FROM detail_penjualan WHERE id_penjualan = $id_penjualan";
    $mysqli->query($query) or die($mysqli->error);
?>
    <script>
        window.location.assign("<?php echo $address . '/client' ?>")
    </script>
<?php
}
?>

<?php include_once "../template/footer.php"  ?>