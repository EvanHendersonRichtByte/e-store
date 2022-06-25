<?php include_once "../template/header.php" ?>

<?php

$query = "SELECT COUNT(*) total_barang FROM barang";
$total_barang = $mysqli->query($query)->fetch_assoc()['total_barang'];
$query = "SELECT COUNT(*) total_order FROM penjualan WHERE id_petugas IS NULL AND total > 0";
$total_order = $mysqli->query($query)->fetch_assoc()['total_order'];
$query = "SELECT COUNT(*) total_order_selesai FROM penjualan WHERE id_petugas IS NOT NULL";
$total_order_selesai = $mysqli->query($query)->fetch_assoc()['total_order_selesai'];
$query = "SELECT p.id_customer, c.username, p.total, c.imageType ,c.imageData , p.status FROM penjualan p JOIN customer c ON p.id_customer = c.id_customer WHERE p.id_petugas IS NULL AND p.status = 'Proses' ORDER BY tanggal LIMIT 3";
// $query = "SELECT p.id_customer, username, dp.total, c.imageType ,c.imageData , status FROM penjualan p JOIN customer c ON p.id_customer = c.id_customer JOIN detail_penjualan dp ON p.id_penjualan = dp.id_penjualan  WHERE id_petugas IS NULL ORDER BY tanggal LIMIT 3";
$penjualan_terbaru = $mysqli->query($query) or die($mysqli->error);
?>

<div class="admin container-fluid p-3 min-vh-100">
    <div class="row">
        <?php include_once "../components/admin_sidebar.php" ?>
        <div class="col-md-8 col-sm-12">
            <h4 class="fw-bold text-capitalize">Hello <?php echo $_SESSION['logged']['username'] ?>!</h4>
            <div class="stats mt-4">
                <div class="row align-items-center">
                    <div class="spacer d-sm-block d-md-none">&nbsp;</div>
                    <div class="col-md-4">
                        <div class="box-1 col-md-12 p-4 text-light rounded shadow d-flex flex-column align-items-center">
                            <i class="mb-3 bi bi-box"></i>
                            <h5>Total Products: <?php echo $total_barang ?></h5>
                        </div>
                    </div>
                    <div class="spacer d-sm-block d-md-none">&nbsp;</div>
                    <div class="col-md-4">
                        <div class="box-2 col-md-12 p-4 text-light rounded shadow d-flex flex-column align-items-center">
                            <i class="mb-3 bi bi-exclamation-square"></i>
                            <h5>Uncompleted Task: <?php echo $total_order ?></h5>
                        </div>
                    </div>
                    <div class="spacer d-sm-block d-md-none">&nbsp;</div>
                    <div class="col-md-4">
                        <div class="box-3 col-md-12 p-4 text-light rounded shadow d-flex flex-column align-items-center">
                            <i class="mb-3 bi bi-check2-all"></i>
                            <h5>Completed Task: <?php echo $total_order_selesai ?></h5>
                        </div>
                    </div>
                </div>

            </div>
            <h5 class="my-4">Monthly Tasks</h5>
            <ul class="nav nav-tabs border-0">
                <li class="nav-item">
                    <a class="nav-link p-0 py-2 border-0 active" aria-current="page" href="<?php echo $address ?>/admin/">Active Tasks</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  border-0" href="<?php echo $address ?>/admin/">Completed</a>
                </li>
            </ul>
            <div class="task mt-3 d-flex flex-column pt-3">
                <h6>Today</h6>
                <div class="d-flex flex-column mt-2">
                    <?php
                    $id_customer;
                    foreach ($penjualan_terbaru as $key) {
                        $id_customer = $key['id_customer'];

                    ?>
                        <div class="row align-items-center mb-4">
                            <div class="col-md-2">
                                <img class="w-100 rounded-4" src="<?php echo $address ?>/components/view_image.php?id_customer=<?php echo $id_customer ?>" alt="image">
                            </div>
                            <div class="col d-flex flex-column">
                                <h5 class="text-capitalize"><?php echo $key['username'] ?></h5>
                                <p class="m-0">Status: <span><?php echo $key['status'] ?></span></p>
                                <p class="m-0">Total: <span class="text-success">Rp.<?php echo $key['total'] ?></span></p>
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
$mysqli->close();
include_once "../template/footer.php";  ?>