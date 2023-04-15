<?php
    require('requetes.php');
    $date = date("Y-m-d");

    $login = $_POST['txt-login'];
    $mdp = $_POST['txt-password'];
    $_SESSION["status"] = "";
    $_SESSION["auth"] = 0;
    $_SESSION["role"] = "";

    if(isset($_POST["btn-creer"])) {create_user($login, $mdp, $_SESSION["date"], 4);} //créa compte

    $return_id_roles = return_id_role($login);
    $returnIdRole = $return_id_roles->fetchAll();
    foreach($returnIdRole as $res) {
        $idRole = $res["role"];
        switch($idRole) {
            case 1:
                $_SESSION["role"] = "admin";
                break;
            case 2:
                $_SESSION["role"] = "moderateur";
                break;
            case 3:
                $_SESSION["role"] = "visiteur";
                break;
            default:
                echo "erreur Role inconnue";
                throw("erreur");
        }
    }

    if(empty($idRole)) {
        $_SESSION["status"] = "L'identifiant ou le mot de passe est incorrect.";
        header("Location: login?conexion=1");
    }

    //test identifiant
    $authentification = authentification($login);
    $auth = $authentification->fetch();
    $pass = $auth["MDP"];

    switch($auth["count(Login)"]) {
        case 1 :
            if(password_verify($mdp, $pass)) {
                $_SESSION["login"] = $login;
                $_SESSION["auth"] = 1;
                //recup id user
                $return_id_user = return_id_user($login);
                $return_id = $return_id_user->fetchAll();
                foreach($return_id as $id) {
                    $_SESSION["id"] = $id["IdUser"];
                }

                if(isset($_POST['g-recaptcha-response'])) {
                    $captcha = $_POST['g-recaptcha-response'];
                    $secretKey = "6LcsftUkAAAAABXDlssDfWOwqTY89vLyMzs_luJX";
                    $ip = $_SERVER['REMOTE_ADDR'];
                    // post request to server
                    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
                    $response = file_get_contents($url);
                    $responseKeys = json_decode($response,true);
                    // should return JSON with success as true
                    if($responseKeys["success"]) {
                        //logs
                        log_conexion("Conexion de l'utilisateur", $_SESSION["date"], $_SESSION["heure"], $_SESSION["id"], $idRole);
                    } 
                    else {
                        $_SESSION["status"] = "Capchat non conforme";
                        log_conexion("Tentative de conexion de l'utilisateur (Capchat non conforme)", $_SESSION["date"], $_SESSION["heure"], $_SESSION["id"], $idRole);
                        header("Location: login?conexion=1");
                        break;
                    }
                }

                header("Location: ../index");
                exit();

            } else {
                $_SESSION["status"] = "L'identifiant ou le mot de passe est incorrect";
                $_SESSION["auth"] = 0;

                //recup id user
                $return_id_user = return_id_user($login);
                $return_id = $return_id_user->fetchAll();
                foreach($return_id as $id) {
                    $_SESSION["id"] = $id["IdUser"];
                }
                if(isset($_POST['g-recaptcha-response'])) {
                    $captcha = $_POST['g-recaptcha-response'];
                    $secretKey = "6LcsftUkAAAAABXDlssDfWOwqTY89vLyMzs_luJX";
                    $ip = $_SERVER['REMOTE_ADDR'];
                    // post request to server
                    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
                    $response = file_get_contents($url);
                    $responseKeys = json_decode($response,true);
                    // should return JSON with success as true
                    if($responseKeys["success"]) {
                        log_conexion("Tentative de conexion de l'utilisateur", $_SESSION["date"], $_SESSION["heure"], $_SESSION["id"], $idRole);
                    } 
                    else {
                        $_SESSION["status"] = "Capchat non conforme";
                        log_conexion("Tentative de conexion de l'utilisateur (Capchat non conforme)", $_SESSION["date"], $_SESSION["heure"], $_SESSION["id"], $idRole);
                        header("Location: login?conexion=1");
                        break;
                    }
                }

                header("Location: login?conexion=1");
                exit();
            }
            break;
        case 0 :
            $_SESSION["status"] = "L'identifiant ou le mot de passe est incorrect.";
            $_SESSION["auth"] = 0;

            //recup id user
            $return_id_user = return_id_user($login);
            $return_id = $return_id_user->fetchAll();
            foreach($return_id as $id) {
                $_SESSION["id"] = $id["IdUser"];
            }
            if(isset($_POST['g-recaptcha-response'])) {
                $captcha = $_POST['g-recaptcha-response'];
                $secretKey = "6LcsftUkAAAAABXDlssDfWOwqTY89vLyMzs_luJX";
                $ip = $_SERVER['REMOTE_ADDR'];
                // post request to server
                $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
                $response = file_get_contents($url);
                $responseKeys = json_decode($response,true);
                // should return JSON with success as true
                if($responseKeys["success"]) {
                    log_conexion("Tentative de conexion de l'utilisateur", $_SESSION["date"], $_SESSION["heure"], $_SESSION["id"], $idRole);
                } 
                else {
                    $_SESSION["status"] = "Capchat non conforme";
                    log_conexion("Tentative de conexion de l'utilisateur (Capchat non conforme)", $_SESSION["date"], $_SESSION["heure"], $_SESSION["id"], $idRole);
                    header("Location: login?conexion=1");
                    break;
                }
            }

            header("Location: login?conexion=1");
            break;

        default :
            throw("erreur");
            $_SESSION["status"] = "Il existe plusieur compte contacter l'administateur.";
            $_SESSION["auth"] = 0;
    }

    /* crypage de mdp + add un bdd */
    function create_user($login, $pass, $date, $role) {
        $pass = password_hash($pass, PASSWORD_ARGON2ID);
        create_users($login, $pass, $date, $role);
        //recup id user
        $return_id_user = return_id_user($login);
        $return_id = $return_id_user->fetchAll();
        foreach($return_id as $id) {
            $_SESSION["id"] = $id["IdUser"];
        }
        log_conexion("Création d'un utilisateur", $_SESSION["date"], $_SESSION["heure"], $_SESSION["id"], $role);
    }
?>