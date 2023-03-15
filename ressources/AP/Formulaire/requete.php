<?php 

require("../Staff/connexion_BDD.php");
session_start();

/*récup form préad*/
if (isset($_POST['pread'])) {
    $_SESSION["preadd"] = $_POST["choixhospi"];
    $_SESSION["datehospi"] = $_POST["datehospi"];
    $_SESSION["heurehospi"] = $_POST["heurehospi"];
    $_SESSION["nompersonnel"] = $_POST["medecin"];

    header("location: index.php");
    $_SESSION["form"] = 1;
}

/*récup form info Patient*/
if (isset($_POST['infoP'])) {
    $_SESSION["civ"] = $_POST["civ"];
    $_SESSION["nom"] = $_POST["nom"];
    $_SESSION["epouse"] = $_POST["epouse"];
    $_SESSION["prenom"] = $_POST["prenom"];
    $_SESSION["naissance"] = $_POST["naissance"];
    $_SESSION["adresse"] = $_POST["adresse"];
    $_SESSION["cp"] = $_POST["cp"];
    $_SESSION["ville"] = $_POST["ville"];
    $_SESSION["mail"] = $_POST["mail"];
    $_SESSION["tel"] = $_POST["tel"]; 

    header("location: index.php");
    $_SESSION["form"] = 2;
}

/*récup form info Assurance*/
if (isset($_POST["infoC"])) {
    $_SESSION["NomSecu"] = $_POST["NomSecu"];
    $_SESSION["NumSecu"] = $_POST["NumSecu"];
    $_SESSION["Assurance"] = $_POST["Assurance"];
    $_SESSION["ALD"] = $_POST["Ald"];
    $_SESSION["NomMutu"] = $_POST["NomMutu"];
    $_SESSION["NumAdherent"] = $_POST["NumAdherent"];
    $_SESSION["TypeChambre"] = $_POST["TypeChambre"];

    header("location: index.php");
    $_SESSION["form"] = 3;
}

/*récup form coords*/
if (isset($_POST['Coords'])) {
    $_SESSION["nomppre"] = $_POST["nomppre"];
    $_SESSION["prenomppre"] = $_POST["prenomppre"];
    $_SESSION["telppre"] = $_POST["telppre"];
    $_SESSION["adresseppre"] = $_POST["adresseppre"];

    $isExiste = testContact($_SESSION["telppre"], $_SESSION["adresseppre"], 
    $_SESSION["nomppre"], $_SESSION["prenomppre"]);
    $row = $isExiste->fetch();
    if ($row["count(*)"] < 0) {
        $PPre = getIdContact($_SESSION["nomppre"], $_SESSION["prenomppre"], 
        $_SESSION["telppre"], $_SESSION["adresseppre"]);
        $PersonnePre = $PPre->fetchAll();
        foreach($PerosnneConf as $res) {$_SESSION["PersonnePre"] = $res["IdProche"];}
    } else {
        insertContact($_SESSION["telppre"], $_SESSION["nomppre"], $_SESSION["prenomppre"], 
        $_SESSION["adresseppre"]);
        $PPre = getIdContact($_SESSION["nomppre"], $_SESSION["prenomppre"], 
        $_SESSION["telppre"], $_SESSION["adresseppre"]);
        $PersonnePre = $PPre->fetchAll();
        foreach($PersonnePre as $res) {$_SESSION["PersonnePre"] = $res["IdProche"];}
    }

    $_SESSION["nomconf"] = $_POST["nomconf"];
    $_SESSION["prenomconf"] = $_POST["prenomconf"];
    $_SESSION["telconf"] = $_POST["telconf"];
    $_SESSION["adresseconf"] = $_POST["adresseconf"];

    $isExiste = testContact($_SESSION["telconf"], $_SESSION["adresseconf"], 
    $_SESSION["nomconf"], $_SESSION["prenomconf"]);
    $row = $isExiste->fetch();
    if ($row["count(*)"] < 0) {
        $PConf = getIdContact($_SESSION["nomconf"], $_SESSION["prenomconf"], 
        $_SESSION["telconf"], $_SESSION["adresseconf"]);
        $PerosnneConf = $PConf->fetchAll();
        foreach($PerosnneConf as $res) {$_SESSION["PersonneConf"] = $res["IdProche"];}
    }else {
        insertContact($_SESSION["telconf"], $_SESSION["nomconf"], $_SESSION["prenomconf"], 
        $_SESSION["adresseconf"]);
        $PConf = getIdContact($_SESSION["nomconf"], $_SESSION["prenomconf"], 
        $_SESSION["telconf"], $_SESSION["adresseconf"]);
        $PerosnneConf = $PConf->fetchAll();
        foreach($PerosnneConf as $res) {$_SESSION["PersonneConf"] = $res["IdProche"];}
    }
    $_SESSION["form"] = 4;
    header("location: index.php");
}

