<?php
$_SESSION["idRole"] = 0;
$_SESSION["status"] = 0;
session_destroy();
header("Location: login.php");
?>