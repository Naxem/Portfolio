<?php
$_SESSION["auth"] = 0;
$_SESSION["id"] = 0;
session_destroy();
header("location: login?conexion=1");
?>