<?php
echo "logout";

include_once "../config/config.php";

session_start();
session_destroy();
session_destroy();

header("location: " . $address);
