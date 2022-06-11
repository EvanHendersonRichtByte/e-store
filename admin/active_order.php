<?php include_once "../template/header.php" ?>

<div class="admin container-fluid p-3 min-vh-100">
    <div class="row">
        <?php include_once "../components/admin_sidebar.php" ?>
        <div class="col-8 ms-4 mt-2">
            <h4 class="fw-bold">List Order</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Customer</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="col">1</td>
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
                            <button class="btn btn-secondary border-0">
                                <i class="bi bi-search"></i> Detail Order
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once "../template/footer.php"  ?>