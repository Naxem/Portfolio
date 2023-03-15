<?php
    require('requete.php');

    $login = $_POST['txt-login'];
    $mdp = $_POST['txt-password'];
    $_SESSION["status"] = "";

    if (isset($_POST["btn-crea-user"])) {
        create_user($mdp, $login, 1);
        header("Location: login");
    }

    //recup id user
    $return_id_user = return_id_user($login);
    $return_id = $return_id_user->fetchAll();
    foreach($return_id as $id) {$_SESSION["idRole"] = $id["IdRole"]; $_SESSION["idUser"] = $id["IdUser"];}

    if((empty($_SESSION["idRole"])) || (empty($_SESSION["idUser"]))) {
        $_SESSION["status"] = "L'identifiant ou le mot de passe est incorrect.";
        header("Location: login");
    }

    //test identifiant
    $authentification = authentification($login);
    $auth = $authentification->fetch();
    $pass = $auth["MDP"];

    switch($auth["count(Login)"]) {
        case 1 :
            if(password_verify($mdp, $pass)) {                
                if(isset($_POST['g-recaptcha-response'])) {
                    $captcha = $_POST['g-recaptcha-response'];
                    $secretKey = "6LccV9gkAAAAAAhTXTsRKbHiylrAtmdxECgiKJZz";
                    $ip = $_SERVER['REMOTE_ADDR'];
                    // post request to server
                    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
                    $response = file_get_contents($url);
                    $responseKeys = json_decode($response,true);
                    // should return JSON with success as true
                    if($responseKeys["success"]) {
                        //log
                        log_conexion("Conexion de l'utilisateur", $_SESSION["date"], $_SESSION["idUser"], $_SESSION["heure"], $_SESSION["idRole"]);
                        switch($_SESSION["idRole"]) {
                            case "1" :
                                header("location: admin");
                                break;
                            case  "2" :
                                header("location: medecin");
                                break;
                            case "3" :
                                header("location: secretaire");
                                break;
                            default :
                                throw("erreur");
                        }
                    } 
                    else {
                        $_SESSION["status"] = "Capchat non conforme";
                        log_conexion("Tentative de conexion de l'utilisateur (Capchat non conforme)", $_SESSION["date"], $_SESSION["idUser"], $_SESSION["heure"], $_SESSION["idRole"]);
                        header("Location: login");
                        break;
                    }
                }
            } else {
                if(isset($_POST['g-recaptcha-response'])) {
                    $captcha = $_POST['g-recaptcha-response'];
                    $secretKey = "6LccV9gkAAAAAAhTXTsRKbHiylrAtmdxECgiKJZz";
                    $ip = $_SERVER['REMOTE_ADDR'];
                    // post request to server
                    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
                    $response = file_get_contents($url);
                    $responseKeys = json_decode($response,true);
                    // should return JSON with success as true
                    if($responseKeys["success"]) {
                        log_conexion("Tentative de conexion de l'utilisateur", $_SESSION["date"], $_SESSION["idUser"], $_SESSION["heure"], $_SESSION["idRole"]);
                        $_SESSION["status"] = "L'identifiant ou le mot de passe est incorrect.";
                        //header("Location: login");
                        break;
                    } 
                    else {
                        $_SESSION["status"] = "Capchat non conforme";
                        log_conexion("Tentative de conexion de l'utilisateur (Capchat non conforme)", $_SESSION["date"], $_SESSION["idUser"], $_SESSION["heure"], $_SESSION["idRole"]);
                        //header("Location: login");
                        break;
                    }
                }
            }
        case 0 :
            if(isset($_POST['g-recaptcha-response'])) {
                $captcha = $_POST['g-recaptcha-response'];
                $secretKey = "6LccV9gkAAAAAAhTXTsRKbHiylrAtmdxECgiKJZz";
                $ip = $_SERVER['REMOTE_ADDR'];
                // post request to server
                $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
                $response = file_get_contents($url);
                $responseKeys = json_decode($response,true);
                // should return JSON with success as true
                if($responseKeys["success"]) {
                    $_SESSION["status"] = "L'identifiant ou le mot de passe est incorrect.";
                    log_conexion("Tentative de conexion de l'utilisateur", $_SESSION["date"], $_SESSION["idUser"], $_SESSION["heure"], $_SESSION["idRole"]);
                    //header("Location: login");
                    break;
                } 
                else {
                    $_SESSION["status"] = "Capchat non conforme";
                    log_conexion("Tentative de conexion de l'utilisateur (Capchat non conforme)", $_SESSION["date"], $_SESSION["idUser"], $_SESSION["heure"], $_SESSION["idRole"]);
                    //header("Location: login");
                    break;
                }
            }
        default :
            throw("erreur");
            $_SESSION["status"] = "Il existe plusieur compte contacter l'administateur.";
            //header("Location: login");
            break;
    }

    /* crypage de mdp + add un bdd */
    function create_user($pass, $login, $role) {
        $pass = password_hash($pass, PASSWORD_ARGON2ID);
        create_users($pass, $login, $role);
    }
?>