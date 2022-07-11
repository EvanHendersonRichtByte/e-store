<?php include_once "../template/header.php"  ?>

<?php include "../components/client_dashboard_navbar.php" ?>
<section class="client-dashboard container d-flex flex-wrap pt-5">
    <div class="col-12 mb-4">
        <div class="col-lg-4 col-md-5 col-sm-12">
            <form class="d-flex" action="#" method="POST">
                <input type="text" name="search_barang" class="form-control border-success" placeholder="Search...">
                <input class="ms-3 btn btn-success" type="submit" name="Search">
            </form>
        </div>
    </div>
    <?php
    include_once "../config/connect.php";
    $id_customer = $_SESSION['logged']['id'];
    $query = "SELECT id_penjualan FROM penjualan WHERE id_customer = $id_customer AND status = 'Listed' AND id_petugas IS NULL LIMIT 1";
    $data = $mysqli->query($query);
    $id_penjualan = null;
    if ($data->num_rows > 0) {
        $id_penjualan = $data->fetch_array()["id_penjualan"];
    }
    // $query = "SELECT * FROM penjualan p LEFT JOIN detail_penjualan dp ON p.id_penjualan = dp.id_penjualan JOIN barang b ON dp.id_barang = b.id_barang WHERE p.status = 'Listed' AND p.id_customer = 4 AND dp.id_barang = 1";

    $activePage = isset($_GET['page']) ? $_GET['page'] : 1;
    $itemLimit = 3;
    $totalPage = ceil($mysqli->query("SELECT * FROM barang")->num_rows / $itemLimit);
    $itemIndexStart = $activePage * 3 - $itemLimit;

    $query = "SELECT * FROM barang ORDER BY nama_barang LIMIT $itemIndexStart , $itemLimit";

    if (isset($_POST['Search'])) {
        $nama = $_POST['search_barang'];
        $query = "SELECT * FROM barang WHERE nama_barang LIKE '%$nama%' OR deskripsi LIKE '%$nama%' ORDER BY nama_barang";
    }

    $data = $mysqli->query($query);
    if ($data->num_rows > 0) {
        $data->fetch_assoc();

        foreach ($data as $key) {
            $query = "SELECT * FROM penjualan p LEFT JOIN detail_penjualan dp ON p.id_penjualan = dp.id_penjualan JOIN barang b ON dp.id_barang = b.id_barang WHERE p.status = 'Listed' AND p.id_customer = $id_customer AND dp.id_barang = " . $key['id_barang'];
            $user_transaction = $mysqli->query($query) or die($mysqli->error);
            $user_transaction = $user_transaction->fetch_assoc();
            // $id_penjualan = isset($user_transaction['id_penjualan']) && $user_transaction['id_penjualan'];
            $id_detail_penjualan = isset($user_transaction['id_detail_penjualan']) ? $user_transaction['id_detail_penjualan'] : null;
            $user_transaction_jumlah = isset($user_transaction['jumlah']) ? $user_transaction['jumlah'] : 0; ?>
            <div class="card me-sm-0 me-md-5 mb-4 mb-md-5" style="width: 18rem;">
                <img class="card-img-top h-auto w-auto mx-auto" src="<?php echo $address ?>/components/view_image.php?id_barang=<?php echo $key['id_barang'] ?>" style="max-width: 10rem ; max-height: 10rem; ">
                <div class="card-body">
                    <button type="button" class="btn border-0 btn-transparent text-left p-0 text-success" data-bs-toggle="modal" data-bs-target="#detail<?php echo $key['id_barang'] ?>">
                        <h5><?php echo $key['nama_barang'] ?></h5>
                    </button>
                    <p class="card-text"><?php echo $key['deskripsi'] ?></p>
                    <p class="card-text">Stok : <?php echo $key['stok'] ?></p>
                    <p class="card-text">Rp. : <?php echo $key['harga'] ?></p>
                    <div class="row">
                        <?php
                        if (isset($id_detail_penjualan)) {
                        ?>
                            <div class="col">
                                <button type="button" class="btn btn-danger border-0" name="asyncDelCart" value="<?php echo $key['id_barang'] ?>" data-cs-idDetailPenjualan="<?php echo $id_detail_penjualan ?>"><i class="bi bi-bag-x"></i></button>
                            </div>
                            <div class="input-group w-75">
                                <button type="button" class="input-group-text" name="editJumlah" value="-"><i class="bi bi-dash"></i></button>
                                <input type="number" min=0 max=<?php echo $key['stok'] ?> name="editInputField" class="form-control" value="<?php echo $user_transaction_jumlah ?>" data-cs-idBarang="<?php echo $key['id_barang'] ?>" data-cs-idDetailPenjualan="<?php echo $id_detail_penjualan ?>" data-cs-idCustomer="<?php echo $id_customer ?>" data-cs-hargaBarang="<?php echo $key['harga'] ?>" data-cs-idPenjualan="<?php echo $id_penjualan ?>">
                                <button type="button" class="input-group-text" name="editJumlah" value="+"><i class="bi bi-plus"></i></button>
                            </div>
                        <?php
                        } else if ($key['stok'] == 0) {
                        ?>
                            <div class="col">
                                <button type="button" class="form-control btn btn-outline-secondary" name="nothing" value="<?php echo $key['id_barang'] ?>" onclick="alert('Stok tidak mencukupi')"><i class="bi bi-bag"></i></button>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="col">
                                <button type="button" class="form-control btn btn-success" name="asyncAddCart" value="<?php echo $key['id_barang'] ?>" data-cs-hargaBarang="<?php echo $key['harga'] ?>"><i class="bi bi-bag-plus"></i></button>
                            </div>
                        <?php
                        }
                        ?>
                    </div>

                    <div class="modal fade" id="detail<?php echo $key['id_barang'] ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"><?php echo $key['nama_barang'] ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <img src="<?php echo $address ?>/components/view_image.php?id_barang=<?php echo $key['id_barang'] ?>" alt="" class="img-fluid">
                                    <p class="card-text"><?php echo $key['deskripsi'] ?></p>
                                    <p class="card-text">Rp. : <?php echo $key['harga'] ?></p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <p class="card-text">Stok : <?php echo $key['stok'] ?></p>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php }
    } ?>

    <nav class="w-100" aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item <?php $activePage <= 1 && print('disabled') ?>">
                <a class="page-link" href="?page=<?php echo $activePage - 1 ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php
            $handlePaginationNumberingLimit = $totalPage > 3 ? 3 : $totalPage;
            for ($i = 1; $i <= $handlePaginationNumberingLimit; $i++) {
            ?>
                <li class="page-item"><a class="page-link" href="?page=<?php echo $i ?>"><?php echo $i ?></a></li>
            <?php
            }
            ?>
            <li class="page-item <?php $activePage >= $totalPage && print('disabled') ?>">
                <a class="page-link" href="?page=<?php echo $activePage + 1 ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</section>

