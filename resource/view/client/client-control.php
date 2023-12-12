<?php

require_once('control/cashier-control.php');
session_start();

$cashier = new Cashier();

if(isset($_POST['btn-bayar'])) {
    include "../../../config/database.php";
    $cashier->bayar();
}

if(isset($_POST['kode-barang'])) {
    include "../../../config/database.php";

    $invoiceid = $_SESSION['invoice_id'];
    $productcode = $_POST['kode-barang'];
    $count = $_POST['jumlah-barang'];

    if($count == "") {
        $count = 1;
    }

    $cashier->inputProduct($invoiceid, $productcode, $count);
}

?>