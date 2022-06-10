<?php include_once "../template/header.php"  ?>

<?php include "../components/client_dashboard_navbar.php" ?>
<section class="client--dashboard">
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
        if(($_POST['stokBrg'] > $_POST['jmlBrg'] && $_POST['jmlBrg'] > 0) || ($_POST['jmlBrg'] == 10 && $_POST['editJumlah'] == "-")){
            $id_customer = $_SESSION['logged']['id'];
            $id_barang = $_POST['idBrg'];
            $opr = $_POST['editJumlah'];
            if($_POST['jmlBrg'] == 1 && $_POST['editJumlah'] == "-"){
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
            <div class="card">
                <div class="image">
                    <img src=<?php echo $key['image'] ? $key['image'] : "../assets/static_images/dummy.png" ?> alt="dummy">
                </div>
                <div class="details">
                    <a href="<?php echo $address ?>/client/item.php" class="title"><?php echo $key['nama_barang'] ?></a>
                    <p class="description"><?php echo $key['deskripsi'] ?></p>
                    <p class="stock">Stok: <?php echo $key['stok'] ?></p>
                    <p class="price">Rp. <?php echo $key['harga'] ?></p>
                </div>
                <form action="" method="POST">
                    <input type="hidden" name="harga" value="<?php echo $key['harga'] ?>">
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
                    if ($dataDP->num_rows > 0) {
                        $bool = false;
                        for ($i = 1; $i <= $dataDP->num_rows; $i++) {
                            if ($arrayDP_id[$i - 1] == $key['id_barang']) {
                                $index = $i;
                                $bool = true;
                            }
                        }
                        if ($bool == true) {
                            ?>
                            <div class="jumlah">
                                <input type="hidden" name="stokBrg" value="<?php echo $key['stok'] ?>">
                                <input type="hidden" name="idBrg" value="<?php echo $arrayDP_id[$index - 1] ?>">
                                <input type="hidden" name="jmlBrg" value="<?php echo $arrayDP_jml[$index - 1] ?>">
                                <button class="btn-jumlah" name="editJumlah" type="submit" value="-">-</button>
                                <h2><?php echo $arrayDP_jml[$index - 1] ?></h2>
                                <button class="btn-jumlah" name="editJumlah" type="submit" value="+">+</button>
                            </div>
                            <div class="add">
                                <button class="btn-secondary">Terpilih</button>
                            <?php
                        } else {
                            echo "<button class=" . "btn-secondary" . " name=" . "addToCart" . " value=" . $key['id_barang'] . " type=" . "submit" . ">Add</button>";
                        }
                    } else {
                        echo "<button class=" . "btn-secondary" . " name=" . "addToCart" . " value=" . $key['id_barang'] . " type=" . "submit" . ">Add</button>";
                    }
                    ?>
                    <!-- <button class="btn-secondary" name="addToCart" value="<?php //echo $key['id_barang'] 
                                                                                ?>" type="submit">Add</button> -->
                            </div>
                </form>

            </div>
    <?php
        }
    }
    ?>
</section>

<?php include_once "../template/footer.php"  ?>