<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Cozy Cash</title>

    <!-- Style -->
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    
<!-- Header Start -->
<div class="header-container">
    <div class="header-left">
        <img src="../img/logo.svg" alt="">
    </div>
</div>
<!-- Header End -->

<div class="container">
    <div class="left-container">
        <img src="../img/cashier-illustration.jpeg" alt="">
    </div>
    <div class="right-container">
        <div class="login-form-wrapper">
            <h1>Login.</h1>
            <?php
            
            if(isset($_SESSION['login-error'])) {
            ?>

            <p class="login-alert"><?= $_SESSION['login-error']?></p>

            <?php }?>
            <form action="login-control.php" method="POST">
                <p>Username</p>
                <input type="text" class="username-input" name="username" autofocus>
                <p>Password</p>
                <input type="password" class="password-input" name="password">
                <button type="submit" name="btn-bayar">Login</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>