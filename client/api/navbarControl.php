<?php
include_once "../../config/connect.php";

if ($_POST['Update']) {
    $id_customer = $_POST['Update'];
    $query = "SELECT COUNT(*) 'item' FROM detail_penjualan dp JOIN penjualan p ON dp.id_penjualan = p.id_penjualan WHERE p.id_customer = 4 AND p.status = 'Listed' GROUP BY dp.id_penjualan;";
    $data = $mysqli->query($query) or die($mysqli->error);
    if ($data) {
        echo $data->fetch_array()['item'];
    }
}
