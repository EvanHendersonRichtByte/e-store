<?php include_once "../template/header.php" ?>

<?php include "../components/client_dashboard_navbar.php" ?>

<?php include_once "../config/connect.php" ?>

<section class="client-transaction">
    <div class="container pt-4">
        <h4>List Pesanan</h4>
        <div class="row">
            <div class="container">
                <table class="rounded-top-corner table table-responsive mt-4">
                    <thead>
                        <tr class="bg-dark text-light">
                            <th scope="col">#</th>
                            <th scope="col">Tgl Pemesanan</th>
                            <th scope="col">Ditangani Oleh</th>
                            <th scope="col">List Barang</th>
                            <th scope="col">Total Harga</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $number = 1;
                        $id_customer = $_SESSION['logged']['id'];
                        $query = "SELECT p.*, pt.username FROM penjualan p JOIN petugas pt ON p.id_petugas = pt.id_petugas WHERE id_customer = $id_customer AND p.id_petugas IS NOT NULL";
                        $penjualan = $mysqli->query($query) or die($mysqli->error);
                        foreach ($penjualan as $key) {
                        ?>
                            <tr>
                                <th scope="row" class="col"><?php echo $number ?></th>
                                <td class="col"><?php echo $key['tanggal'] ?></td>
                                <td class="col text-capitalize"><?php echo $key['username'] ?></td>
                                <td class="col-5">
                                    <?php
                                    $query = "SELECT * FROM barang b JOIN detail_penjualan dp ON b.id_barang = dp.id_barang WHERE dp.id_penjualan = " . $key['id_penjualan'];
                                    $list_barang = $mysqli->query($query);

                                    if ($list_barang) {
                                        foreach ($list_barang as $data) {
                                    ?>
                                            <div class="row mb-2 d-flex w-100">
                                                <img class="w-25" src="<?php echo $address ?>/components/view_image.php?id_barang=<?php echo $data['id_barang'] ?>">
                                                <div class="col-md-8 d-flex flex-column ms-3">
                                                    <h5><?php echo $data['nama_barang'] ?> <span>x<?php echo $data['jumlah'] ?></span></h5>
                                                    <div class="d-flex">
                                                        <p>Subtotal: <?php echo $data['harga'] ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </td>
                                <td class="col">
                                    <h5>Rp.<?php echo $key['total'] ?></h5>
                                </td>
                                <td class="col">
                                    <?php
                                    echo $key['status'] === 'Diterima' ?
                                        '<button class="btn rounded-0 btn-success">In Delivery</button>' :
                                        '<button class="btn rounded-0 btn-danger">Ditolak</button>'
                                    ?>
                                </td>
                            </tr>
                        <?php
                        }
                        $number++;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?php include_once "../template/footer.php"  ?>