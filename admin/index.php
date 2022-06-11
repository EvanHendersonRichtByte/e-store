<?php include_once "../template/header.php" ?>

<div class="admin container-fluid p-3 min-vh-100">
    <div class="row">
        <?php include_once "../components/admin_sidebar.php" ?>
        <div class="col-8 ms-4 mt-2">
            <h4 class="fw-bold">Hello Anonymous!</h4>
            <div class="stats mt-4">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <div class="box-1 col-md-12 p-4 text-light rounded shadow d-flex flex-column align-items-center">
                            <i class="mb-3 bi bi-box"></i>
                            <h5>Total Products: 14</h5>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box-2 col-md-12 p-4 text-light rounded shadow d-flex flex-column align-items-center">
                            <i class="mb-3 bi bi-exclamation-square"></i>
                            <h5>Uncompleted Task: 7</h5>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box-3 col-md-12 p-4 text-light rounded shadow d-flex flex-column align-items-center">
                            <i class="mb-3 bi bi-check2-all"></i>
                            <h5>Completed Task: 2</h5>
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
                    <div class="row align-items-center mb-4">
                        <div class="col-md-2">
                            <img class="task__thumbnail" src="../assets/static_images/dummy.png">
                        </div>
                        <div class="col d-flex flex-column">
                            <h5>Judul</h5>
                            <p class="m-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate deleniti </p>
                        </div>
                        <div class="col-md-1">
                            <img class="task__creator" src="../assets/static_images/dummy.png">
                        </div>
                    </div>
                    <div class="row align-items-center mb-4">
                        <div class="col-md-2">
                            <img class="task__thumbnail" src="../assets/static_images/dummy.png">
                        </div>
                        <div class="col d-flex flex-column">
                            <h5>Judul</h5>
                            <p class="m-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptate deleniti </p>
                        </div>
                        <div class="col-md-1">
                            <img class="task__creator" src="../assets/static_images/dummy.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include_once "../template/footer.php"  ?>