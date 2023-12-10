<?php


class Cashier {
    
    public function bayar() {
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

        // Redirect
        // if (isset($_SERVER["HTTP_REFERER"])) {
        //     header("Location: " . $_SERVER["HTTP_REFERER"]);
        // }
    
    }

}

?>