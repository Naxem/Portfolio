<?php
    require('connexion_BDD.php');
    session_start();
    $_SESSION["date"] = date("Y-m-d");
    // Définit le fuseau horaire à Paris
    date_default_timezone_set('Europe/Paris');
    $_SESSION["heure"] = date('H:i:s');

    if (isset($_POST["btn-supp"])) {
        $numSecu = $_POST["numSecuPatient"];
        $return_numSecu = return_numSecu($numSecu);
        $return_Num_Secu = $return_numSecu->fetchAll();
        foreach($return_Num_Secu as $res) {$is_existe = $res;}
        if ($is_existe == 1) {
            supp($numSecu);
        }
    }

    //return
    function return_nom($IDPerso){
        $pdo = connexion_bdd();
        $stmt = $pdo->prepare("SELECT personnel.PrenomPersonnel FROM personnel where personnel.IdPersonnel = ? ;");
        $stmt->execute(array($IDPerso));
        return $stmt;
    }

    
    function return_id_perso($IDPerso){
        $pdo = connexion_bdd();
        $stmt = $pdo->prepare("SELECT hospi.DateHospi, hospi.HeureHospi, patients.PrenomPatient, patients.NomNaissance from patients inner join hospi on patients.NumSecu = hospi.NumSecu inner join personnel on hospi.IdPersonnel = personnel.IdPersonnel where personnel.IdPersonnel = ?;");
        $stmt->execute(array($IDPerso));
        return $stmt;
    }

    function return_etat($IDPerso){
        $pdo = connexion_bdd();
        $stmt = $pdo ->prepare("SELECT count(*) from hospi where hospi.Etat = 0 and hospi.IdPersonnel = ?;");
        $stmt->execute(array($IDPerso));
        return $stmt;
    }

    function return_etat1($IDPerso){
        $pdo = connexion_bdd();
        $stmt = $pdo ->prepare("SELECT count(*) from hospi where hospi.Etat = 1 and hospi.IdPersonnel = ?;");
        $stmt->execute(array($IDPerso));
        return $stmt;
    }

    function return_numSecu() {
        $pdo = connexion_bdd();
        $stmt=$pdo->prepare("SELECT count(NumSecu) FROM patients
        where NumSecu = ?;");
        $stmt->execute(array());
        return $stmt;
    }

    function return_id_role($login) {
        $pdo = connexion_bdd();
        $stmt = $pdo ->prepare("select idRole from user where Login = ?;");
        $stmt->execute(array($login));
        return $stmt;
      }

    //Conexion
    function authentification($login) {
        $pdo = connexion_bdd();
        $stmt=$pdo->prepare("SELECT count(Login), MDP FROM user
        where Login = ?;");
        $stmt->execute(array($login));
        return $stmt;
    }

    function return_id_user($login) {
        $pdo = connexion_bdd();
        $stmt = $pdo ->prepare("SELECT IdRole, IdUser FROM user
        where login = ?;");
        $stmt->execute(array($login));
        return $stmt;
    }

    //logs
    function log_conexion($label, $date, $user, $heure, $idRole) {
        $pdo = connexion_bdd();
        $stmt = $pdo ->prepare("INSERT INTO logs
        (Label, `Date`, `IdUser`, heure, idRole)
        VALUES(?, ?, ?, ?, ?);");
        $stmt->execute(array($label, $date, $user, $heure, $idRole));
        return $stmt;
    }

    //créa comptes
    function create_users($pass, $login, $role) {
        $pdo = connexion_bdd();
        $stmt=$pdo->prepare("INSERT INTO user 
        (Login, MDP, IdRole) VALUES(?, ?, ?);");
        $stmt->execute(array($login, $pass, $role));
    }

    //del
    function supp($numSecu) {
        $pdo = connexion_bdd();
        $sql="DELETE FROM hospi
        WHERE NumSecu = ?";     
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array($numSecu));  

        $sql="DELETE FROM couverturesociale
        WHERE NumSecu = ?";     
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array($numSecu));  

        $sql="DELETE FROM patients
        WHERE NumSecu = ?";     
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array($numSecu));

        $sql="DELETE FROM piecesjointes
        WHERE NumSecu = ?";     
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array($numSecu));
        header("location: admin");
    }

    //
    function return_preadd($dateS, $dateE) {
        $pdo = connexion_bdd();
        $sql="select * from personnel p inner join hospi h
        on p.IdPersonnel = h.IdPersonnel
        where p.IdService = 1 and h.DateHospi between ? and ?";     
        $stmt=$pdo->prepare($sql);
        $stmt->execute(array($dateS, $dateE)); 
        return $stmt; 
    }
?>