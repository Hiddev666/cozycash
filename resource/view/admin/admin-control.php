<?php

function setPageTitle() {
    $page = ucwords($_GET['page']);
    return $page . " | Cozy Cash Admin";
}

function withoutParamsRedirect() {
    if(!isset($_GET['page'])) {
        header("Location: ?page=dashboard");
    }
}

function activePage() {
    $adminPage = $_GET['page'];
    include "pages/" . $adminPage . ".php";
}

function setActivePage($page) {
    if($_GET['page'] == $page) {
        echo "-active";
    }
}

function setActiveStats($stats) {
    if($_GET['statstype'] == $stats) {
        echo "-active";
    }
}

function checkLastStats($month) {
    if($_POST['stats'] == $month) {
        return "selected";
    }    
}

function checkLastStatsYear($year) {
    if($_POST['statsyear'] == $year) {
        return "selected";
    }    
}

function checkAuth() {
    $role = $_SESSION['role-login'];

    if($role != "admin") {
        header("Location: ../err/not-permitted.php");
    }
}

function logout() {
    session_destroy();
    header("Location: login.php");
}

?>