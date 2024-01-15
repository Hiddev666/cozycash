<?php 
include "admin-control.php";
session_start();

checkAuth();
withoutParamsRedirect()


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= setPageTitle()?></title>

    <!-- Style -->
    <link rel="stylesheet" href="../../css/admin.css">
</head>
<body>

<div class="admin-container">
    <div class="admin-left">
        <?= include "components/sidebar.php"?>
    </div>
    <div class="admin-right">
        <?= 
            activePage();
        ?>
    </div>

</div>
<!-- Sidebar -->



<script src="admin.js"></script>

</body>
</html>