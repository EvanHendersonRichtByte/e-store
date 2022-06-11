<?php include_once "../template/header.php" ?>

<div class="admin container-fluid p-3 min-vh-100">
    <div class="row">
        <?php include_once "../components/admin_sidebar.php" ?>
        <div class="col-8 ms-4 mt-2">
            <div class="col-md-8 w-100">
                <h4 class="mb-3">Change Email</h4>
                <hr class="d-sm-block d-md-none">
                <form action="" method="POST">
                    <h6 class="mb-3">Previous Email: anonymous@gmail.com</h6>
                    <div class="form-group mb-3">
                        <label class="form-label" for="email">Email</label>
                        <input class="form-control" id="email" type="email" name="email">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once "../template/footer.php"  ?>