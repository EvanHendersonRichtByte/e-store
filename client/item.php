<?php include_once "../template/header.php" ?>


<?php include "../components/client_dashboard_navbar.php" ?>

<?php include_once "../config/connect.php" ?>


<?php

// Add Item
if (isset($_POST['addToCart'])) {
    $id_penjualan = null;
    $id_barang = $_POST['addToCart'];
    $id_customer = $_SESSION['logged']['id'];
    $query = "SELECT id_penjualan FROM penjualan WHERE id_customer = $id_customer AND id_petugas IS NULL LIMIT 1";
    $data = $mysqli->query($query);
    if ($data->num_rows > 0) {
        $id_penjualan = $data->fetch_array()["id_penjualan"];
        $query = "INSERT INTO detail_penjualan SET id_penjualan = $id_penjualan, id_barang = $id_barang, jumlah = 1, total = NULL";
        if ($mysqli->query($query)) {
        } else {
            echo "Failed!";
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
elseif (isset($_POST['editJumlah'])) {
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
elseif(isset($_POST['hapusCart'])){
    $id_customer = $_SESSION['logged']['id'];
    $id_barang = $_POST['idBrg'];
    $query = "DELETE FROM detail_penjualan WHERE id_barang = $id_barang AND id_penjualan = (SELECT id_penjualan FROM penjualan WHERE id_customer = $id_customer)";
    $mysqli->query($query);
}

if(isset($_GET['id'])){
    $id_Brg = $_GET['id'];
    $query = "SELECT * FROM barang WHERE id_barang = $id_Brg";
    $data = $mysqli->query($query);
    $key = $data->fetch_assoc();
} else echo "<script>alert('NULL ID')</script>";
?>
<section class="client-item-details">
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-4 image">
                <img class="w-100" <?php echo $key['image'] ? $key['image'] : "../assets/static_images/dummy.png" ?> alt="...">
            </div>
            <div class="col-md-8 detail">
                <h3><?php echo $key['nama_barang'] ?></h3>
                <p><?php echo $key['deskripsi'] ?></p>
                <p>Stok : <?php echo $key['stok'] ?></p>
                <h5>Rp. <?php echo $key['harga'] ?></h5>
                <form method="POST" id="formAdd">
                        <div class="row">
                            <?php
                                $id_customer = $_SESSION['logged']['id'];
                                $query = "SELECT id_barang,jumlah FROM detail_penjualan WHERE id_penjualan = (SELECT id_penjualan FROM penjualan WHERE id_customer = " . $id_customer . ") ORDER BY id_barang";
                                $dataDP = $mysqli->query($query);
                                $arrayDP_id = array();
                                $arrayDP_jml = array();
                                while ($rowID = mysqli_fetch_assoc($dataDP)) {
                                    $arrayDP_id[] = $rowID['id_barang'];
                                    $arrayDP_jml[] = $rowID['jumlah'];
                                }
                                $bool = false;
                                if ($dataDP->num_rows > 0) {
                                    for ($i = 1; $i <= $dataDP->num_rows; $i++) {
                                        if ($arrayDP_id[$i - 1] == $key['id_barang']) {
                                            $index = $i;
                                            $bool = true;
                                        }
                                    }
                                }
                                if ($bool == true) {
                            ?>
                            <div class="input-group w-25">
                                <input type="hidden" name="stokBrg" value="<?php echo $key['stok'] ?>">
                                <input type="hidden" name="idBrg" value="<?php echo $arrayDP_id[$index - 1] ?>">
                                <input type="hidden" name="jmlBrg" value="<?php echo $arrayDP_jml[$index - 1] ?>">
                                <button class="input-group-text" name="editJumlah" type="submit" value="-"><i class="bi bi-dash"></i></button>
                                <input type="number" name="inpDewe" id="" class="form-control" value=<?php echo $arrayDP_jml[$index - 1] ?> onclick="document.getElementById('myform').submit()">
                                <button class="input-group-text" name="editJumlah" type="submit" value="+"><i class="bi bi-plus"></i></button>
                            </div>
                            <div class="col">
                                <button class="btn btn-danger" name="hapusCart" type="submit" value="<?php echo $key['id_barang'] ?>"><i class="bi bi-bag-x"></i> | Remove From Cart</i></button>
                                <!-- <a href="#" class="form-control btn btn-danger"><i class="bi bi-bag-x"></i></a> -->
                            </div>
                            <?php
                                    } else {
                            ?>
                            <div class="col-5">
                                <button class="form-control btn btn-success" name="addToCart" type="submit" value="<?php echo $key['id_barang'] ?>"><i class="bi bi-bag-plus"></i> | Add To Cart</i></button>
                            </div>
                            <?php
                        }
                        ?>
                        </div>
                    </form>
                <!-- <div class="col-5 d-flex justify-content-center align-items-center w-100 pt-3">
                    <div class="input-group w-50">
                        <button class="input-group-text"><i class="bi bi-dash"></i></button>
                        <input type="number" name="" id="" class="form-control">
                        <button class="input-group-text"><i class="bi bi-plus"></i></button>
                    </div>
                    <div class="input-group ms-3">
                        <button class="btn btn-success">Add to cart</button>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</section>

<?php include_once "../template/footer.php"  ?>