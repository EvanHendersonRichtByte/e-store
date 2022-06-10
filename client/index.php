<?php include_once "../template/header.php"  ?>

<?php include "../components/client_dashboard_navbar.php" ?>
<section class="client-dashboard container d-flex flex-wrap pt-5">
    <?php
    include_once "../config/connect.php";

    // Add Item
    if (isset($_POST['addToCart'])) {
        $id_penjualan = null;
        $id_barang = $_POST['addToCart'];
        $id_customer = $_SESSION['logged']['id'];
        $harga = $_POST['harga'];
        $query = "SELECT id_penjualan FROM penjualan WHERE id_customer = $id_customer AND id_petugas IS NULL LIMIT 1";
        $data = $mysqli->query($query);
        if ($data->num_rows > 0) {
            $id_penjualan = $data->fetch_array()["id_penjualan"];
            $query = "INSERT INTO detail_penjualan SET id_penjualan = $id_penjualan, id_barang = $id_barang, jumlah = 1, total = $harga";
            if ($mysqli->query($query)) {
            } else {
                echo "Failed";
            }
        } else {
            $query = "INSERT INTO penjualan SET id_customer = $id_customer, id_petugas = NULL";
            if ($mysqli->query($query)) {
                $query = "SELECT id_penjualan FROM penjualan WHERE id_customer = $id_customer AND id_petugas IS NULL LIMIT 1";
                $id_penjualan = $mysqli->query($query)->fetch_array()["id_penjualan"];
                $query = "INSERT INTO detail_penjualan SET id_penjualan = $id_penjualan, id_barang = $id_barang, jumlah = 1, total = $harga";
                if ($mysqli->query($query)) {
                } else {
                    echo "Failed";
                }
            } else {
                echo "Failed";
            }
        }
    }
    if (isset($_POST['editJumlah'])) {
        if (($_POST['stokBrg'] > $_POST['jmlBrg'] && $_POST['jmlBrg'] > 0) || ($_POST['jmlBrg'] == 10 && $_POST['editJumlah'] == "-")) {
            $id_customer = $_SESSION['logged']['id'];
            $id_barang = $_POST['idBrg'];
            $opr = $_POST['editJumlah'];
            if ($_POST['jmlBrg'] == 1 && $_POST['editJumlah'] == "-") {
                $query = "DELETE FROM detail_penjualan WHERE id_barang = $id_barang AND id_penjualan = (SELECT id_penjualan FROM penjualan WHERE id_customer = $id_customer)";
                $mysqli->query($query);
            } else {
                $query = "UPDATE detail_penjualan SET jumlah = jumlah $opr 1 WHERE id_barang = $id_barang AND id_penjualan = (SELECT id_penjualan FROM penjualan WHERE id_customer = $id_customer)";
                $mysqli->query($query);
            }
        } else {
            echo "<script type='text/javascript'>alert('Stok tidak mencukupi');</script>";
        }
    }

    // Load Page
    $query = "SELECT * FROM barang ORDER BY nama_barang";
    $data = $mysqli->query($query);
    if ($data->num_rows > 0) {
        $data->fetch_assoc();
        foreach ($data as $key) {
    ?>
            <div class="card me-5 mb-5" style="width: 18rem;">
                <img src=<?php echo $key['image'] ? $key['image'] : "../assets/static_images/dummy.png" ?> class="card-img-top" alt="...">
                <div class="card-body">
                    <a class="card-title text-decoration-none" href="<?php echo $address ?>/client/item.php">
                        <h5><?php echo $key['nama_barang'] ?></h5>
                    </a>
                    <p class="card-text"><?php echo $key['deskripsi'] ?></p>
                    <p class="card-text">Stok : <?php echo $key['stok'] ?></p>
                    <p class="card-text">Rp. : <?php echo $key['harga'] ?></p>
                    <div class="row">
                        <div class="col">
                            <a href="#" class="btn btn-success"><i class="bi bi-bag-plus"></i></a>
                        </div>
                        <div class="input-group w-75">
                            <button class="input-group-text"><i class="bi bi-dash"></i></button>
                            <input type="number" name="" id="" class="form-control">
                            <button class="input-group-text"><i class="bi bi-plus"></i></button>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        }
    }
    ?>
</section>

<?php include_once "../template/footer.php"  ?>

<?php /* Tolong gan hehe?>

<form action="" method="POST">
    <input type="hidden" name="harga" value="<?php echo $key['harga'] ?>">
    <?php
    $id_customer = $_SESSION['logged']['id'];
    $query = "SELECT id_barang FROM detail_penjualan WHERE id_penjualan = (SELECT id_penjualan FROM penjualan WHERE id_customer = " . $id_customer . ") ORDER BY id_barang";
    $data_idBarang = $mysqli->query($query);
    $array_idBarang = array();
    while ($rowID = mysqli_fetch_assoc($data_idBarang)) {
        $array_idBarang[] = $rowID['id_barang'];
    }
    if ($data_idBarang->num_rows > 0) {
        $bool = false;
        for ($i = 1; $i <= $data_idBarang->num_rows; $i++) {
            if ($array_idBarang[$i - 1] == $key['id_barang']) {
                $bool = true;
            }
        }
        if ($bool == true) {
            echo "<button class=" . "btn-secondary" . " name=" . "addToCart" . ">Terpilih</button>";
        } else {
            echo "<button class=" . "btn-secondary" . " name=" . "addToCart" . " value=" . $key['id_barang'] . " type=" . "submit" . ">Add</button>";
        }
    } else {
        echo "<button class=" . "btn-secondary" . " name=" . "addToCart" . " value=" . $key['id_barang'] . " type=" . "submit" . ">Add</button>";
    }
    ?>
    <!-- <button class="btn-secondary" name="addToCart" value="<?php //echo $key['id_barang'] ?>" type="submit">Add</button> -->
</form>

<?php // */ ?>