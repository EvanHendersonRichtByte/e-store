<?php include_once "../template/header.php"  ?>

<?php include "../components/client_dashboard_navbar.php" ?>
<section class="client--dashboard">
    <div class="card">
        <div class="image">
            <img src="../assets/static_images/dummy.png" alt="dummy">
        </div>
        <div class="details">
            <a href="<?php echo $address?>/client/item.php" class="title">Judul</a>
            <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            <p class="price">Rp. 12.000</p>
        </div>
        <button class="btn-secondary">Add</button>
    </div>
</section>

<?php include_once "../template/footer.php"  ?>