/*modification d'un patient*/
if (isset($_POST["modif"])) {
    $_SESSION["modif_patient"] = true;
    $_SESSION["NumeSecu"] = $_POST["numSecuPatient"];
    header("Location: index");
}

/*add un patient*/
if (isset($_POST["add"])) {
    $_SESSION["modif_patient"] = false;
    $_SESSION["NumeSecu"] = "";
    header("Location: index");
}

/*récup form pièce joint*/
if (isset($_POST['pieceJiont'])) {
    $extentionValides = array('jpg', 'png', 'jpeg', 'pdf');
    $_SESSION["form"] = 0;
    uploadFichiers($extentionValides);
}

if (isset($_POST['pieceJiont_update'])) {
    $extentionValides = array('jpg', 'png', 'jpeg', 'pdf');
    $_SESSION["form"] = 0;
    update_patient($extentionValides);
}

/************************** LA BDD ************************************* */
function getIdContact($nom, $prenom, $tel, $adresse) {
    $pdo = connexion_bdd();
    $sql="select IdProche from proche
    where Nom  = ? and Prenom = ? and Tel = ? and Adresse = ?;";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array($nom, $prenom, $tel, $adresse));
    return $stmt;
}

function getInfosContactById($id) {
    $pdo = connexion_bdd();
    $sql="select * from proche where IdProche = ?;";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array($id));
    return $stmt;
}

function getHospi($numSecu) {
    $pdo = connexion_bdd();
    $sql="select * from hospi where NumSecu = ?;";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array($numSecu));
    return $stmt;
}

function getInfosPatient($numSecu) {
    $pdo = connexion_bdd();
    $sql="select * from patients where NumSecu = ?;";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array($numSecu));
    return $stmt;
}

function getCouvertureSociale($numSecu) {
    $pdo = connexion_bdd();
    $sql="select * from couverture_sociale where NumSecu = ?;";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array($numSecu));
    return $stmt;
}

function insertContact($tel, $nom, $prenom, $adresse) {
    $pdo = connexion_bdd();
    $sql="INSERT INTO proche
    (Prenom, Nom, Adresse, Tel)
    VALUES(?,?,?,?);";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array($prenom, $nom, $adresse, $tel));
}

function testContact($tel, $nom, $prenom, $adresse) {
    $pdo = connexion_bdd();
    $sql="select count(*) from proche p where tel = ? and Adresse = ?
    and Nom = ? and Prenom = ?;";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array($tel, $adresse, $nom, $prenom));
    return $stmt;
}

function  hospi($NomSecu, $NumSecu, $Assurance, $ALD, $NomMutu, $NumAdherent, $TypeChambre, 
          $civ, $nom, $epouse, $prenom, $naissance, $adresse, $cp, $ville, $mail, $tel,
          $preadd, $datehospi, $heurehospi, $nompersonnel, $PersonneConf, $PersonnePre) {

    $diff = date_diff(date_create($naissance), date_create(date("Y-m-d")));
    if ($diff->format('%y') >= 18){
        $age = 0;
    }
    else {
        $age = 1;
    }

    $pdo = connexion_bdd();
    $sql="INSERT INTO couverture_sociale
    (NomSecu, NumSecu, Assurance, ALD, NomMutu, NumAdherent, TypeChambre)
    VALUES(?,?,?,?,?,?,?);";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array($NomSecu, $NumSecu, $Assurance, $ALD, $NomMutu, $NumAdherent, $TypeChambre));

    $sql="INSERT INTO hospi
    (DateHospi, HeureHospi, PreAdd, IdPersonnel, NumSecu)
    VALUES(?,?,?,?,?);";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array($datehospi, $heurehospi, $preadd, $nompersonnel, $NumSecu));

    $sql="INSERT INTO patients 
    (Civ, NomNaissance, NomEpouse, PrenomPatient, NaissancePatient, AdressePatient,
    TelPatient,CPPatient, VillePatient, MailPatient, NumSecu, Mineur, IdProcheConf, idProchePre)
    VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array($civ, $nom, $epouse, $prenom, $naissance, $adresse, $tel, $cp, $ville, 
    $mail, $NumSecu, $age, $PersonneConf, $PersonnePre));

    header("Location: ../Staff/secretaire");
}

