<?php 
include "../../../config/database.php";
session_start();

// if(!isset($_SESSION['username'])) {
//     header("Location: ../login.php");
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier | Cozy Cash</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../../css/cashier.css">
    <!-- Bootstrap -->
    <!-- <link rel="stylesheet" href="bootstrap/bootstrap.min.css"> -->
</head>
<body>

<div class="dropdown-canvas" id="canvas">
    <div class="dropdown-header-right-wrapper">
        <button id="dropdownhide" onclick="dropdownHide()" class="btn-dropdown-close">x</button>
        <div>
            <p class="header-name">Wahid Abdul</p>
            <p class="header-role">Kasir</p>
        </div>
    </div>
    <button class="btn-logout" onclick="logoutConfirm()">Logout</button>
</div>

<!-- Header Start -->
<div class="header-container">
    <div class="header-left">
        <img src="../../img/logo.svg" alt="">
    </div>
    <div class="header-right">
        <div class="header-right-wrapper">
            <p class="header-name"><?= $_SESSION['username-login']?></p>
            <p class="header-role"><?= $_SESSION['role-login']?></p>
        </div>
        <img src="../../img/burger-menu-svgrepo-com.svg" alt="" onclick="dropdownShow()">
        <!-- <button id="dropdownshow" onclick="dropdownShow()">*</button> -->
        
    </div>
</div>
<!-- Header End -->

<!-- Content Start -->
<div class="content-container">
    <div class="content-left">
    <div id="table"></div>
</div>



    <div class="content-right">
        <div class="detail-container">

        <div id="detail-realtime">

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
                            <form action="client-control.php" method="GET">
                                <button onclick="test()" type="submit" name="btn-bayar">Bayar</button>
                            </form>
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
<script src="../../../js/jquery-3.3.1.min.js"></script>
<script src="../../../js/sweetalert.min.js"></script>
<script src="../../../js/cashier.js"></script>

</body>
</html>