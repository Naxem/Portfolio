<?php
    require("requete.php");
    $_SESSION["modif_patient"] = "false";
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/secretaire.css">
    <title>Pannel Secrétaire</title>
</head>
<body>
    <section class="section-main">
        <h1>Secrétaire</h1>

        <form action="../Formulaire/requete.php" method="POST">
            <input class="text" type="text" name="numSecuPatient" placeholder="Entrez le numéro de sécurité social du patient">
            <input class="btnModif" type="submit" value="Modifier un patient" name="modif">
        </form>
        <br>
        <form action="../Formulaire/requete.php" method="POST">
            <input class="btnadd" type="submit" value="Ajouter un patient" name="add">
        </form>
    </section>

    <section>
        <h1>Données de la semaine</h1>
            <form method="post" action="genPDF.php" target="blank">
                <input type="date" name="date">
                <input type="submit" value="Générer un PDF">
            </form>
    </section>
</body>
<script src="../JS/inactif.js"></script>
</html>