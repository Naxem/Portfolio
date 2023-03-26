<?php
require("requete.php");

$dateUser = $_POST["date"];
$date = $dateUser;

// Convertir la date en objet DateTime
$datetime = new DateTime($date);

// Trouver le jour de la semaine correspondant à cette date (0 = dimanche, 6 = samedi)
$dayOfWeek = $datetime->format('w');

// Déterminer le début de la semaine correspondante à cette date
$weekStart = clone $datetime;
$weekStart->modify("-{$dayOfWeek} day"); // revenir au début de la semaine

// Déterminer la fin de la semaine correspondante à cette date
$weekEnd = clone $weekStart;
$weekEnd->modify('+6 day'); // aller à la fin de la semaine

// Convertir les dates en format SQL pour les utiliser dans une requête
$weekStartSQL = $weekStart->format('Y-m-d');
$weekEndSQL = $weekEnd->format('Y-m-d');

$return_preadd = return_preadd($weekStartSQL, $weekEndSQL);
$result = $return_preadd->fetchAll();
$tab = array(
    array("Nom personnel", "Date", "Heure")
);
foreach($result as $res) {
    $nomPersonnel = $res["NomPersonnel"]. " ". $res["PrenomPersonnel"];
    $row = array($nomPersonnel, $res["DateHospi"], $res["HeureHospi"]);
    array_push($tab, $row);
}

// Inclure la bibliothèque TCPDF
require_once('tcpdf/tcpdf.php');
// Instancier un nouvel objet TCPDF
$pdf = new TCPDF();
// Ajouter une nouvelle page
$pdf->AddPage();
// Définir la police par défaut
$pdf->SetFont('helvetica', '', 12);

// Boucle sur les données et les insérer dans le tableau
foreach($tab as $row) {
    foreach($row as $cell) {
        // Dessiner une cellule
        $pdf->Cell(40, 10, $cell, 1);
    }
    // Aller à la ligne suivante
    $pdf->Ln();
}

// Définir le nom du fichier PDF avec la date de début de semaine
$filename = "Admission_de_la_semaine_du_{$weekStartSQL}.pdf";
// Envoyer le PDF au navigateur avec le nom de fichier personnalisé
$pdf->Output($filename, 'I');
?>