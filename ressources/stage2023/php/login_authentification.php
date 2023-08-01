<?php
    session_start();
    require('requette.php');
    $date = date("Y-m-d");

    $login = $_POST['txt-login'];
    $mdp = $_POST['txt-password'];
    $_SESSION["status"] = "";
    $_SESSION["auth"] = 0;
    //create_user($mdp, $login, 1); //créa compte

    //test identifiant
    $authentification = authentification($login);
    $auth = $authentification->fetch();
    $pass = $auth["mdp"];

    switch($auth["count(login)"]) {
        case 1 :
            if(password_verify($mdp, $pass)) {
                $_SESSION["login"] = $login;
                $_SESSION["auth"] = 1;
                //recup id user
                $return_id_user = return_id_user($login);
                $return_id = $return_id_user->fetchAll();
                foreach($return_id as $id) {
                    $_SESSION["id"] = $id["id"];
                }
                //logs
                log_conexion("Conexion de l'utilisateur ".$login, $date, $_SESSION["id"]);

                header("Location: admin.php");
                exit();

            } else {
                $_SESSION["status"] = "L'identifiant ou le mot de passe est incorrect.";
                $_SESSION["auth"] = 0;

                log_conexion("Tentative de conexion de l'utilisateur ".$login, $date, 3);

                header("Location: login");
                exit();
            }
            break;
        case 0 :
            $_SESSION["status"] = "L'identifiant ou le mot de passe est incorrect.";
            $_SESSION["auth"] = 0;

            log_conexion("Tentative de conexion de l'utilisateur ".$login, $date, 3);

            header("Location: login");
            break;

        default :
            throw("erreur");
            $_SESSION["status"] = "Il existe plusieur compte contacter l'administateur.";
            $_SESSION["auth"] = 0;
    }

    /* crypage de mdp + add un bdd */
    function create_user($pass, $login, $role) {
        $pass = password_hash($pass, PASSWORD_ARGON2ID);
        create_users($pass, $login, $role);
    }
?>