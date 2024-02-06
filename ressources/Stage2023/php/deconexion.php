<?php
session_destroy();
$_SESSION["auth"] = 0;
header("location: login");
?>