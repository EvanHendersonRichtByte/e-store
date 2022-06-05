<?php include_once "../template/header.php";
include_once "../auth/index.php";
pageAuth($address);
?>

<?php include "../components/client_dashboard_navbar.php" ?>

<section class="client--cart">
    <form action="" method="post">
        <div class="form-group">
            <label for="username">Atas Nama:</label>
            <input type="text" name="username" id="username">
        </div>
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <input type="text" name="alamat" id="alamat">
        </div>
        <label for="">Sistem Pembayaran:</label>
    </form>
    <div class="items">
        <div class="item">
            <div class="image"><img src="../assets/static_images/dummy.png" alt="dummy"></div>
            <h3>Judul</h3>
            <h3>Rp. 120.000</h3>
        </div>
        <div class="item">
            <div class="image"><img src="../assets/static_images/dummy.png" alt="dummy"></div>
            <h3>Judul</h3>
            <h3>Rp. 60.000</h3>
        </div>
        <hr>
        <h1>Total: Rp. 180.000</h1>
        <button class="btn btn-secondary">Place Order</button>
    </div>
</section>

<?php include_once "../template/footer.php"  ?>