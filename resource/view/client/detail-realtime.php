<?php
session_start();
include "../../../config/database.php";

$invoice_id = $_SESSION['invoice_id'];

$totalQuery = mysqli_query($conn, "SELECT SUM(products.unit_price) as total FROM cozycash.products inner join cozycash.sales on products.product_id = sales.product_id inner join cozycash.invoices on sales.invoice_id = invoices.invoice_id where invoices.invoice_id=1;");
$total ="Rp " . number_format(mysqli_fetch_column($totalQuery),2,',','.');

?>
<div class="detail-transaksi-wrapper">
                <div class="header-detail">
                    <h3>Transaksi</h3>
                    <div class="time-wrapper">
                    <p id="date">ads</p>
                    <p class="time" id="time">00:00:00</p>
                    </div>
                </div>
                <div class="kode-transaksi-wrapper">
                    <p class="kode-transaksi-title">Kode Transaksi</p>
                    <p class="kode-transaksi"><?= $invoice_id?></p>
                </div>
                <div class="kode-transaksi-wrapper">
                    <p class="kode-transaksi-title">Tunai</p>
                    <p class="kode-transaksi">Rp.100.000</p>
                </div>
                <div class="kode-transaksi-wrapper">
                    <p class="kode-transaksi-title">Kembalian</p>
                    <p class="kode-transaksi">Rp.50.000</p>
                </div>
                <p class="detail-transaksi-line">-----------------------------------------</p>
                <div class="total-transaksi-wrapper">
                    <p class="total-transaksi-title">Total</p>
                    <p class="total-transaksi"><?= $total?></p>
                </div>
            </div>
        