<?php
    //require("requete.php");
    $_SESSION["modif_patient"] = "false";
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pannel Admin</title>
</head>
<body>
    <section>
        <h1>Secrétaire</h1>

        <form action="../Formulaire/requete.php" method="POST">
            <input type="text" name="numSecuPatient" placeholder="Entrez le numéro de sécurité social du patient">
            <input type="submit" value="Modifier un patient" name="modif">
        </form>
        <br>
        <form action="../Formulaire/requete.php" method="POST">
            <input type="submit" value="Ajouter un patient" name="add">
        </form>
    </section>
</body>
</html>