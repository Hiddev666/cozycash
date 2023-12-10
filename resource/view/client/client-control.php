<?php

require_once('control/cashier-control.php');

$cashier = new Cashier();

if(isset($_GET['btn-bayar'])) {
    include "../../../config/database.php";
    $cashier->bayar();
}

?>