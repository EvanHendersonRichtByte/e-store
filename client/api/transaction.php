<?php
include_once "../../config/connect.php";

$type = $_POST['Type'];
if ($type === 'Create') {
    $id_penjualan = null;
    $id_barang = $_POST['id_barang'];
    $id_customer = $_POST['id_customer'];
    $harga = $_POST['harga'];
    $query = "SELECT id_penjualan FROM penjualan WHERE id_customer = $id_customer AND status = 'Listed' AND id_petugas IS NULL LIMIT 1";
    $data = $mysqli->query($query);
    if ($data->num_rows > 0) {
        $id_penjualan = $data->fetch_array()["id_penjualan"];
        $query = "SELECT dp.id_detail_penjualan, dp.jumlah, dp.total FROM detail_penjualan dp JOIN penjualan p WHERE id_barang = $id_barang AND dp.id_penjualan = $id_penjualan AND p.status = 'Listed'";
        if ($mysqli->query($query)->num_rows > 0) {
            $existingData = $mysqli->query($query) or die($mysqli->error);
            $existingData = $existingData->fetch_array();
            $id_detail_penjualan = $existingData['id_detail_penjualan'];
            $jumlah = $existingData['jumlah'] + 1;
            $total = $existingData['total'] + $harga;
            $query = "UPDATE detail_penjualan SET jumlah = $jumlah, total = $total WHERE id_detail_penjualan = $id_detail_penjualan";
            $mysqli->query($query) or die($mysqli->error);
        } else {
            $query = "INSERT INTO detail_penjualan SET id_penjualan = $id_penjualan, id_barang = $id_barang, jumlah = 1, total = " . $harga;
            if ($mysqli->query($query) or die($mysqli->error)) return;
        }
    } else {
        $query = "INSERT INTO penjualan SET id_customer = $id_customer, id_petugas = NULL";
        if ($mysqli->query($query)) {
            $query = "SELECT id_penjualan FROM penjualan WHERE id_customer = $id_customer AND status = 'Listed' AND id_petugas IS NULL LIMIT 1";
            $id_penjualan = $mysqli->query($query)->fetch_array()["id_penjualan"];
            $query = "INSERT INTO detail_penjualan SET id_penjualan = $id_penjualan, id_barang = $id_barang, jumlah = 1, total = " . $harga;
            if ($mysqli->query($query) or die($mysqli->error)) return;
        }
    }
} else if ($type == "ModifyQty") {
    $id_customer = $_POST['id_customer'];
    $id_penjualan = $_POST['id_penjualan'];
    $id_detail_penjualan = $_POST['id_detail_penjualan'];
    $id_barang = $_POST['id_barang'];
    $harga = $_POST['harga'];
    $qty = $_POST['qty'];
    $hargaTotal = $qty * $harga;
    // $query = "SELECT * FROM penjualan p JOIN detail_penjualan dp ON p.id_penjualan = dp.id_penjualan WHERE p.id_customer = $id_customer";
    // $mysqli->query($query) or die($mysqli->error);
    if (!$id_penjualan) {
        $query = "INSERT INTO penjualan SET id_customer = $id_customer";
        $data = $mysqli->query($query) or die($mysqli->error);
        if ($data) {
            $query = "SELECT id_penjualan FROM penjualan WHERE id_customer = $id_customer";
            $id_penjualan = $mysqli->query($query)->fetch_assoc()['id_penjualan'];
            echo "New Transaction Created";
        }
    } else {
        $query = "SELECT * FROM detail_penjualan WHERE id_detail_penjualan = $id_detail_penjualan AND id_barang = $id_barang";
        $data = $mysqli->query($query);
        if ($data) {
            if ($data->num_rows > 0){
                $query = "SELECT * FROM barang WHERE id_barang = $id_barang";
                $stk = $mysqli->query($query)->fetch_assoc()['stok'];
                if ($qty > 0 && $qty <= $stk) {
                    $query = "UPDATE detail_penjualan SET jumlah = $qty, total = $hargaTotal WHERE id_detail_penjualan = $id_detail_penjualan";
                    $mysqli->query($query) or die($mysqli->error);
                    echo "Qty Updated";
                } else if ($qty > $stk || $qty < 0) {
                    echo "False Qty";
                } else {
                    $query = "DELETE FROM detail_penjualan WHERE id_detail_penjualan = $id_detail_penjualan";
                    $mysqli->query($query) or die($mysqli->error);
                    echo "Delete Performed";
                }
            }
        } else {
            $query = "INSERT INTO detail_penjualan SET id_penjualan = $id_penjualan, id_barang = $id_barang, jumlah = $qty, total = $hargaTotal";
            $mysqli->query($query) or die($mysqli->error);
            echo "New Data Created";
        }
    }
} else if($type == "DeleteCarto"){
    $id_detail_penjualan = $_POST['id_detail_penjualan'];
    $query = "DELETE FROM detail_penjualan WHERE id_detail_penjualan = $id_detail_penjualan";
    $mysqli->query($query) or die($mysqli->error);
    echo "Delete Performed";
}
