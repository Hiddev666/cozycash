<?php
session_start();
include "../../../config/database.php";

$invoice_id = (int)$_SESSION['invoice_id'];

$rows = mysqli_query($conn, "SELECT sales.sales_id, invoices.invoice_id, products.product_id, products.product_code, products.product_name, products.unit_price, products.discount_percentage, COUNT(products.product_code) as quantity, SUM(products.unit_price) as subtotal, CEILING(SUM(products.unit_price) - products.discount_percentage*SUM(products.unit_price)) as discounted FROM products INNER JOIN sales ON sales.product_id = products.product_id INNER JOIN invoices ON invoices.invoice_id = sales.invoice_id WHERE invoices.invoice_id=$invoice_id GROUP BY products.product_code order by sales.sales_id DESC;");
$discounted = 0;
foreach($rows as $row) {
    $discounted += $row['discounted'];
}

$tunai = $_SESSION['tunai'];
$tunaiFormated = "Rp " . number_format($tunai,0,',','.'); 

$kembalian = (int)$tunai - (int)$discounted;
$splitKembalian = str_split($kembalian, 1);

$kembalianFormated = "Rp " . number_format($kembalian,0,',','.'); 

$discountedFormated = "Rp " . number_format($discounted,0,',','.');

?>
<div class="detail-transaksi-wrapper">
                <div class="header-detail">
                    <h3>Transaksi</h3>
                </div>
                <div class="kode-transaksi-wrapper">
                    <p class="kode-transaksi-title">Kode Transaksi</p>
                    <p class="kode-transaksi"><?= $invoice_id?></p>
                </div>
                <div class="kode-transaksi-wrapper">
                    <p class="kode-transaksi-title">Tunai</p>
                    <p class="kode-transaksi"><?= $tunaiFormated?></p>
                </div>
                <div class="kode-transaksi-wrapper">
                    <p class="kode-transaksi-title">Kembalian</p>
                    <p class="kode-transaksi"><?php
                    
                    if($splitKembalian[0] == "-") {
                        echo "* Uang Kurang ";
                    }
                    
                    echo  $kembalianFormated;
                    ?></p>
                </div>
                <p class="detail-transaksi-line">-----------------------------------------</p>
                <div class="total-transaksi-wrapper">
                    <p class="total-transaksi-title">Total</p>
                    <p class="total-transaksi"><?= $discountedFormated?></p>
                </div>
            </div>
        