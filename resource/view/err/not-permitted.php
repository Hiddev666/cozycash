<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>asd</title>

    <link rel="stylesheet" href="../../css/err.css">
</head>
<body>
    
    
    <div class="err-container">
        <div class="not-permitted-container">
            <img src="../../img/notpermitted.jpeg" alt="">
            <h1>Upss! You dont have permission!</h1>

            <?php
            
            session_start();

            $role = $_SESSION['role-login'];

            $btnText = "Login Now";
            $url = "../login.php";
            echo $role;

            if($role == "admin") {
                $url = "../admin/admin.php";
                $btnText = "Back to Admin Page";
            } elseif ($role == "Kasir") {
                $url = "../client/cashier.php";
                $btnText = "Back to Cashier Page";
            }
            
            ?>

            <a href="<?= $url?>"><p><?= $btnText?></p></a>
        </div>
    </div>

</body>
</html>