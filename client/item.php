<?php include_once "../template/header.php"  ?>

<?php include "../components/client_dashboard_navbar.php" ?>

<?php include_once "../config/connect.php" ?>

<section class="client--item-details">
    <div class="image">
        <img src="../assets/static_images/dummy.png" alt="dummy">
    </div>
    <div class="detail">
        <h2>Judul</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo eaque eveniet deleniti, vitae beatae atque autem fugiat cupiditate ipsa</p>
        <h3>Rp. 12.000</h3>
        <div class="quantity">
            <button class="btn btn-light"><i class="ri-arrow-left-s-line"></i></button>
            <p>12</p>
            <button class="btn btn-light"><i class="ri-arrow-right-s-line"></i></button>
        </div>
        <button class="btn btn-secondary">Add to cart</button>
    </div>
</section>

<?php include_once "../template/footer.php"  ?>