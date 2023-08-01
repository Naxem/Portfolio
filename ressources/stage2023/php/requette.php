<?php
    require("conexion_bdd.php");
    session_start();
    
    if(is_null($_SESSION["liste_nom_res"])) {
        $_SESSION["liste_nom_res"] = array();
    }

    if(isset($_POST["btn-SB"])) {
        $_SESSION["liste_nom_res"] = array();
        $_POST["search-bar"] = htmlspecialchars($_POST["search-bar"]); //pour sécuriser le formulaire contre les failles html
        $terme = $_POST["search-bar"];
        $terme = trim($terme); //pour supprimer les espaces dans la requête de l'internaute
        $terme = strip_tags($terme); //pour supprimer les balises html dans la requête
        if($terme != null) {
            $recherche = barre_recherche_ingre($terme);
            $result_recherche = $recherche->fetchAll();
            foreach($result_recherche as $result) {
                array_push($_SESSION["liste_nom_res"], $result["label"]);
            }
        }
        header("location: admin/ajoutProduit?produit=".$_SESSION["ad-id"]);
    }

    if (isset($_POST["btn-admin-update"])) {
        $_SESSION["ad-nom"] = $_POST["nom-produit"];
        $_SESSION["ad-prix"] = $_POST["prix-produit"];
        $_SESSION["ad-cat"] = $_POST["cat-produit"];
        $_SESSION["idI"] = 0;
        $_SESSION["liste-ingre"] = array();

        if(!$_FILES['img'] == null) {
            $_SESSION["ad-img"] = $_SESSION["ad-nom"];
            $extentionValides = array('jpg', 'png', 'jpeg');
            insert_img($_SESSION["ad-nom"]);
            $return_id_img = return_img_by_Name($_SESSION["ad-img"]);
            $id_img = $return_id_img->fetchAll();
            foreach($id_img as $res) {$_SESSION["ad-img"] = $res["id"];}

            $fichierUpload = strtolower(substr(strchr($_FILES["img"]["name"], '.'), 1));
            if(in_array($fichierUpload, $extentionValides)) {
                $_FILES["img"]["name"] = $_SESSION["ad-nom"];
                $nomF = $_FILES["img"]["name"];
                $fichier = $nomF.'.'.$fichierUpload;
                $cheminFichier = "../resources/photos/produits/".$fichier;
                $uploadFichier = move_uploaded_file($_FILES['img']["tmp_name"], $cheminFichier);
            }
        }else {
            $_SESSION["ad-img"] = "";
            $return_infos_produit = return_info_produit_by_id($_SESSION["ad-id"]);
            $return_id_img = $return_infos_produit->fetchAll();
            foreach($return_id_img as $res) {$_SESSION["ad-img"] = $res["img"];}
        }
        update_produit($_SESSION["ad-id"], $_SESSION["ad-nom"], $_SESSION["ad-prix"], 
        $_SESSION["ad-cat"], $_SESSION["ad-img"]);

        $return_id_produit = return_id_produit($_SESSION["ad-nom"]);
        $id_produit = $return_id_produit->fetchAll();
        foreach($id_produit as $res) {$idP = $res["id"];}

        supp_ingre_produits($idP);

        $return_ingre_produit = return_ingre_produit($idP);
        $liste_ingre_produit = $return_ingre_produit->fetchAll();
        foreach($liste_ingre_produit as $res) {
            array_push($_SESSION["liste-ingre"], $res["idIngrediant"]);
        }

        for ($i=0; $i<sizeof($_SESSION["liste_all_ingre"]); $i++) {
            if(isset($_POST[$_SESSION["liste_all_ingre"][$i]])) {
                $return_id_ingre = return_id_ingredient($_SESSION["liste_all_ingre"][$i]);
                $id_ingre = $return_id_ingre->fetchAll();
                foreach($id_ingre as $res) {$_SESSION["idI"] = $res["id"];}
                $return_is_ingre_produit = return_count_ingre_produit($idP, $_SESSION["idI"]);
                $in_ingre_produit = $return_is_ingre_produit->fetchAll();
                foreach($in_ingre_produit as $res) {
                    if($res["count(*)"] > 0) {$in_ingre_produit = 1;}
                    else {$in_ingre_produit = 0;}
                }
                if($in_ingre_produit == 0) {
                    insert_ingre_produits($_SESSION["idI"], $idP);
                }
            }          
        }
        header("location: admin.php");
    }

    if (isset($_POST["btn-admin-add"])) {
        $_SESSION["ad-nom"] = $_POST["nom-produit"];
        $_SESSION["ad-prix"] = $_POST["prix-produit"];
        $_SESSION["ad-cat"] = $_POST["cat-produit"];
        $_SESSION["idI"] = 0;

        if(!$_FILES['img'] == null) {

            $_SESSION["ad-img"] = $_SESSION["ad-nom"];

            $extentionValides = array('jpg', 'png', 'jpeg');

            insert_img($_SESSION["ad-img"]);

            $return_id_img = return_img_by_Name($_SESSION["ad-img"]);
            $id_img = $return_id_img->fetchAll();

            foreach($id_img as $res) {
                $_SESSION["ad-img"] = $res["id"];
            }
            $fichierUpload = strtolower(substr(strchr($_FILES["img"]["name"], '.'), 1));

            if(in_array($fichierUpload, $extentionValides)) {

                $_FILES["img"]["name"] = $_SESSION["ad-nom"];
                $nomF = $_FILES["img"]["name"];
                $fichier = $nomF.'.'.$fichierUpload;
                $cheminFichier = "../resources/photos/produits/".$fichier;
                $uploadFichier = move_uploaded_file($_FILES['img']["tmp_name"], $cheminFichier);

            }
        } else {

            $_SESSION["ad-img"] = "";

            $return_infos_produit = return_info_produit_by_id($_SESSION["ad-id"]);
            $return_id_img = $return_infos_produit->fetchAll();

            foreach($return_id_img as $res) {
                $_SESSION["ad-img"] = $res["img"];
            }
        }

        insert_produit($_SESSION["ad-nom"], $_SESSION["ad-prix"], 
        $_SESSION["ad-cat"], $_SESSION["ad-img"]);

        $return_id_produit = return_id_produit($_SESSION["ad-nom"]);
        $id_produit = $return_id_produit->fetchAll();

        foreach($id_produit as $res) {
            $idP = $res["id"];
        }

        for ($i=0; $i<sizeof($_SESSION["liste_all_ingre"]); $i++) {
            if(isset($_POST[$_SESSION["liste_all_ingre"][$i]])) {
                $return_id_ingre = return_id_ingredient($_SESSION["liste_all_ingre"][$i]);
                $id_ingre = $return_id_ingre->fetchAll();

                foreach($id_ingre as $res) {
                    $_SESSION["idI"] = $res["id"];
                }
                
                insert_ingre_produits($_SESSION["idI"], $idP);
            }          
        }
        header("location: admin.php");
    }

    if (isset($_POST["btn-add_ingre"])) {
        $_SESSION["ad-nom"] = $_POST["add-ingre"];
        insert_aliment($_SESSION["ad-nom"]);
        header("location: admin/ajoutProduit?produit=0");
    }

    if (isset($_POST["stop_btn-admin"])) {header("location: admin.php");}

    //update
    function update_produit($id, $nom, $prix, $cat, $img) {
        $pdo = connexion_bdd();
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $nom = filter_var($nom, FILTER_SANITIZE_STRING);
        $cat = filter_var($cat, FILTER_SANITIZE_NUMBER_INT);
        $img = filter_var($img, FILTER_SANITIZE_NUMBER_INT);
        $stmt=$pdo->prepare("UPDATE carte
        SET label=?, prix=?, cat=?, img=? WHERE id=?;");
        $stmt->execute(array($nom, $prix, $cat, $img, $id));
    }

    //insert
    function insert_produit($nom, $prix, $cat, $img) {
        $pdo = connexion_bdd();
        $nom = filter_var($nom, FILTER_SANITIZE_STRING);
        $cat = filter_var($cat, FILTER_SANITIZE_STRING);
        $img = filter_var($img, FILTER_SANITIZE_NUMBER_INT);
        $stmt=$pdo->prepare("INSERT INTO carte (label, prix, cat, img, new) VALUES(?, ?, ?, ?, ?);");
        $stmt->execute(array($nom, $prix, $cat, $img, 1));
    }

    function insert_ingre_produits($idI, $idP) {
        $pdo = connexion_bdd();
        $idI = filter_var($idI, FILTER_SANITIZE_NUMBER_INT);
        $idP = filter_var($idP, FILTER_SANITIZE_NUMBER_INT);
        $stmt=$pdo->prepare("INSERT INTO ingre_produits (idIngrediant, idProduit) VALUES(?, ?);");
        $stmt->execute(array($idI, $idP));
    }


    function insert_aliment($nom) {
        $pdo = connexion_bdd();
        $nom = filter_var($nom, FILTER_SANITIZE_STRING);
        $stmt=$pdo->prepare("INSERT INTO ingredient
        (label)
        VALUES(?);");
        $stmt->execute(array($nom));
    }

    function insert_img($img) {
        $pdo = connexion_bdd();
        $img = filter_var($img, FILTER_SANITIZE_STRING);
        $stmt=$pdo->prepare("INSERT INTO img (nom) VALUES(?);");
        $stmt->execute(array($img));
    }


    //return
    function return_categorie() {
        $pdo = connexion_bdd();
        $stmt=$pdo->prepare("SELECT * from categorie;");
        $stmt->execute();
        return $stmt;
    }

    function return_count_ingre_produit($idP, $idI) {
        $pdo = connexion_bdd();
        $stmt=$pdo->prepare("SELECT count(*) from ingre_produits
        where idProduit = ? and idIngrediant = ?;");
        $stmt->execute(array($idP, $idI));
        return $stmt;
    }

    function return_ingre_produit($idP) {
        $pdo = connexion_bdd();
        $stmt=$pdo->prepare("SELECT * from ingre_produits
        where idProduit = ?;");
        $stmt->execute(array($idP));
        return $stmt;
    }

    function return_info_produit($cat) {
        $pdo = connexion_bdd();
        $stmt=$pdo->prepare("SELECT id, label , prix, img, new from carte
        where carte.cat = ?
        order by prix desc;");
        $stmt->execute(array($cat));
        return $stmt;
    }

    function return_info_produit_by_id($id) {
        $pdo = connexion_bdd();
        $stmt=$pdo->prepare("SELECT id, label , prix, img, new from carte
        where id = ?");
        $stmt->execute(array($id));
        return $stmt;
    }


    function return_info_new($cat) {
        $pdo = connexion_bdd();
        $stmt=$pdo->prepare("SELECT id, label , prix, img, new from carte
        where cat = ? and new = 1
        order by new, prix;");
        $stmt->execute(array($cat));
        return $stmt;
    }

    function return_img($id) {
        $pdo = connexion_bdd();
        $stmt=$pdo->prepare("SELECT nom from img
        where id  = ?");
        $stmt->execute(array($id));
        return $stmt;
    }

    function return_img_by_Name($name) {
        $pdo = connexion_bdd();
        $stmt=$pdo->prepare("SELECT id from img
        where nom  = ?");
        $stmt->execute(array($name));
        return $stmt;
    }

    function return_ingrediant($id) {
        $pdo = connexion_bdd();
        $stmt = $pdo->prepare("SELECT i.label from `ingre_produits` ip
        inner join ingredient i on ip.idIngrediant = i.id
        inner join carte c on ip.idProduit = c.id
        where ip.idProduit = ?;");
        $stmt->execute(array($id));
        return $stmt;
    }

    function return_ingrediant_all() {
        $pdo = connexion_bdd();
        $stmt = $pdo->prepare("SELECT label from ingredient ORDER BY label");
        $stmt->execute();
        return $stmt;
    }

    function return_id_produit($nom) {
        $pdo = connexion_bdd();
        $stmt = $pdo->prepare("SELECT id from carte
        where label = ?");
        $stmt->execute(array($nom));
        return $stmt;
    }

    function return_id_ingredient($nom) {
        $pdo = connexion_bdd();
        $stmt = $pdo->prepare("SELECT id from `ingredient`
        where label = ?");
        $stmt->execute(array($nom));
        return $stmt;
    }

    function page_produit($id) {
        $pdo = connexion_bdd();
        $stmt=$pdo->prepare("SELECT * FROM carte WHERE id = ?");
        $stmt->execute(array($id));
        return $stmt;
    }

    function return_categorie_produit($id_cat) {
        $pdo = connexion_bdd();
        $stmt=$pdo->prepare("SELECT label from categorie where id = ?");
        $stmt->execute(array($id_cat));
        return $stmt;
    }

    //supp
    function supp_produit($id) {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $pdo = connexion_bdd();
        $stmt = $pdo->prepare("DELETE FROM carte
        WHERE id = ?;");
        $stmt->execute(array($id));

        $stmt = $pdo->prepare("DELETE FROM ingre_produits
        WHERE idProduit = ?;");
        $stmt->execute(array($id));
    }

    function supp_ingre_produits($id) {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $pdo = connexion_bdd();
        $stmt = $pdo->prepare("DELETE FROM ingre_produits
        WHERE idProduit = ?;");
        $stmt->execute(array($id));
    }

    function supp_img($id) {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        $pdo = connexion_bdd();
        $stmt = $pdo->prepare("DELETE FROM img
        WHERE id = ?;");
        $stmt->execute(array($id));
    }

    //Conexion
    function authentification($login) {
        $pdo = connexion_bdd();
        $login = filter_var($login, FILTER_SANITIZE_STRING);
        $stmt=$pdo->prepare("SELECT count(login), mdp FROM user
        where login = ?;");
        $stmt->execute(array($login));
        return $stmt;
    }

    function return_id_user($login) {
        $pdo = connexion_bdd();
        $login = filter_var($login, FILTER_SANITIZE_STRING);
        $stmt = $pdo ->prepare("SELECT id FROM user
        where login = ?;");
        $stmt->execute(array($login));
        return $stmt;
    }

    //logs
    function log_conexion($label, $date, $user) {
        $pdo = connexion_bdd();
        $stmt = $pdo ->prepare("INSERT INTO logs
        (label, `date`, `user`)
        VALUES(?, ?, ?);");
        $stmt->execute(array($label, $date, $user));
        return $stmt;
    }

    //créa comptes
    function create_users($pass, $login, $role) {
        $pdo = connexion_bdd();
        $stmt=$pdo->prepare("INSERT INTO user 
        (login, mdp, role) VALUES(?, ?, ?);");
        $stmt->execute(array($login, $pass, $role));
    }

    //cron
    function cron_new() {
        $pdo = connexion_bdd();
        $stmt = $pdo->prepare("SELECT id, datediff(current_date(), date_ajout) as interval_date from carte
        where new = 1;");
        $stmt->execute();
        return $stmt;
    }

    function cron_update_new($id) {
        $pdo = connexion_bdd();
        $stmt = $pdo->prepare("UPDATE carte
        SET `new`='0' WHERE id=?;");
        $stmt->execute(array($id));
    }

    //seach bar
    function barre_recherche_ingre($terme) {
        $terme = filter_var($terme, FILTER_SANITIZE_STRING);
        $pdo = connexion_bdd();
        $sql = "SELECT label FROM ingredient WHERE label LIKE ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array("%".$terme."%"));
        return $stmt;
    }

    function barre_recherche_produit($terme) {
        $terme = filter_var($terme, FILTER_SANITIZE_STRING);
        $pdo = connexion_bdd();
        $sql = "SELECT id FROM carte WHERE label LIKE ?;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array("%".$terme."%"));
        return $stmt;
    }
?>