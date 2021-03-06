<?php include_once "../template/header.php"   ?>

<div class="admin container-fluid p-3 min-vh-100">
    <div class="row">
        <?php include_once "../components/admin_sidebar.php" ?>
        <div class="col-8 ms-4 mt-2">
            <h4 class="fw-bold">List Order</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tanggal</th>
                        <th>Customer</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT p.id_penjualan, p.tanggal, c.username, p.total FROM penjualan p JOIN customer c ON p.id_customer = c.id_customer WHERE id_petugas IS NULL AND p.total > 0 ORDER BY tanggal";
                    $penjualan_terbaru = $mysqli->query($query) or die($mysqli->error);
                    foreach ($penjualan_terbaru as $key) {
                    ?>
                        <tr>
                            <td class="col"><?php echo $key['id_penjualan'] ?></td>
                            <td class="col"><?php echo $key['tanggal'] ?></td>
                            <td class="col"><?php echo $key['username'] ?></td>
                            <td class="col-6">
                                <?php
                                $query = "SELECT b.nama_barang, b.harga, dp.jumlah, dp.total FROM detail_penjualan dp JOIN barang b ON dp.id_barang = b.id_barang WHERE dp.id_penjualan =  {$key['id_penjualan']} ";
                                $items = $mysqli->query($query) or die($mysqli->error);
                                if ($items) {
                                    foreach ($items as $item) {
                                ?>
                                        <div class="d-flex">
                                            <div class="d-flex justify-content-between w-100">
                                                <div class="d-flex">
                                                    <h6><?php echo $item['nama_barang'] ?></h6>
                                                    <p class="ms-2">Rp. <?php echo $item['harga'] ?></p>
                                                </div>
                                                <p><span class="text-danger">x<?php echo $item['jumlah'] ?></span> = Rp. <?php echo $item['total'] ?></p>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </td>
                            <td class="col">Rp. <?php echo $key['total'] ?></td>
                            <td class="col">
                                <a href="<?php echo $address ?>/admin/active_order_details.php?id=<?php echo $key['id_penjualan'] ?>" class="btn btn-secondary border-0">
                                    <i class="bi bi-search"></i>
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
$mysqli->close();
include_once "../template/footer.php";  ?>