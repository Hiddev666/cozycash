<?php
include "../../config/database.php";
session_start();

$username = $_POST['username'];
$password = md5($_POST['password']);

$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' && password='$password';");
$queryArray = mysqli_fetch_array($query);
$numrows = mysqli_num_rows($query);

if($numrows != 0) {
    if(isset($_SESSION['login-error'])) {
        unset($_SESSION['login-error']);
    }

    $_SESSION['username-login'] = $queryArray['username'];
    $_SESSION['role-login'] = $queryArray['role'];

    if($queryArray['role'] == "Kasir") {
        header("Location: client/cashier.php");
    } else {
        header("Location: admin/admin.php");
    }

} else {
    $_SESSION['login-error'] = "Username or Password not Found";
    header("Location: login.php");
}

?>