<?php include_once "../template/footer.php"  ?>

<script>
    const defaultUrl = "<?php echo $address ?>"
    const id_customer = "<?php echo $_SESSION['logged']['id'] ?>"
    let id_barang = null

    // $('input[name=search_barang]').on('change', () => {
    //     $('.card').filter((_, e) => {
    //         $(e).find('.card-body h5').each((_, f) => {
    //             const input = $('input[name=search_barang]').val().toLowerCase()
    //             console.log(input, $(f).html())
    //             if ($(e).html().toLowerCase().search(input) <= -1) {
    //                 $(e).toggle()
    //             }
    //         })

    //     })
    // })

    const updateNav = () => {
        $.post(`${defaultUrl}/client/api/navbarControl.php`, {
            Update: id_customer
        }, (data, status) => {
            $('a.cart').has('span').length ? $('a.cart span').html(data) : $('a.cart').append("<span class='position-absolute translate-middle badge rounded-pill bg-danger'>1</span>")
        })
    }

    $('button[name=asyncAddCart]').each((_, e) => e.addEventListener("click", async () => {
        id_barang = $(e).val();
        harga = $(e).attr('data-cs-hargaBarang');
        await $.post(`${defaultUrl}/client/api/transaction.php`, {
            Type: "Create",
            id_barang,
            id_customer,
            harga
        }, (data, status) => updateNav());
        location.reload();
    }))

    $('button[name=asyncDelCart]').each((_, e) => e.addEventListener("click", async () => {
        let data = $(e).attr('data-cs-idDetailPenjualan');
        await $.post(`${defaultUrl}/client/api/transaction.php`, {
            Type: "DeleteCarto",
            id_detail_penjualan: data
        }, (data, status) => {
            if (data === 'Delete Performed') window.location.reload()
        }).done(() => updateNav());
    }))

    $('button[name=editJumlah]').each((_, e) => e.addEventListener('click', async () => {
        await setTimeout(() => {
            let operation = $(e).val();
            let input = $(e).closest('div').find('input');
            // Handle input limit
            if (input.val() !== input.attr('max') || operation === '-') input.val(eval(`parseInt(input.val()) ${operation} 1`));
            input.val() <= input.attr('min') && input.val(0)
            $.post(`${defaultUrl}/client/api/transaction.php`, {
                Type: "ModifyQty",
                id_customer: input.attr('data-cs-idCustomer'),
                id_penjualan: input.attr('data-cs-idPenjualan'),
                id_detail_penjualan: input.attr('data-cs-idDetailPenjualan'),
                id_barang: input.attr('data-cs-idBarang'),
                harga: input.attr('data-cs-hargaBarang'),
                qty: input.val()
            }, (data, status) => {
                if (data === 'New Data Created' || data == 'Delete Performed') window.location.reload()
            }).done(() => updateNav());
        }, 500)
    }))

    $('input[name=editInputField]').each((_, e) => e.addEventListener('change', function() {
        let input = $(e).closest('div').find('input');
        // Handle input limit
        $.post(`${defaultUrl}/client/api/transaction.php`, {
            Type: "ModifyQty",
            id_customer: input.attr('data-cs-idCustomer'),
            id_penjualan: input.attr('data-cs-idPenjualan'),
            id_detail_penjualan: input.attr('data-cs-idDetailPenjualan'),
            id_barang: input.attr('data-cs-idBarang'),
            harga: input.attr('data-cs-hargaBarang'),
            qty: $(e).val()
        }, (data, status) => {
            if (data === 'New Data Created') {
                window.location.reload();
            } else if (data === 'False Qty') {
                alert(`Stok tidak mencukui\nPastikan data telah benar`);
                window.location.reload();
            }
        }).done(() => updateNav());
    }))
</script>