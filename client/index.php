<?php include_once "../template/header.php"  ?>

<?php include "../components/client_dashboard_navbar.php" ?>
<section class="client-dashboard container d-flex flex-wrap pt-5">
    <?php
    include_once "../config/connect.php";
    $id_customer = $_SESSION['logged']['id'];

    $query = "SELECT id_penjualan FROM penjualan WHERE id_customer = $id_customer AND status = 'Listed' AND id_petugas IS NULL LIMIT 1";
    $data = $mysqli->query($query);
    $id_penjualan = null;
    if ($data->num_rows > 0) {
        $id_penjualan = $data->fetch_array()["id_penjualan"];
        // $query = "INSERT INTO detail_penjualan SET id_penjualan = $id_penjualan, id_barang = $id_barang, jumlah = 1, total = NULL";
        // if ($mysqli->query($query) or die($mysqli->error)) echo "<script>alert('you have transaction')</script>";
        // else return "Failed to execute INSERT INTO detail_penjualan";
    }
    // Add Item
    if (isset($_POST['addToCart'])) {
        echo "<script>alert('Add to cart performed')</script>";
    } elseif (isset($_POST['editJumlah'])) {
        if (($_POST['stokBrg'] > $_POST['jmlBrg'] && $_POST['jmlBrg'] > 0) || ($_POST['jmlBrg'] == 10 && $_POST['editJumlah'] == "-")) {
            $id_customer = $_SESSION['logged']['id'];
            $id_barang = $_POST['idBrg'];
            $opr = $_POST['editJumlah'];
            if ($_POST['jmlBrg'] == 1 && $_POST['editJumlah'] == "-") {
                $query = "DELETE FROM detail_penjualan WHERE id_barang = $id_barang AND id_penjualan = (SELECT id_penjualan FROM penjualan WHERE id_customer = $id_customer AND status = 'Listed')";
                $mysqli->query($query);
            } else {
                $query = "UPDATE detail_penjualan SET jumlah = jumlah $opr 1 WHERE id_barang = $id_barang AND id_penjualan = (SELECT id_penjualan FROM penjualan WHERE id_customer = $id_customer AND status = 'Listed')";
                $mysqli->query($query);
            }
        } else echo "<script type='text/javascript'>alert('Stok tidak mencukupi');</script>";
    } elseif (isset($_POST['hapusCart'])) {
        $id_customer = $_SESSION['logged']['id'];
        $id_barang = $_POST['idBrg'];
        $query = "DELETE FROM detail_penjualan WHERE id_barang = $id_barang AND id_penjualan = (SELECT id_penjualan FROM penjualan WHERE id_customer = $id_customer AND status = 'Listed')";
        $mysqli->query($query);
    } elseif (isset($_POST['editInput'])) {
        $jumlah = $_POST['editInput'];
        $id_customer = $_SESSION['logged']['id'];
        $id_barang = $_POST['idBrg'];
        $query = "UPDATE detail_penjualan SET jumlah = $jumlah WHERE id_barang = $id_barang AND id_penjualan = (SELECT id_penjualan FROM penjualan WHERE id_customer = $id_customer AND status = 'Listed')";
        $mysqli->query($query);
    }

    // Load Page
    // $query = "SELECT * FROM penjualan p LEFT JOIN detail_penjualan dp ON p.id_penjualan = dp.id_penjualan JOIN barang b ON dp.id_barang = b.id_barang WHERE p.status = 'Listed' AND p.id_customer = 4 AND dp.id_barang = 1";
    $query = "SELECT * FROM barang ORDER BY nama_barang";
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
            <div class="card me-5 mb-5" style="width: 18rem;">
                <img class="card-img-top h-auto w-auto mx-auto" src="<?php echo $address ?>/components/view_image.php?id_barang=<?php echo $key['id_barang'] ?>" style="max-width: 10rem ; max-height: 10rem; ">
                <div class="card-body">
                    <a class="card-title text-decoration-none" href="<?php echo $address ?>/client/item.php?id=<?php echo $key['id_barang'] ?>">
                        <h5><?php echo $key['nama_barang'] ?></h5>
                    </a>
                    <p class="card-text"><?php echo $key['deskripsi'] ?></p>
                    <p class="card-text">Stok : <?php echo $key['stok'] ?></p>
                    <p class="card-text">Rp. : <?php echo $key['harga'] ?></p>
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn border-0 btn-transparent text-success" name="asyncAddCart" value="<?php echo $key['id_barang'] ?>" data-cs-hargaBarang="<?php echo $key['harga'] ?>"><i class="bi bi-bag-plus"></i></button>
                            <!-- <button class="btn btn-danger" name="hapusCart" value="<?php echo $key['id_barang'] ?>"><i class="bi bi-bag-x"></i></button> -->
                        </div>
                        <div class="input-group w-75">
                            <button type="button" class="input-group-text" name="editJumlah" value="-"><i class="bi bi-dash"></i></button>
                            <input type="number" min=0 max="<?php echo $key['stok'] ?>" name="editInputField" class="form-control" value="<?php echo $user_transaction_jumlah ?>" data-cs-idBarang="<?php echo $key['id_barang'] ?>" data-cs-idDetailPenjualan="<?php echo $id_detail_penjualan ?>" data-cs-idCustomer="<?php echo $id_customer ?>" data-cs-hargaBarang="<?php echo $key['harga'] ?>" data-cs-idPenjualan="<?php echo $id_penjualan ?>" disabled>
                            <button type="button" class="input-group-text" name="editJumlah" value="+"><i class="bi bi-plus"></i></button>
                        </div>
                    </div>
                </div>
            </div>
    <?php }
    } ?>
</section>

<?php include_once "../template/footer.php"  ?>

<script>
    const defaultUrl = "<?php echo $address ?>"
    const id_customer = "<?php echo $_SESSION['logged']['id'] ?>"
    let id_barang = null
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
    }))

    $('button[name=editJumlah]').each((_, e) => e.addEventListener('click', async () => {
        let operation = $(e).val();
        let input = $(e).closest('div').find('input');
        // Handle input limit
        if (input.val() !== input.attr('max') || operation === '-') input.val(eval(`parseInt(input.val()) ${operation} 1`));
        input.val() <= input.attr('min') && input.val(0)
        await $.post(`${defaultUrl}/client/api/transaction.php`, {
            Type: "ModifyQty",
            id_customer: input.attr('data-cs-idCustomer'),
            id_penjualan: input.attr('data-cs-idPenjualan'),
            id_detail_penjualan: input.attr('data-cs-idDetailPenjualan'),
            id_barang: input.attr('data-cs-idBarang'),
            harga: input.attr('data-cs-hargaBarang'),
            qty: input.val()
        }, (data, status) => {
            console.log(data)
        });
    }))
</script>