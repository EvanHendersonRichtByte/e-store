<?php
include_once "./config/connect.php";
session_start();
if (isset($_SESSION['logged'])) {
    $username = $_SESSION['logged']['username'];
    $password = $_SESSION['logged']['password'];
    $query = "SELECT * FROM customer WHERE username = $username, password = $password";
    $data = $mysqli->query($query);
    if ($data) {
        header("location: " . $address . "/client/");
    } else {
        $query = "SELECT * FROM petugas WHERE username = $username, password = $password";
        $data = $mysqli->query($query);
        if ($data) {
            header("location: " . $address . "/admin/");
        }
    }
} else {
    header("location: " . $address . "/client/login.php");
}