function  hospi_update($NomSecu, $NumSecu, $Assurance, $ALD, $NomMutu, $NumAdherent, $TypeChambre, 
          $civ, $nom, $epouse, $prenom, $naissance, $adresse, $cp, $ville, $mail, $tel,
          $preadd, $datehospi, $heurehospi, $nompersonnel, $PersonneConf, $PersonnePre) {

    $diff = date_diff(date_create($naissance), date_create(date("Y-m-d")));
    if ($diff->format('%y') >= 18){
        $age = 0;
    }
    else {
        $age = 1;
    }

    $pdo = connexion_bdd();
    $sql="UPDATE couverture_sociale
    SET NomSecu=?, Assurance=?, ALD=?, NomMutu=?, NumAdherent=?, TypeChambre=?
    WHERE NumSecu=?;";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array($NomSecu, $Assurance, $ALD, $NomMutu, $NumAdherent, $TypeChambre, $NumSecu));

    $sql="UPDATE hospi
    SET IdPersonnel=?, PreAdd=?, HeureHospi=?, DateHospi=?
    WHERE NumSecu=?;";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array($nompersonnel, $preadd, $heurehospi, $datehospi, $NumSecu));

    $sql="UPDATE patients
    SET Civ=?, NomNaissance=?, NomEpouse=?, PrenomPatient=?, NaissancePatient=?, AdressePatient=?, 
    TelPatient=?, CPPatient=?, VillePatient=?, MailPatient=?, Mineur=?, IdProcheConf=?, IdProchePre=?
    WHERE NumSecu=?;";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array($civ, $nom, $epouse, $prenom, $naissance, $adresse, $tel, $cp, $ville, 
    $mail, $age, $PersonneConf, $PersonnePre, $NumSecu));

    header("Location: ../Staff/secretaire");
}

