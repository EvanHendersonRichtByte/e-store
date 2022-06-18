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
        $query = "SELECT id_penjualan FROM penjualan WHERE id_customer = $id_customer AND status = 'Listed' AND id_petugas IS NULL LIMIT 1";
        $data = $mysqli->query($query);
        if ($data->num_rows > 0) {
            $id_penjualan = $data->fetch_array()["id_penjualan"];
            $query = "INSERT INTO detail_penjualan SET id_penjualan = $id_penjualan, id_barang = $id_barang, jumlah = 1, total = NULL";
            if ($mysqli->query($query) or die($mysqli->error)) {
            } else {
                echo "Failed!";
            }
    ?>
            <script>
                window.location.assign("<?php echo $address ?>/client/")
            </script>
        <?php
        } else {
            $query = "INSERT INTO penjualan SET id_customer = $id_customer, id_petugas = NULL";
            if ($mysqli->query($query)) {
                $query = "SELECT id_penjualan FROM penjualan WHERE id_customer = $id_customer AND status = 'Listed' AND id_petugas IS NULL LIMIT 1";
                $id_penjualan = $mysqli->query($query)->fetch_array()["id_penjualan"];
                $query = "INSERT INTO detail_penjualan SET id_penjualan = $id_penjualan, id_barang = $id_barang, jumlah = 1, total = " . $_POST['harga'];
                if ($mysqli->query($query) or die($mysqli->error)) {
                } else {
                    echo "Failed";
                }
            } else {
                echo "Failed";
            }
        ?>
            <script>
                window.location.assign("<?php echo $address ?>/client/")
            </script>
        <?php
        }
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
        } else {
            echo "<script type='text/javascript'>alert('Stok tidak mencukupi');</script>";
        }
    } elseif (isset($_POST['hapusCart'])) {
        $id_customer = $_SESSION['logged']['id'];
        $id_barang = $_POST['idBrg'];
        $query = "DELETE FROM detail_penjualan WHERE id_barang = $id_barang AND id_penjualan = (SELECT id_penjualan FROM penjualan WHERE id_customer = $id_customer AND status = 'Listed')";
        $mysqli->query($query);
        ?>
        <script>
            window.location.assign("<?php echo $address ?>/client/")
        </script>
        <?php
    } elseif(isset($_POST['editInput'])){
        $jumlah = $_POST['editInput'];
        $id_customer = $_SESSION['logged']['id'];
        $id_barang = $_POST['idBrg'];
        $query = "UPDATE detail_penjualan SET jumlah = $jumlah WHERE id_barang = $id_barang AND id_penjualan = (SELECT id_penjualan FROM penjualan WHERE id_customer = $id_customer AND status = 'Listed')";
        $mysqli->query($query);
    }

    // Load Page
    $query = "SELECT * FROM barang ORDER BY nama_barang";
    $data = $mysqli->query($query);
    if ($data->num_rows > 0) {
        $data->fetch_assoc();
        $j = 0;
        foreach ($data as $key) {
        ?>
            <div class="card me-5 mb-5" style="width: 18rem;">
                <img class="card-img-top h-auto w-auto mx-auto" src="<?php echo $address ?>/components/view_image.php?id_barang=<?php echo $key['id_barang'] ?>" style="max-width: 10rem ; max-height: 10rem; ">
                <div class="card-body">
                    <a class="card-title text-decoration-none" href="<?php echo $address ?>/client/item.php?id=<?php echo $key['id_barang'] ?>">
                        <h5><?php echo $key['nama_barang'] ?></h5>
                    </a>
                    <p class="card-text"><?php echo $key['deskripsi'] ?></p>
                    <p class="card-text">Stok : <?php echo $key['stok'] ?></p>
                    <p class="card-text">Rp. : <?php echo $key['harga'] ?></p>
                    <form method="POST" id="formAdd<?php echo $j ?>">
                        <div class="row">
                            <?php
                            $id_customer = $_SESSION['logged']['id'];
                            $query = "SELECT id_barang,jumlah FROM detail_penjualan WHERE id_penjualan = (SELECT id_penjualan FROM penjualan WHERE id_customer = " . $id_customer . " AND penjualan.status = 'Listed')  ORDER BY id_barang";
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
                                <div class="col">
                                    <button class="btn btn-danger" name="hapusCart" type="submit" value="<?php echo $key['id_barang'] ?>"><i class="bi bi-bag-x"></i></button>
                                    <!-- <a href="#" class="form-control btn btn-danger"><i class="bi bi-bag-x"></i></a> -->
                                </div>
                                <div class="input-group w-75">
                                    <input type="hidden" name="stokBrg" value="<?php echo $key['stok'] ?>">
                                    <input type="hidden" name="idBrg" value="<?php echo $arrayDP_id[$index - 1] ?>">
                                    <input type="hidden" name="jmlBrg" value="<?php echo $arrayDP_jml[$index - 1] ?>">
                                    <input type="hidden" id="editInput<?php echo $j ?>" name="editInput" value="<?php echo $arrayDP_jml[$index - 1] ?>">
                                    <button class="input-group-text" name="editJumlah" type="submit" value="-"><i class="bi bi-dash"></i></button>
                                    <input type="number" max="<?php echo $key['stok'] ?>" name="editInputField" id="editInputField<?php echo $j ?>" class="form-control" value="<?php echo $arrayDP_jml[$index - 1] ?>" onchange="editInputDewe(this.value,<?php echo $key['stok'] ?>,<?php echo $j ?>)">
                                    <button class="input-group-text" name="editJumlah" type="submit" value="+"><i class="bi bi-plus"></i></button>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="col">
                                    <?php if($key['stok'] != 0){ ?>
                                    <input type="hidden" name="stokBrg" value="<?php echo $key['stok'] ?>">
                                    <input type="hidden" name="harga" value="<?php echo $key['harga'] ?>">
                                    <button class="form-control btn btn-success" name="addToCart" type="submit" value="<?php echo $key['id_barang'] ?>"><i class="bi bi-bag-plus"></i></button>
                                    <?php } else { ?>
                                    <button class="form-control btn btn-outline-dark" onclick="alert('Stok tidak mencukupi')" type=""><i class="bi bi-bag-fill"></i></button>
                                    <?php } ?>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </form>
                </div>
            </div>
    <?php
    $j++;
        }
    }
    ?>
</section>

<?php include_once "../template/footer.php"  ?>