<?php
require_once("../connexion_BDD.php");

function affichage_patient(){
    $pdo = connexion_bdd();
    $stmt = $pdo->query("SELECT patients.NomNaissance, patients.PrenomPatient, patients.TelPatient,hospi.DateHospi, hospi.HeureHospi FROM patients INNER JOIN couverturesociale on patients.NumSecu = couverturesociale.NumSecu INNER JOIN hospi ON couverturesociale.NumSecu = hospi.NumSecu;");
    while ($row = $stmt->fetch()){
        echo $row['NomNaissance'];
        echo $row['PrenomPatient'];
        echo $row['TelPatient'];
        echo $row['DateHospi'];
        echo $row['HeureHospi'];
        echo "<br>";
    }
}
?>


<html>
<p></p>
</html>