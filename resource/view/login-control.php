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

        session_start();
        include "../../../config/database.php";
        $timestamp = date("ymd");
        $stmt = mysqli_prepare($conn, "INSERT INTO invoices VALUES (?, ?, ?)");

        $invoice_id = NULL;
        $total_amount = 0;
        $date_recorded = $timestamp;
        
        mysqli_stmt_bind_param($stmt, "sss", $invoice_id, $total_amount, $date_recorded);
        
        mysqli_stmt_execute($stmt);
        
        $invoiceIdQuery = mysqli_query($conn, "SELECT * FROM invoices ORDER BY invoice_id DESC");
        $invoiceIdArray = mysqli_fetch_array($invoiceIdQuery);
        $_SESSION['invoice_id'] = $invoiceIdArray['invoice_id'];

        if(isset($_SESSION['tunai'])) {
            unset($_SESSION['tunai']);
        }

        header("Location: client/cashier.php");
    } else {
        header("Location: admin/admin.php");
    }

} else {
    $_SESSION['login-error'] = "Username or Password not Found";
    header("Location: login.php");
}

?>