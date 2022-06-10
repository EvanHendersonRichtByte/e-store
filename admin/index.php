<?php include_once "../template/header.php" ?>

<div class="admin container-fluid">
    <div class="row p-4">
        <nav class="col-3 nav flex-column shadow rounded py-3">
            <div class="sidebar row align-items-center">
                <div class="col-md-4 d-flex justify-content-center">
                    <img src="../assets/static_images/dummy.png">
                </div>
                <div class="col">
                    <h4>Anonymous</h4>
                    <h6>Officer</h6>
                </div>
            </div>
            <h5 class="nav-link text-dark fw-semibold m-0 mt-3 ms-2">Menu</h5>
            <a class="nav-link active" aria-current="page" href="#"><i class="mx-2 bi bi-speedometer2"></i>Dashboard</a>
            <a class="nav-link" href="#"><i class="mx-2 bi bi-box"></i>Products</a>
            <a class="nav-link" href="#"><i class="mx-2 bi bi-card-checklist"></i>Active Tasks</a>
            <a class="nav-link" href="#"><i class="mx-2 bi bi-handbag"></i>Transaction List</a>
            <h5 class="nav-link text-dark fw-semibold m-0 ms-2 mt-5">Settings</h5>
            <a class="nav-link" href="#"><i class="mx-2 bi bi-person-badge"></i>Change Profile</a>
            <a class="nav-link" href="#"><i class="mx-2 bi bi-file-lock"></i>Change Password</a>
            <a class="nav-link" href="#"><i class="mx-2 bi bi-envelope"></i>Change Email</a>
            <a class="nav-link" href="#"><i class="mx-2 bi bi-door-open"></i>Logout</a>
        </nav>
        <div class="ms-3 col-6 p-3 shadow">
            <h4 class="fw-bold">Hello Anonymous!</h4>
            <h5 class="my-4">Monthly Tasks</h5>
            <ul class="nav nav-tabs border-0">
                <li class="nav-item">
                    <a class="nav-link p-0 py-2 border-0 active" aria-current="page" href="#">Active Tasks</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  border-0" href="#">Completed</a>
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
        <div class="stats col ms-3">
            <div class="row mb-3">
                <div class="box-1 col-md-12 p-5 text-light rounded shadow d-flex flex-column align-items-center">
                    <i class="mb-3 bi bi-box"></i>
                    <h5>Total Products: 14</h5>
                </div>
            </div>
            <div class="row mb-3">
                <div class="box-2 col-md-12 p-5 text-light rounded shadow d-flex flex-column align-items-center">
                    <i class="bi bi-exclamation-square"></i>
                    <h5>Uncompleted Task: 7</h5>
                </div>
            </div>
            <div class="row mb-3">
                <div class="box-3 col-md-12 p-5 text-light rounded shadow d-flex flex-column align-items-center">
                    <i class="bi bi-check2-all"></i>
                    <h5>Completed Task: 2</h5>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include_once "../template/footer.php"  ?>