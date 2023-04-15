<?php
    require("requetes.php");
    if(empty($_SESSION["id"])) {
        $_SESSION["status"] = "Vous n'etes pas autorize !";
        header("Location: login?conexion=1");
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Visiteur</title>
</head>
<body>
    
</body>
</html>