function update_patient($extentionValides) {
    //Insert in bdd
    hospi_update($_SESSION["NomSecu"], $_SESSION["NumSecu"], $_SESSION["Assurance"], 
        $_SESSION["ALD"], $_SESSION["NomMutu"], $_SESSION["NumAdherent"], $_SESSION["TypeChambre"], 
        $_SESSION["civ"], $_SESSION["nom"], $_SESSION["epouse"], $_SESSION["prenom"], 
        $_SESSION["naissance"], $_SESSION["adresse"], $_SESSION["cp"], $_SESSION["ville"], 
        $_SESSION["mail"], $_SESSION["tel"], $_SESSION["preadd"], $_SESSION["datehospi"], 
        $_SESSION["heurehospi"], $_SESSION["nompersonnel"], $_SESSION["PersonneConf"], $_SESSION["PersonnePre"]);

    //Id Card
    $fichierUpload = strtolower(substr(strchr($_FILES["CarteId"]["name"], '.'), 1));
    if(in_array($fichierUpload, $extentionValides)) {
        $_FILES["CarteId"]["name"] = "Id_Card_".$_SESSION["NumSecu"];
        $nomF = $_FILES["CarteId"]["name"];
        $fichier = $nomF.'.'.$fichierUpload;
        $cheminFichier = "../Fichiers/".$fichier;
        move_uploaded_file($_FILES['CarteId']["tmp_name"], $cheminFichier);

        if(is_readable($cheminFichier)) {
            $cardId = true;
        } else {$cardId = false;}
    }
    // Vitale Card
    $fichierUpload = strtolower(substr(strchr($_FILES["CarteVitale"]["name"], '.'), 1));
    if(in_array($fichierUpload, $extentionValides)) {
        $_FILES["CarteVitale"]["name"] = "vitale_card".$_SESSION["NumSecu"];
        $nomF = $_FILES["CarteVitale"]["name"];
        $fichier = $nomF.'.'.$fichierUpload;
        $cheminFichier = "../Fichiers/".$fichier;
        move_uploaded_file($_FILES['CarteVitale']["tmp_name"], $cheminFichier);

        if(is_readable($cheminFichier)) {
            $cardVitual = true;
        } else {$cardVitual = false;}
    }

    // Carte Mutuel
    $fichierUpload = strtolower(substr(strchr($_FILES["CarteMutuel"]["name"], '.'), 1));
    if(in_array($fichierUpload, $extentionValides)) {
        $_FILES["CarteMutuel"]["name"] = "mutuel_Card_".$_SESSION["NumSecu"];
        $nomF = $_FILES["CarteMutuel"]["name"];
        $fichier = $nomF.'.'.$fichierUpload;
        $cheminFichier = "../Fichiers/".$fichier;
        move_uploaded_file($_FILES['CarteMutuel']["tmp_name"], $cheminFichier);

        if(is_readable($cheminFichier)) {
            $cardMutuel = true;
        } else {$cardMutuel = false;}
    }

    //Test si le patient es mineur
    $isMinieur = isMineur($_SESSION["NumSecu"]);
    $mineur = $isMinieur->fetchAll();
    foreach($mineur as $res) {$m = $res["Mineur"];}
    if ($m = "1") {
        // LivretFamille
        $fichierUpload = strtolower(substr(strchr($_FILES["LivretFamille"]["name"], '.'), 1));
        if(in_array($fichierUpload, $extentionValides)) {
            $_FILES["LivretFamille"]["name"] = "Livret_Famille_".$_SESSION["NumSecu"];
            $nomF = $_FILES["LivretFamille"]["name"];
            $fichier = $nomF.'.'.$fichierUpload;
            $cheminFichier = "../Fichiers/".$fichier;
            move_uploaded_file($_FILES['LivretFamille']["tmp_name"], $cheminFichier);

            if(is_readable($cheminFichier)) {
                $livreFamille = true;
            } else {$livreFamille = false;}
        }

        // DecisionJuge
        $fichierUpload = strtolower(substr(strchr($_FILES["DecisionJuge"]["name"], '.'), 1));
        if(in_array($fichierUpload, $extentionValides)) {
            $_FILES["DecisionJuge"]["name"] = "decision_juge_".$_SESSION["NumSecu"];
            $nomF = $_FILES["DecisionJuge"]["name"];
            $fichier = $nomF.'.'.$fichierUpload;
            $cheminFichier = "../Fichiers/".$fichier;
            move_uploaded_file($_FILES['DecisionJuge']["tmp_name"], $cheminFichier);

            if(is_readable($cheminFichier)) {
                $deciJuge = true;
            } else {$deciJuge = false;}
        }

        // AutorisationSoin
        $fichierUpload = strtolower(substr(strchr($_FILES["AutorisationSoin"]["name"], '.'), 1));
        if(in_array($fichierUpload, $extentionValides)) {
            $_FILES["AutorisationSoin"]["name"] = "autorisation_soin_".$_SESSION["NumSecu"];
            $nomF = $_FILES["AutorisationSoin"]["name"];
            $fichier = $nomF.'.'.$fichierUpload;
            $cheminFichier = "../Fichiers/".$fichier;
            move_uploaded_file($_FILES['AutorisationSoin']["tmp_name"], $cheminFichier);
            
            if(is_readable($cheminFichier)) {
                $autoSion = true;
            } else {$autoSion = false;}
        }

        if(($autoSion) && ($deciJuge) && ($cardId) && ($cardMutuel) && ($cardVitual) && ($livreFamille)) {
            updateFichier($_SESSION["NumSecu"],  $_FILES['CarteId']["name"], $_FILES['CarteMutuel']["name"], $_FILES['CarteMutuel']["name"],
            $_FILES['LivretFamille']["name"], $_FILES['AutorisationSoin']["name"], $_FILES['DecisionJuge']["name"]);
        }
    } else {
        if(($cardId) && ($cardMutuel) && ($cardVitual)) {
            updateFichier($_SESSION["NumSecu"],  $_FILES['CarteId']["name"], $_FILES['CarteMutuel']["name"], $_FILES['CarteMutuel']["name"], 0, 0, 0);
        }
    }
}

