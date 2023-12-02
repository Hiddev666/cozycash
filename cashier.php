<?php include "config/database.php"?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier | Cozy Cash</title>

    <!-- CSS -->
    <link rel="stylesheet" href="resource/css/cashier.css">
    <!-- Bootstrap -->
    <!-- <link rel="stylesheet" href="bootstrap/bootstrap.min.css"> -->
</head>
<body>

<div class="dropdown-canvas" id="canvas">
    <button id="dropdownhide" onclick="dropdownHide()">x</button>
</div>

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
        <img src="resource/img/burger-menu-svgrepo-com.svg" alt="" onclick="dropdownShow()">
        <!-- <button id="dropdownshow" onclick="dropdownShow()">*</button> -->
        
    </div>
</div>
<!-- Header End -->

<!-- Content Start -->
<div class="content-container">
    <div class="content-left">
        <table>
            <thead>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga Barang</th>
                <th>Jumlah</th>
                <th>Diskon</th>
                <th>Sub Total</th>
            </thead>
            <tbody>
                <tr>
                    <td>0002342</td>
                    <td class="nama-barang">Keripik Peyek</td>
                    <td>Rp.5.000</td>
                    <td style="display: flex; justify-content: space-between; align-items: center;">
                        <button class="btn-decrement">-</button>
                        <p>2</p>
                        <button class="btn-increment">+</button>
                    </td>
                    <td>-</td>
                    <td>Rp.10.000</td>
                </tr>
                <tr>
                    <td>0002342</td>
                    <td class="nama-barang">Keripik Peyek</td>
                    <td>Rp.5.000</td>
                    <td style="display: flex; justify-content: space-between; align-items: center;">
                        <button class="btn-decrement">-</button>
                        <p>2</p>
                        <button class="btn-increment">+</button>
                    </td>
                    <td>-</td>
                    <td>Rp.10.000</td>
                </tr>
                <tr>
                    <td>0002342</td>
                    <td class="nama-barang">Keripik Peyek</td>
                    <td>Rp.5.000</td>
                    <td style="display: flex; justify-content: space-between; align-items: center;">
                        <button class="btn-decrement">-</button>
                        <p>2</p>
                        <button class="btn-increment">+</button>
                    </td>
                    <td>-</td>
                    <td>Rp.10.000</td>
                </tr>
                <tr>
                    <td>0002342</td>
                    <td class="nama-barang">Keripik Peyek</td>
                    <td>Rp.5.000</td>
                    <td style="display: flex; justify-content: space-between; align-items: center;">
                        <button class="btn-decrement">-</button>
                        <p>2</p>
                        <button class="btn-increment">+</button>
                    </td>
                    <td>-</td>
                    <td>Rp.10.000</td>
                </tr>
            </tbody>
        </table>
    </div>



    <div class="content-right">
        <div class="detail-container">
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
                <p class="detail-transaksi-line">-----------------------------------------</p>
                <div class="total-transaksi-wrapper">
                    <p class="total-transaksi-title">Total</p>
                    <p class="total-transaksi">Rp.50.000</p>
                </div>
            </div>

            <div class="detail-forms-outer">
                <div class="detail-forms">
                    <div class="detail-form-wrapper">
                            <div class="form1-wrapper">
                                <form action="">
                                    <div class="kode-barang-input-wrapper">
                                        <p>Kode Barang</p>
                                        <input type="text" class="kode-barang-input" autofocus>
                                    </div>
                                    <div class="jumlah-barang-input-wrapper">
                                        <p>Jumlah</p>
                                        <input type="text" class="jumlah-barang-input">
                                    </div>
                                    <input type="submit" style="visibility: hidden; width: 0;" />
                                </form>
                            </div>
                        </div>
                        
                    <div class="detail-form-wrapper">
                        <div class="form2-wrapper">
                                <form action="">
                                    <div class="tunai-wrapper">
                                        <p>Tunai</p>
                                        <input type="text" class="tunai-input" autofocus>
                                    </div>
                                    <input type="submit" style="visibility: hidden; width: 0;" />
                                </form>
                            </div>
                        </div>
                        <div class="detail-forms-btn-wrapper">
                            <button onclick="test()">Bayar</button>
                        </div>
                    </div>
            </div>
            </div>
        </div>
</div>
</div>
<!-- Content End -->

<!-- JavaScript -->
<script src="bootstrap/bootstrap.bundle.min.js"></script>
<script src="jquery-3.3.1.min.js"></script>
<script src="sweetalert.min.js"></script>
<script src="js/cashier.js"></script>

</body>
</html>