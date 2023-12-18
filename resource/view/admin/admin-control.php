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

function checkLastStats($month) {
    if($_POST['stats'] == $month) {
        return "selected";
    }    
}

?>