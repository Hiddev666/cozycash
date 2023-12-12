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

    public function inputProduct($invoiceid, $productcode, $count) {
        session_start();
        include "../../../config/database.php";

        $queryProduct = mysqli_query($conn, "SELECT * FROM products WHERE product_code='$productcode';");
        $queryProductArray = mysqli_fetch_array($queryProduct);
        if(mysqli_num_rows($queryProduct) != 0) {
            $defaultcount = 1;
            for($defaultcount; $defaultcount <= $count; $defaultcount++) {
                $timestamp = date("ymd");
                $stmt = mysqli_prepare($conn, "INSERT INTO sales VALUES (?, ?, ?, ?)");
                
                $sales_id = NULL;
                $invoice_id = (int)$invoiceid;
                $product_id = (int)$queryProductArray['product_id'];
                $date_recorded = NULL;

                mysqli_stmt_bind_param($stmt, "ssss", $sales_id, $invoice_id, $product_id, $date_recorded);                
                
                mysqli_stmt_execute($stmt);
                var_dump($sales_id);
                var_dump($invoice_id);
                var_dump($product_id);
            }
            header("Location: cashier.php");
        } else {
            echo "PRODUCT CODE IS INVALID, TRY TO RE-SCAN THE CODE!";
        }
    }

    public function isLogin() {
        session_start();
        if(!isset($_SESSION['username-login'])) {
            header("Location: ../login.php");
        }
    }

}

?>