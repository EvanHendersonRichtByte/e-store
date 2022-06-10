<?php include_once "../template/header.php" ?>

<?php include "../components/client_dashboard_navbar.php" ?>

<?php include_once "../config/connect.php" ?>

<section class="client-transaction">
    <div class="container pt-4">
        <h4>List Pesanan</h4>
        <div class="row">
            <div class="container">
                <table class="rounded-top-corner table table-responsive mt-4">
                    <thead>
                        <tr class="bg-dark text-light">
                            <th scope="col">#</th>
                            <th scope="col">Tgl Pemesanan</th>
                            <th scope="col">Ditangani Oleh</th>
                            <th scope="col">List Barang</th>
                            <th scope="col">Total Harga</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>12 April 2022</td>
                            <td>Agus Mulyanto</td>
                            <td>
                                <div class="d-flex">
                                    <img class="" src="../assets/static_images/dummy.png" style="width: 10rem;">
                                    <div class="col-md-8 d-flex flex-column ms-3">
                                        <h5>Buku Siksa Kubur</h5>
                                        <div class="d-flex">
                                            <p>Rp.6000</p>
                                            <p>=</p>
                                            <p>x2</p>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <h5>Rp. 24000</h5>
                            </td>
                            <td><button class="btn rounded-0 btn-dark">Pending</button></td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?php include_once "../template/footer.php"  ?>