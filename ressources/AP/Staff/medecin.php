<!DOCTYPE html>

<?php 
    require_once('./requete.php');
    $IDPerso = $_SESSION["idPersonnel"];
    $return_nom = return_nom($IDPerso);
    $return_nom = $return_nom->fetch();
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/medecin.css">
</head>
<body>
    <div class="globale">
        <div class="navbar">
            <div class="logo"><img src="../css/medical.png" style="object-fit:cover; height:90%; width:90%;"><p>Clinique LPF</p></div>
            <div class=liens>
                <div class="accueil" style="text-decoration:underline;">Accueil</div>
                <a href="./perso.php" class="admis">Liste Admission</a>
                <div class="diag">Resultats Graphique</div>
            </div>
            <div class="deco">
                <div class="retour">Retour</div>
                <div class="decoz">Deconnexion</div>
            </div>

        </div>
        <div class="menu">
            <div class="titre"> Panel Medecin</div>
            <div class="case" id="CaseAccueil">
            <p> <?php echo 'Bonjour '. $return_nom['PrenomPersonnel'] ?></p>

            <p></p>
</div>
            <div class="case" id="CaseTab">

            </div>
            <div class="case" id="CaseGraphe">

            </div>

</div>

        </div>




    </div>
</body>
</html>