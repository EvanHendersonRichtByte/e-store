<?php
require_once "../config/connect.php";
session_start();
$sql;
if (isset($_GET['id_customer'])) {
    $sql = "SELECT imageType,imageData FROM customer WHERE id_customer = " . $_SESSION['logged']['id'] . " LIMIT 1";
} else if (isset($_GET['id_petugas'])) {
    $sql = "SELECT imageType,imageData FROM petugas WHERE id_petugas =" . $_SESSION['logged']['id'] . " LIMIT 1";
}
$result = $mysqli->query($sql);
$row = $result->fetch_array();
header("Content-type: " . $row["imageType"]);
if ($row["imageData"]) {
    echo $row["imageData"];
} else {
    echo file_get_contents("$address/assets/static_images/dummy.png");
}

$mysqli->close();
