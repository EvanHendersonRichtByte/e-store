<?php include_once "./config/config.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The E-Store</title>
    <link rel="shortcut icon" href="./assets/icons/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/bootstrap-icons.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <div class="container-fluid min-vh-100 p-0">
        <nav class="navbar navbar-expand-lg shadow">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="./assets/static_images/brand.png" alt="" width="30" height="30" class="d-inline-block align-text-top">
                    E-Store
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#handleResponsiveButton" aria-controls="handleResponsiveButton" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="handleResponsiveButton">
                    <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $address ?>/client/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $address ?>/client/">Catalog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $address ?>/client/">Products</a>
                        </li>
                    </ul>
                </div>
                <div class="collapse navbar-collapse" id="handleResponsiveButton">
                    <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $address ?>/admin/login.php"><button class="btn btn-transparent text-danger disable-btn-hover">Login as Admin</button></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $address ?>/client/login.php"><button class="btn btn-primary">Login as Customer</button></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container row d-flex align-items-center mt-5 justify-content-between mx-auto p-0 pt-5">
            <div class="col-md-4">
                <h1>Making your shopping process faster </h1>
                <p class="mt-3">
                    The only online store that allows you to create multiple orders at once
                </p>
                <a href="<?php echo $address ?>/client/login.php" class="btn btn-primary rounded-0">Get Started</a>
            </div>
            <div class="col-md-8">
                <img src="./assets/static_images/es.png" alt="Truck" class="w-100">
            </div>
        </div>
    </div>

    <script type="text/javascript" src="./assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="./assets/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="./assets/js/script.js"></script>
</body>

</html>