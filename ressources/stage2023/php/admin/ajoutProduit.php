<?php
    require("../requette.php");
    if($_SESSION["auth"] == 1) {
    $idP = $_GET["produit"];
    $_SESSION["ad-id"] = $idP;
    if(($idP != 0 ) && ($idP != null)) {
        $_SESSION["update"] = 1;
        $infos_produit = page_produit($idP);
        $liste_infos = $infos_produit->fetchAll();
        foreach($liste_infos as $res) {
            $nom = $res["label"];
            $prix = $res["prix"];
            $cat = $res["cat"];
            $img = $res["img"];
        }

        $liste_ingre = array();
        $nom_ingredient = return_ingrediant($idP);
        $nom_ingre = $nom_ingredient->fetchAll();

        foreach($nom_ingre as $res) {
            array_push($liste_ingre, $res["label"]);
        }
    } else {
        $_SESSION["update"] = 0;
        $nom = "";
        $prix = "";
        $cat = "";
        $img = "";
        $liste_ingre = array();
    }

    $return_all_ingredient = return_ingrediant_all();
    $return_all_ingre = $return_all_ingredient->fetchAll();
    $_SESSION["liste_all_ingre"] = array();
    $liste_all_ingre = array();
    
    foreach($return_all_ingre as $res) {
        array_push($liste_all_ingre, $res["label"]);
        array_push($_SESSION["liste_all_ingre"], $res["label"]);
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../style/ajoutProduit.css">
    <?php  if($_SESSION["update"] == 1) {
        echo "<title>Modifier un produit</title>";
    } else {
        echo "<title>Ajouter un produit ou un aliment</title>";
    }
    ?>
</head>
<body>
    <a href="../deconexion.php" class="deco">Se déconnecter</a>

    <section class="ajout">
    <?php if($_SESSION["update"] == 1) { ?>
        <h1>Modification d'un produit à la carte</h1> <?php }else { ?>
        <h1>Ajout d'un produit à la carte ou d'un aliment</h1>
    <?php } ?>
        <form action="../requette.php" method="post" enctype="multipart/form-data">
        <section class="pages">
            <section class="ajout_produit">
                <h4>A propos du produit</h4>

                <?php if($_SESSION["update"] == 1) { ?>
                    <div class="input_text">
                        <input type="text" name="nom-produit" class="nomProduit" placeholder="Nom du produit" value="<?= $nom ?>">
                        <input type="text" class="prix" name="prix-produit" placeholder="Prix" value="<?= $prix ?>">
                    </div>
                <?php }else { ?>
                    <div class="input_text">
                        <input type="text" name="nom-produit" class="nomProduit" placeholder="Nom du produit">
                        <input type="text" class="prix" name="prix-produit" placeholder="Prix" value="<?= $prix ?>">
                    </div>
                <?php } ?>
    
                <select name="cat-produit" id="">
                    <option>-- Catégorie --</option>
                    <?php
                    $return_categorie = return_categorie();
                    $return_cat = $return_categorie->fetchAll();
                    foreach($return_cat as $res) {
                        $idCat = $res["id"];
                        $labelCat = $res["label"];
                        if($cat == $idCat) {
                            echo "<option value=".$idCat." selected>".$labelCat."</option>";
                        } else {
                            echo "<option value=".$idCat.">".$labelCat."</option>";
                        }
                    }
                    ?>
                </select>

                <?php
                if($_SESSION["update"] == 1) {
                ?>
                <h4 class="titre">Modifier l'image</h4>
                <input type="file" name="img">
                <?php
                } else { ?>
                <h4 class="titre">Ajouter une image</h4>
                <input type="file" name="img">
                <?php } ?>
    
                <h4 class="title">Aliments du produits</h4>
                    <div class="input_search">
                        <input type="search" name="search-bar" placeholder="Rechercher un aliment" id="">
                        <input type="submit" name="btn-SB" value="Rechercher">
                    </div>
    
                <div class="list-aliment">
                    <ul class="list">
                        <?php
                        for($i=0; $i<sizeof($liste_all_ingre); $i++) {
                            if(in_array($liste_all_ingre[$i], $_SESSION["liste_nom_res"])) { 
                                if(in_array($liste_all_ingre[$i], $liste_ingre)) {

                        ?>
                                    <li class="list-item">
                                        <input type="checkbox" checked name="<?= $liste_all_ingre[$i] ?>" id="">
                                        <label for="<?= $liste_all_ingre[$i] ?>"><?= $liste_all_ingre[$i] ?></label>
                                    </li>
                        <?php
                                }else {
                        ?>
                                    <li class="list-item">
                                        <input type="checkbox" name="<?= $liste_all_ingre[$i] ?>" id="">
                                        <label for="<?= $liste_all_ingre[$i] ?>"><?= $liste_all_ingre[$i] ?></label>
                                    </li>
                        <?php
                                }
                        }} 
                        for($i=0; $i<sizeof($liste_all_ingre); $i++) {
                            if(!in_array($liste_all_ingre[$i], $_SESSION["liste_nom_res"])) { 
                                if(in_array($liste_all_ingre[$i], $liste_ingre)) {
                        ?>
                                    <li class="list-item">
                                        <input type="checkbox" checked name="<?= $liste_all_ingre[$i] ?>" id="">
                                        <label for="<?= $liste_all_ingre[$i] ?>"><?= $liste_all_ingre[$i] ?></label>
                                    </li>
                        <?php
                                }else {
                        ?>
                                    <li class="list-item">
                                        <input type="checkbox" name="<?= $liste_all_ingre[$i] ?>" id="">
                                        <label for="<?= $liste_all_ingre[$i] ?>"><?= $liste_all_ingre[$i] ?></label>
                                    </li>
                        <?php
                            }}} 
                        ?>
                    </ul>
                </div>
    
                <?php
                if($_SESSION["update"] == 1) { ?>
                <div class="submit_btn">
                    <input type="submit" name="stop_btn-admin" value="Annuler la modification">
                    <input type="submit" name="btn-admin-update" value="Modifier le produit">
                </div>
                <?php
                } else { ?>
                <div class="submit_btn">
                    <input type="submit" name="stop_btn-admin" value="Annuler l'ajout du produit">
                    <input type="submit" name="btn-admin-add" value="Ajouter le produit à la carte">
                </div>
                <?php
                }
                ?>
            </section>

            <?php
            if($_SESSION["update"] == 1) { ?>
            <?php
            } else { ?>
            <section class="ajout_aliment">
                <h4>Ajouter un aliment</h4>
                <input type="text" name="add-ingre" placeholder="Nom de l'aliment" id="">

                <div class="submit_btn">
                    <input type="submit" name="btn-stop_add_ingre" value="Annuler l'ajout">
                    <input type="submit" name="btn-add_ingre" value="Ajouter l'aliment">
                </div>
            </section>
            <?php
            }
            ?>
        </section>
    </section>
    </form>

</body>
</html>
<?php
    } else {
        header("location: ../../index");
    }
?>