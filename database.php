<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "my_login_register";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("Something went wrong;");
}

?>