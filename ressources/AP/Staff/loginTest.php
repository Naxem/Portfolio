<?php
    require('requete.php');

    $login = $_POST['txt-login'];
    $mdp = $_POST['txt-password'];
    $_SESSION["status"] = "";

    if (isset($_POST["btn-crea-user"])) {
        create_user($mdp, $login, 1);
        header("Location: login.php");
    }

    //recup id user
    $return_id_user = return_id_user($login);
    $return_id = $return_id_user->fetchAll();
    foreach($return_id as $id) {$_SESSION["idRole"] = $id["IdRole"]; $_SESSION["idUser"] = $id["IdUser"];}

    if((empty($_SESSION["idRole"])) || (empty($_SESSION["idUser"]))) {
        $_SESSION["status"] = "L'identifiant ou le mot de passe est incorrect.";
        header("Location: login.php");
    }

    //test identifiant
    $authentification = authentification($login);
    $auth = $authentification->fetch();
    $pass = $auth["MDP"];

    switch($auth["count(Login)"]) {
        case 0 :
            $_SESSION["status"] = "L'identifiant ou le mot de passe est incorrect.";
            log_conexion("Tentative de conexion de l'utilisateur", $_SESSION["date"], $_SESSION["idUser"], $_SESSION["heure"], $_SESSION["idRole"]);
            header("Location: login.php");
            break;
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
                                $_SESSION["status"] = "";
                                header("location: admin.php");
                                break;
                            case  "2" :
                                $_SESSION["status"] = "";
                                header("location: medecin.php");
                                break;
                            case "3" :
                                $_SESSION["status"] = "";
                                header("location: secretaire.php");
                                break;
                            default :
                                $_SESSION["status"] = "erreur";
                                throw("erreur");
                        }
                    } 
                    else {
                        $_SESSION["status"] = "Capchat non conforme";
                        log_conexion("Tentative de conexion de l'utilisateur (Capchat non conforme)", $_SESSION["date"], $_SESSION["idUser"], $_SESSION["heure"], $_SESSION["idRole"]);
                        header("Location: login.php");
                        break;
                    }
                }
            } else {
                log_conexion("Tentative de conexion de l'utilisateur", $_SESSION["date"], $_SESSION["idUser"], $_SESSION["heure"], $_SESSION["idRole"]);
                $_SESSION["status"] = "L'identifiant ou le mot de passe est incorrect.";
                header("Location: login.php");
                break;
            }
        default :
            throw("erreur");
            $_SESSION["status"] = "Il existe plusieur compte contacter l'administateur.";
            header("Location: login.php");
            break;
    }

    /* crypage de mdp + add un bdd */
    function create_user($pass, $login, $role) {
        $pass = password_hash($pass, PASSWORD_ARGON2ID);
        create_users($pass, $login, $role);
    }
?>