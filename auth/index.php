<?php

include_once "../config/connect.php";

// global $mysqli2;
// $mysqli2 = $mysqli;

function checkUser()
{
    session_start();
    if (isset($_SESSION['logged'])) {
        if ($_SESSION['logged']['role'] !== 'Customer') {
            header("location: {$GLOBALS['address']}/admin/");
        }
    } else {
        header("location: {$GLOBALS['address']}/client/login.php");
    }
}

function checkAdmin()
{
    session_start();
    if (isset($_SESSION['logged'])) {
        if ($_SESSION['logged']['role'] !== 'Admin') {
            header("location: {$GLOBALS['address']}/client/");
        }
    } else {
        header("location: {$GLOBALS['address']}/client/login.php");
    }
}

if (isset($_POST['client-login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $query = "SELECT * FROM customer WHERE username = '$username' AND password = '$password'";
    $data = $mysqli->query($query);
    if ($data->num_rows > 0) {
        $data = $data->fetch_assoc();
        session_start();
        $_SESSION['logged'] = ['role' => 'Customer', 'id' => $data['id_customer'], 'email' => $data['email'], 'username' => $data['username'], 'password' => $data['password'], 'image' => $data['imageData'], 'alamat' => $data['alamat'], 'tgl_lahir' => $data['tgl_lahir']];
        header("location: " . $address . "/client");
    } else {
        header("location: " . $address . "/client/login.php?msg=404user");
    }
} else if (isset($_POST['admin-login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $query = "SELECT * FROM petugas WHERE username = '$username' AND password = '$password'";
    $data = $mysqli->query($query);
    if ($data->num_rows > 0) {
        $data = $data->fetch_assoc();
        session_start();
        $_SESSION['logged'] = ['role' => 'Admin', 'id' => $data['id_petugas'], 'email' => $data['email'], 'username' => $data['username'], 'password' => $data['password'], 'image' => $data['imageData'], 'alamat' => $data['alamat'], 'tgl_lahir' => $data['tgl_lahir']];
        header("location: " . $address . "/admin");
    } else {
        header("location: " . $address . "/admin/login.php?msg=404user");
    }
}
