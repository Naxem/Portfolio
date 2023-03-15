<?php
    require("requette_ad.php");

    //$_SESSION["modif_patient"] = false;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un patient</title>
</head>
<body>
<?php
    if ($_SESSION["update_patient"] == true) {
?>
    <form action="requette_ad.php" method="post">
        <p>Le patient a bien été modifier</p>
        <input type="submit" value="retoure a la page principale" name="retoure">
        <input type="submit" value="Modifier un autre patient" name="newmodif">
    </form>
<?php
    }
    elseif ($_SESSION["update_patient"] == false) {
?>
    <form action="requette_ad.php" method="post">
        <input type="text" name="numSecuPatient" placeholder="Entrez le numéro de sécurité social du patient">
        <input type="submit" value="Modifier" name="modif">
    </form>
<?php
    } else {
        echo "error";
    }
    //} //end $_session uptade
?>
</body>
</html>