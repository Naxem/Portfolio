<?php
session_start();

    if($_SESSION["auth"] == 1) {
        require("requette.php");
        supp_produit($_GET["produit"]);
        header('Location: admin.php');
        exit();
    }else {
        header("location: admin");
    }
?>