<?php

if (isset($_POST['client__login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $query = "SELECT * FROM customer WHERE username = '$username', password = '$password'";
    echo $query;
    if ($query) {
        echo "Data ditemukan";
        session_start();
        $_SESSION['logged'] = ['username' => $username, 'password' => $password];
        var_dump($_SESSION);
        session_abort();
    } else {
        echo "Data tidak ditemukan";
    }
}
