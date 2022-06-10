<?php include_once "../template/header.php" ?>


<?php include "../components/client_dashboard_navbar.php" ?>

<?php include_once "../config/connect.php" ?>

<section class="client-item-details">
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-4 image">
                <img class="w-100" src="../assets/static_images/dummy.png" alt="dummy">
            </div>
            <div class="col-md-8 detail">
                <h3>Judul</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo eaque eveniet deleniti, vitae beatae atque autem fugiat cupiditate ipsa</p>
                <h5>Rp. 12.000</h5>
                <div class="col-5 d-flex justify-content-center align-items-center w-100 pt-3">
                    <div class="input-group w-50">
                        <button class="input-group-text"><i class="bi bi-dash"></i></button>
                        <input type="number" name="" id="" class="form-control">
                        <button class="input-group-text"><i class="bi bi-plus"></i></button>
                    </div>
                    <div class="input-group ms-3">
                        <button class="btn btn-success">Add to cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include_once "../template/footer.php"  ?>