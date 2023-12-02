<?php

$env = parse_ini_file("../.env");

$conn = mysqli_connect(
    $env["DB_SERVER"],
    $env["DB_USERNAME"],
    $env["DB_PASSWORD"],
    $env["DB_NAME"],
);

if(!$conn) {
    echo "Database Connection Error!";
    die();
}

?>