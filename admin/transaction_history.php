<?php include_once "../template/header.php" ?>

<div class="admin container-fluid p-3 min-vh-100">
    <div class="row">
        <?php include_once "../components/admin_sidebar.php" ?>
        <div class="col-8 ms-4 mt-2">
            <h4 class="fw-bold">List Transaction</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th><a class="text-decoration-none text-dark" href="<?php echo(isset($_GET['desc']) ? "?sort=id" : (isset($_GET['sort']) && $_GET['sort']=="id" ? "?sort=id&desc=true" : "?sort=id")) ?>">ID<?php echo(isset($_GET['sort']) && $_GET['sort']=="id" ? (isset($_GET['desc']) ? "<i class='bi bi-arrow-down-short'><i>" : "<i class='bi bi-arrow-up-short'><i>") : "") ?></a></th>
                        <th><a class="text-decoration-none text-dark" href="<?php echo(isset($_GET['desc']) ? "?sort=tgl" : (isset($_GET['sort']) && $_GET['sort']=="tgl" ? "?sort=tgl&desc=true" : "?sort=tgl")) ?>">Tanggal<?php echo(isset($_GET['sort']) && $_GET['sort']=="tgl" ? (isset($_GET['desc']) ? "<i class='bi bi-arrow-down-short'><i>" : "<i class='bi bi-arrow-up-short'><i>") : "") ?></a></th>
                        <th><a class="text-decoration-none text-dark" href="<?php echo(isset($_GET['desc']) ? "?sort=cus" : (isset($_GET['sort']) && $_GET['sort']=="cus" ? "?sort=cus&desc=true" : "?sort=cus")) ?>">Customer<?php echo(isset($_GET['sort']) && $_GET['sort']=="cus" ? (isset($_GET['desc']) ? "<i class='bi bi-arrow-down-short'><i>" : "<i class='bi bi-arrow-up-short'><i>") : "") ?></a></th>
                        <th>Items</th>
                        <th><a class="text-decoration-none text-dark" href="<?php echo(isset($_GET['desc']) ? "?sort=total" : (isset($_GET['sort']) && $_GET['sort']=="total" ? "?sort=total&desc=true" : "?sort=total")) ?>">Total<?php echo(isset($_GET['sort']) && $_GET['sort']=="total" ? (isset($_GET['desc']) ? "<i class='bi bi-arrow-down-short'><i>" : "<i class='bi bi-arrow-up-short'><i>") : "") ?></a></th>
                        <th><a class="text-decoration-none text-dark" href="<?php echo(isset($_GET['desc']) ? "?sort=sts" : (isset($_GET['sort']) && $_GET['sort']=="sts" ? "?sort=sts&desc=true" : "?sort=sts")) ?>">Status<?php echo(isset($_GET['sort']) && $_GET['sort']=="sts" ? (isset($_GET['desc']) ? "<i class='bi bi-arrow-down-short'><i>" : "<i class='bi bi-arrow-up-short'><i>") : "") ?></a></th>
                    </tr>
                </thead>
                <tbody>

                    <!-- <tr>
                        <td class="col">1</td>
                        <td class="col">tgl</td>
                        <td class="col">Aria</td>
                        <td class="col-6">
                            <div class="d-flex">
                                <div class="d-flex flex-column">
                                    <h6>Title <span class="text-danger">x2</span></h6>
                                    <p>Rp. 50.000</p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="d-flex flex-column">
                                    <h6>Title <span class="text-danger">x2</span></h6>
                                    <p>Rp. 50.000</p>
                                </div>
                            </div>
                        </td>
                        <td class="col">Rp.200.000</td>
                        <td class="col">
                            <button class="btn btn-success border-0 disabled">
                                <i class="bi bi-truck"></i> In Delivery
                            </button>
                        </td>
                    </tr> -->

                    <?php
                    $sort = "p.tanggal DESC";
                    if(isset($_GET['sort'])){
                        switch ($_GET['sort']) {
                            case 'id':
                                $sort = "p.id_penjualan" . (isset($_GET['desc']) ? " DESC" : "");
                                break;
                            case 'tgl':
                                $sort = "p.tanggal" . (isset($_GET['desc']) ? " DESC" : "");
                                break;
                            case 'cus':
                                $sort = "c.username" . (isset($_GET['desc']) ? " DESC" : "");
                                break;
                            case 'total':
                                $sort = "p.total" . (isset($_GET['desc']) ? " DESC" : "");
                                break;
                            case 'sts':
                                $sort = "p.status" . (isset($_GET['desc']) ? " DESC" : "");
                                break;
                            
                            default:
                                break;
                        }
                    } 
                    $query = "SELECT p.id_penjualan, p.tanggal, c.username, p.total, p.status FROM penjualan p JOIN customer c ON p.id_customer = c.id_customer WHERE id_petugas IS NOT NULL AND p.total > 0 ORDER BY $sort";
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
                                <?php
                                echo $key['status'] === 'Diterima' ?
                                    '<button class="btn rounded-0 btn-success">Diterima</button>' :
                                    '<button class="btn rounded-0 btn-danger">Ditolak</button>'
                                ?>
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
include_once "../template/footer.php"; ?>