function uploadFichiers($extentionValides) {
    //Insert in bdd
    hospi($_SESSION["NomSecu"], $_SESSION["NumSecu"], $_SESSION["Assurance"], 
        $_SESSION["ALD"], $_SESSION["NomMutu"], $_SESSION["NumAdherent"], $_SESSION["TypeChambre"], 
        $_SESSION["civ"], $_SESSION["nom"], $_SESSION["epouse"], $_SESSION["prenom"], 
        $_SESSION["naissance"], $_SESSION["adresse"], $_SESSION["cp"], $_SESSION["ville"], 
        $_SESSION["mail"], $_SESSION["tel"], $_SESSION["preadd"], $_SESSION["datehospi"], 
        $_SESSION["heurehospi"], $_SESSION["nompersonnel"], $_SESSION["PersonneConf"], $_SESSION["PersonnePre"]);

    //Id Card
    $fichierUpload = strtolower(substr(strchr($_FILES["CarteId"]["name"], '.'), 1));
    if(in_array($fichierUpload, $extentionValides)) {
        $_FILES["CarteId"]["name"] = "Id_Card_".$_SESSION["NumSecu"];
        $nomF = $_FILES["CarteId"]["name"];
        $fichier = $nomF.'.'.$fichierUpload;
        $cheminFichier = "../Fichiers/".$fichier;
        move_uploaded_file($_FILES['CarteId']["tmp_name"], $cheminFichier);

        if(is_readable($cheminFichier)) {
            $cardId = true;
        } else {$cardId = false;}
    }
    // Vitale Card
    $fichierUpload = strtolower(substr(strchr($_FILES["CarteVitale"]["name"], '.'), 1));
    if(in_array($fichierUpload, $extentionValides)) {
        $_FILES["CarteVitale"]["name"] = "vitale_card".$_SESSION["NumSecu"];
        $nomF = $_FILES["CarteVitale"]["name"];
        $fichier = $nomF.'.'.$fichierUpload;
        $cheminFichier = "../Fichiers/".$fichier;
        move_uploaded_file($_FILES['CarteVitale']["tmp_name"], $cheminFichier);

        if(is_readable($cheminFichier)) {
            $cardVitual = true;
        } else {$cardVitual = false;}
    }

    // Carte Mutuel
    $fichierUpload = strtolower(substr(strchr($_FILES["CarteMutuel"]["name"], '.'), 1));
    if(in_array($fichierUpload, $extentionValides)) {
        $_FILES["CarteMutuel"]["name"] = "mutuel_Card_".$_SESSION["NumSecu"];
        $nomF = $_FILES["CarteMutuel"]["name"];
        $fichier = $nomF.'.'.$fichierUpload;
        $cheminFichier = "../Fichiers/".$fichier;
        move_uploaded_file($_FILES['CarteMutuel']["tmp_name"], $cheminFichier);

        if(is_readable($cheminFichier)) {
            $cardMutuel = true;
        } else {$cardMutuel = false;}
    }

    //Test si le patient es mineur
    $isMinieur = isMineur($_SESSION["NumSecu"]);
    $mineur = $isMinieur->fetchAll();
    foreach($mineur as $res) {$m = $res["Mineur"];}
    echo $m;
    if ($m == "1") {
        // LivretFamille
        $fichierUpload = strtolower(substr(strchr($_FILES["LivretFamille"]["name"], '.'), 1));
        if(in_array($fichierUpload, $extentionValides)) {
            $_FILES["LivretFamille"]["name"] = "Livret_Famille_".$_SESSION["NumSecu"];
            $nomF = $_FILES["LivretFamille"]["name"];
            $fichier = $nomF.'.'.$fichierUpload;
            $cheminFichier = "../Fichiers/".$fichier;
            move_uploaded_file($_FILES['LivretFamille']["tmp_name"], $cheminFichier);

            if(is_readable($cheminFichier)) {
                $livreFamille = true;
            } else {$livreFamille = false;}
        }

        // DecisionJuge
        $fichierUpload = strtolower(substr(strchr($_FILES["DecisionJuge"]["name"], '.'), 1));
        if(in_array($fichierUpload, $extentionValides)) {
            $_FILES["DecisionJuge"]["name"] = "decision_juge_".$_SESSION["NumSecu"];
            $nomF = $_FILES["DecisionJuge"]["name"];
            $fichier = $nomF.'.'.$fichierUpload;
            $cheminFichier = "../Fichiers/".$fichier;
            move_uploaded_file($_FILES['DecisionJuge']["tmp_name"], $cheminFichier);

            if(is_readable($cheminFichier)) {
                $deciJuge = true;
            } else {$deciJuge = false;}
        }

        // AutorisationSoin
        $fichierUpload = strtolower(substr(strchr($_FILES["AutorisationSoin"]["name"], '.'), 1));
        if(in_array($fichierUpload, $extentionValides)) {
            $_FILES["AutorisationSoin"]["name"] = "autorisation_soin_".$_SESSION["NumSecu"];
            $nomF = $_FILES["AutorisationSoin"]["name"];
            $fichier = $nomF.'.'.$fichierUpload;
            $cheminFichier = "../Fichiers/".$fichier;
            move_uploaded_file($_FILES['AutorisationSoin']["tmp_name"], $cheminFichier);
            
            if(is_readable($cheminFichier)) {
                $autoSion = true;
            } else {$autoSion = false;}
        }

        if(($autoSion) && ($deciJuge) && ($cardId) && ($cardMutuel) && ($cardVitual) && ($livreFamille)) {
            uploadFichier($_SESSION["NumSecu"],  $_FILES['CarteId']["tmp_name"], $_FILES['CarteMutuel']["tmp_name"], $_FILES['CarteMutuel']["tmp_name"],
            $_FILES['LivretFamille']["tmp_name"], $_FILES['AutorisationSoin']["tmp_name"], $_FILES['DecisionJuge']["tmp_name"]);
        }
    } else {
        if(($cardId) && ($cardMutuel) && ($cardVitual)) {
            echo "fff";
            uploadFichier($_SESSION["NumSecu"],  $_FILES['CarteId']["name"], $_FILES['CarteMutuel']["name"], $_FILES['CarteMutuel']["name"], 0, 0, 0);
        }
    }
}

