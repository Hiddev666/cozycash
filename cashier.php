<?php include "config/database.php"?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier | Cozy Cash</title>

    <!-- CSS -->
    <link rel="stylesheet" href="resource/css/cashier.css">
</head>
<body>

<!-- Header Start -->
<div class="header-container">
    <div class="header-left">
        <img src="resource/img/logo.svg" alt="">
    </div>
    <div class="header-right">
        <div class="header-right-wrapper">
            <p class="header-name">Wahid Abdul</p>
            <p class="header-role">Kasir</p>
        </div>
    </div>
</div>
<!-- Header End -->

<!-- Content Start -->
<div class="content-container">
    <div class="content-left">
        <p>l</p>
    </div>
    <div class="content-right">
        <div class="detail-container">
            <h3>Transaksi</h3>
            <div class="detail-transaksi-wrapper">
                <div class="kode-transaksi-wrapper">
                    <p class="kode-transaksi-title">Kode Transaksi</p>
                    <p class="kode-transaksi">00012</p>
                </div>
                <div class="kode-transaksi-wrapper">
                    <p class="kode-transaksi-title">Tunai</p>
                    <p class="kode-transaksi">Rp.100.000</p>
                </div>
                <div class="kode-transaksi-wrapper">
                    <p class="kode-transaksi-title">Kembalian</p>
                    <p class="kode-transaksi">Rp.50.000</p>
                </div>
                <p class="detail-transaksi-line">-------------------------------------------</p>
                <div class="total-transaksi-wrapper">
                    <p class="total-transaksi-title">Total</p>
                    <p class="total-transaksi">Rp.50.000</p>
                </div>
            </div>
            <div class="detail-forms">
                <div class="detail-form-wrapper">
                    <div>
                        <div class="form1-wrapper">
                            <form action="">
                                <input type="text" class="kode-barang-input">
                                <input type="number" class="jumlah-barang-input">
                            </form>
                        </div>
                        <div class="form2-wrapper">
                            
                            </div>
                        </div>
                </div>
                <div class="detail-forms-btn-wrapper">
                    <button>Bayar</button>
                </div>
            </div>
        </div>
</div>
</div>
<!-- Content End -->

</body>
</html>