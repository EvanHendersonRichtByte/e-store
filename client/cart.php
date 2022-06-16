<?php include_once "../template/header.php" ?>

<?php include "../components/client_dashboard_navbar.php" ?>

<section class="client-cart">
    <div class="container pt-5">
        <form class="d-flex" action="" method="post">
            <div class="d-flex justify-content-between w-100">
                <div class="col-md-4 d-flex flex-column" action="" method="post">
                    <div class="form-group mb-3">
                        <label class="form-label" for="username">Atas Nama:</label>
                        <input class="form-control" type="text" name="username" id="username" value="<?php echo $_SESSION['logged']['username'] ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label" for="tujuan">Tujuan:</label>
                        <input class="form-control" type="text" name="tujuan" id="tujuan" value="<?php echo $_SESSION['logged']['alamat'] ?>">
                    </div>
                    <label for="">Sistem Pembayaran:</label>
                    <div class="col">
                        <select id="payment-select" class="form-select" name="metode_pembayaran" id="metode_pembayaran">
                            <option value="COD">COD</option>
                            <option value="E-Pay">E-Pay</option>
                            <option value="QR">QR</option>
                        </select>
                    </div>
                    <div id="payment-form">
                        <div id="payment-form-e-pay" class="col">
                            <hr>
                            <form action="" method="POST">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="kartu_nama">Nama kartu:</label>
                                    <input class="form-control" type="text" id="kartu_nama" name="kartu_nama">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label" for="kartu_no">No kartu:</label>
                                    <input class="form-control" type="text" id="kartu_no" name="kartu_no">
                                </div>
                                <div class="row">
                                    <div class="form-group col-6 mb-3">
                                        <label class="form-label" for="kartu_pin">Pin Kartu:</label>
                                        <input class="form-control" type="password" id="kartu_pin" name="kartu_pin">
                                    </div>
                                    <div class="form-group col-6 mb-3">
                                        <label class="form-label" for="kartu_exp">Masa berlaku:</label>
                                        <input class="form-control" type="date" id="kartu_exp" name="kartu_exp">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="payment-form-qr" class="col mt-4">
                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#payment-form-qr-modal">
                                Lihat Kode QR
                            </button>
                            <div class="modal fade" id="payment-form-qr-modal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Pembayaran via kode QR</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body d-flex justify-content-center">
                                            <img class="img-fluid" src="../assets/static_images/qr.png">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Selesai</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 items">
                    <?php
                    include_once "../config/connect.php";
                    $id_customer = $_SESSION['logged']['id'];
                    $query = "UPDATE detail_penjualan INNER JOIN barang ON detail_penjualan.id_barang = barang.id_barang SET detail_penjualan.total = detail_penjualan.jumlah * barang.harga";
                    $mysqli->query($query);
                    $query = "SELECT * FROM penjualan p JOIN detail_penjualan dp ON p.id_penjualan = dp.id_penjualan JOIN barang b ON b.id_barang = dp.id_barang WHERE id_customer = $id_customer AND p.status = 'Listed'";
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
                    ?>
                        <script>
                            window.location.assign('<?php echo $address ?>/client/cart.php')
                        </script>
                    <?php
                        header("location: " . $address . "/client/cart.php");
                    }

                    $query = "SELECT SUM(dp.total) AS total FROM penjualan p JOIN detail_penjualan dp ON p.id_penjualan = dp.id_penjualan WHERE id_customer = $id_customer AND status = 'Listed'";
                    $data = $mysqli->query($query);
                    if ($data->num_rows > 0) {
                        $total = $data->fetch_assoc()['total'];
                        echo "<h5>Total: Rp. " . $total . " </h5>";
                        echo "<input type='hidden' name='total' value='$total'>";
                    }
                    ?>
                    <input type="hidden" name="total" value="<?php echo $total ?>">
                    <button class="btn btn-secondary" type="submit" name="placeOrder" value="<?php echo $key['id_penjualan'] ?>">Place Order</button>
                </div>
            </div>
        </form>
    </div>
</section>

<?php include_once "../template/footer.php"  ?>

<?php
if (isset($_POST['placeOrder'])) {
?>
    <?php
    $id_penjualan = $_POST["placeOrder"];
    $total = $_POST["total"];
    $metode_pembayaran = $_POST['metode_pembayaran'];
    $tujuan = $_POST['tujuan'];
    $kartu_nama = $_POST['kartu_nama'];
    $kartu_no = $_POST['kartu_no'];
    $kartu_pin = $_POST['kartu_pin'];
    $kartu_exp = $_POST['kartu_exp'];
    ?>
    <script>
        const currentDate = `${new Date().getFullYear()}-${new Date().getMonth()}-${new Date().getDay()}`;
        let cardExp = new Date("<?php echo $kartu_exp ?>");
        cardExp = `${cardExp.getFullYear()}-${cardExp.getMonth()}-${cardExp.getDay()}`
        if (cardExp <= currentDate) {
            alert('Maaf, masa berlaku rekening anda telah habis')
            window.location.assign("<?php echo $address . '/client' ?>")
        }
    </script>
    <?php

    $query = "UPDATE penjualan SET total = $total, status = 'Proses', tanggal = CURRENT_TIMESTAMP, metode_pembayaran = '$metode_pembayaran', tujuan = '$tujuan', kartu_nama = '$kartu_nama', kartu_no = '$kartu_no', kartu_pin = '$kartu_pin', kartu_exp = '$kartu_exp' WHERE id_penjualan = $id_penjualan";
    $mysqli->query($query) or die($mysqli->error);
    // $query = "DELETE FROM detail_penjualan WHERE id_penjualan = $id_penjualan";
    // $mysqli->query($query) or die($mysqli->error);
    ?>
    <script>
        window.location.assign("<?php echo $address . '/client' ?>")
    </script>
<?php
}
?>