<?php
include_once "./config/connect.php";
session_start();

if (isset($_SESSION['logged'])) {
    $username = $_SESSION['logged']['username'];
    $password = $_SESSION['logged']['password'];
    if (isset($_SESSION['logged'])) {
        $query = "SELECT * FROM customer WHERE username = $username, password = $password";
        if ($mysqli->query($query)) {
            header("location: " . $address . "/client/");
        } else {
            $query = "SELECT * FROM petugas WHERE username = $username, password = $password";
            if ($mysqli->query($query)) {
                header("location: " . $address . "/admin/");
            }
        }
    }
} else {
    header("location: " . $address . "/client/login.php");
}