function uploadFichier($NumSecu, $carteId, $carteV, $carteM, $livreF, $autorisationP, $autorisationJuge) {
    $pdo = connexion_bdd();
    $sql="INSERT INTO piecesjointes 
    (CarteId, CarteVitale, CarteMutuel, LivretFamille, AutorisationSoin, DecisionJuge, NumSecu)
    VALUES(?, ?, ?, ?, ?, ?, ?);";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array($carteId, $carteV, $carteM, $livreF, $autorisationP, $autorisationJuge, $NumSecu));
    return $stmt;
}

function updateFichier($NumSecu, $carteId, $carteV, $carteM, $livreF, $autorisationP, $autorisationJuge) {
    $pdo = connexion_bdd();
    $sql="UPDATE piecesjointes
    SET CarteId = ?, CarteVitale = ?, CarteMutuel = ?, LivretFamille = ?, AutorisationSoin = ?, DecisionJuge = ?
    WHERE NumSecu = ?;";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array($carteId, $carteV, $carteM, $livreF, $autorisationP, $autorisationJuge, $NumSecu));
    return $stmt;
}

function isMineur($id) {
    $pdo = connexion_bdd();
    $sql="SELECT Mineur from patients WHERE NumSecu = ?";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array($id));
    return $stmt;
}

function getMedecin() {
    $pdo = connexion_bdd();
    $sql='select p.PrenomPersonnel, p.NomPersonnel, p.IdPersonnel from personnel p inner join
    roles r on p.IdService = r.IdRole
    where r.Libelle = "medecin";';
    $stmt=$pdo->prepare($sql);
    $stmt->execute();
    return $stmt;
}
?>