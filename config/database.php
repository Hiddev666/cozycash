<?php

$server = "localhost";
$username = "root";
$password = "";
$db_name = "cozycash";

$conn = mysqli_connect($server, $username, $password, $db_name);


if(!$conn) {
    echo "connection failed";
}

?>