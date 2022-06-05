<?php

include_once "../config/connect.php";


function pageAuth($address)
{
    include_once "../config/config.php";
    session_start();
    if (isset($_SESSION['logged'])) {
    } else {
        header("location: " . $address . "/client/login.php");
    }
}

if (isset($_POST['client__login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $query = "SELECT * FROM customer WHERE username = '$username' AND password = '$password'";
    $data = $mysqli->query($query);
    if ($data) {
        $data = $data->fetch_assoc();
        session_start();
        $_SESSION['logged'] = ['id' => $data['id_customer'], 'username' => $data['username'], 'password' => $data['password'], 'email' => $data['email'], 'alamat' => $data['alamat'], 'tgl_lahir' => $data['tgl_lahir']];
        header("location: " . $address . "/client");
    } else {
        echo "Data tidak ditemukan";
    }
}
