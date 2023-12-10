<?php

include("../../../config/database.php");

$invoice_id = $_GET['invoice_id'];
$product_id = $_GET['product_id'];

$query = "INSERT INTO sales (invoice_id, product_id) VALUES ($invoice_id, $product_id);";
$sql = mysqli_query($conn, $query);

$querySearchQty = "SELECT * FROM products where product_id='$product_id'";
$querySearchQtyExecute = mysqli_query($conn, $querySearchQty);
$querySearchQtyArr = mysqli_fetch_array($querySearchQtyExecute);    
$currentQty = $querySearchQtyArr['unit_in_stock'] - 1;
echo $currentQty;

$query2 = "UPDATE products set unit_in_stock='$currentQty' where product_id='$product_id'";
$query2Execute = mysqli_query($conn, $query2);

header("location: cashier.php");

?>