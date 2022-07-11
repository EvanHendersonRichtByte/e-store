<?php
require_once "../config/connect.php";
session_start();
$sql;
if (isset($_GET['id_customer'])) {
    $sql = "SELECT imageType,imageData FROM customer WHERE id_customer = " . $_GET['id_customer'] . " LIMIT 1";
} else if (isset($_GET['id_petugas'])) {
    $sql = "SELECT imageType,imageData FROM petugas WHERE id_petugas =" . $_GET['id_petugas'] . " LIMIT 1";
} else if (isset($_GET['id_barang'])) {
    $sql = "SELECT imageType,imageData FROM barang WHERE id_barang =" . $_GET['id_barang'] . " LIMIT 1";
}
$result = $mysqli->query($sql);
$row = $result->fetch_array();
header("Content-type: " . $row["imageType"]);
if ($row["imageData"]) {
    echo $row["imageData"];
    $imageType = $key['imageType'];
    $imageData = base64_encode($key['imageData']);
    echo "data:$imageType;base64,$imageData";
} else {
    echo file_get_contents("$address/assets/static_images/dummy.png");
}

$mysqli->close();
