<?php
    require('config.php');
    $date = date('d-m-y h:i:s');

    if ($_POST['nameImg'] == '' or $_POST['nameImg'] == ' ') {
        echo "Veuillez entrer un nom d'image";
    }
    else {
        if (isset($_POST['tattooS'])) {
            $tattooS = 1;
        }
        else {
            $tattooS = 0;
        }

        if (isset($_POST['tattooY'])) {
            $tattooY = 1;
        }
        else {
            $tattooY = 0;
        }

        if (isset($_POST['piercing'])) {
            $piercing = 1;
        }
        else {
            $piercing = 0;
        }
        if (isset($_POST['dermoRepa'])) {
            $dermoRepa = 1;
        }
        else {
            $dermoRepa = 0;
        }

        $pdo = connexion_bdd();
        $req = $pdo->prepare('INSERT INTO `images` (`name`, `tattooS`, `piercing`, `dermoRepa`, `date`, `tattooY`) VALUES (:name, :tattooS, :piercing, :dermoRepa, :date, :tattooY)');
        $req->execute(array(
            'name' => $_POST['nameImg'],
            'tattooS' => $tattooS,
            'piercing' => $piercing,
            'dermoRepa' => $dermoRepa,
            'date' => $date,
            'tattooY' => $tattooY,
        ));
        echo "L'image a bien été ajoutée";
    }
?>