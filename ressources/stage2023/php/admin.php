<?php
    require("requette.php");

    if($_SESSION["auth"] == 1) {
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style/admin.css">

    <title>Bienvenue, User</title>
</head>
<body>
    <a href="deconexion" class="deco">Se déconnecter</a>

    <section class="ajout">
        <h1>Ajout d'un produit à la carte ou d'un aliment</h1>
        <div class="buttons">
            <a href="admin/ajoutProduit?produit=0" class="btn">Ajouter un produit ou un aliment</a>
        </div>
    </section>

    <section class="modif">

        <h1>Modifier un produit à la carte</h1>
        <form action="admin.php" method="post">
            <div class="search-bar">
                <input type="search" name="search-bar" placeholder="Rechercher un produit sur la carte...">
                <input type="submit" name="btn-SBP" value="Rechercher">
            </div>
        </form>

        <?php
        $liste_produit = 0;
        if(isset($_POST["btn-SBP"])) {
        ?>
        <section class="pizza">
            <h2>Resultat de la recherche</h2>
            <ul class="list">
        <?php
            $_POST["search-bar"] = htmlspecialchars($_POST["search-bar"]); //pour sécuriser le formulaire contre les failles html
            $terme = $_POST["search-bar"];
            $terme = trim($terme); //pour supprimer les espaces dans la requête de l'internaute
            $terme = strip_tags($terme); //pour supprimer les balises html dans la requête
            if($terme != null) {
                $recherche = barre_recherche_produit($terme);
                $result_recherche = $recherche->fetchAll();
                foreach($result_recherche as $result) {
                    $liste_produit = $result["id"];
        ?>
            <?php
            $return_info = page_produit($liste_produit);
            $info_produit = $return_info->fetchAll();
            foreach ($info_produit as $res) {
                $prix = $res["prix"];
                $nom_produit = $res["label"];
                $img = $res["img"];
                $idP = $res["id"];

                $return_ingre = return_ingrediant($idP);
                $returnIngre = $return_ingre->fetchAll();
            ?>
                <li class="list-item">
                    <h4><?= $nom_produit ?></h4>
                    <p class="prix"><strong>Prix : </strong><?= $prix ?> €</p>
                    <p class="aliment"><strong>Aliments : </strong><?php foreach ($returnIngre as $resIngre) {echo $resIngre["label"].", ";} ?></p>

                    <div class="buttons">
                        <a href="supprimer_produit?produit=<?= $idP ?>" class="btn">Supprimer</a>
                        <a href="admin/ajoutProduit.php?produit=<?= $idP ?>" class="btn">Modifier</a>
                    </div>
                </li>
            <?php } ?>
        <?php }} ?>
        </ul>
        </section>
        <?php } ?>

        <section class="pizza">
            <h2>Les pizzas</h2>
            <ul class="list">
            <?php
            $return_info = return_info_produit(1);
            $info_produit = $return_info->fetchAll();
            foreach ($info_produit as $res) {
                $prix = $res["prix"];
                $nom_produit = $res["label"];
                $img = $res["img"];
                $idP = $res["id"];

                $return_ingre = return_ingrediant($idP);
                $returnIngre = $return_ingre->fetchAll();
            ?>
                <li class="list-item">
                    <h4><?= $nom_produit ?></h4>
                    <p class="prix"><strong>Prix : </strong><?= $prix ?> €</p>
                    <p class="aliment"><strong>Aliments : </strong><?php foreach ($returnIngre as $resIngre) {echo $resIngre["label"].", ";} ?></p>

                    <div class="buttons">
                        <a href="supprimer_produit?produit=<?= $idP ?>" class="btn">Supprimer</a>
                        <a href="admin/ajoutProduit?produit=<?= $idP ?>" class="btn">Modifier</a>
                    </div>
                </li>
            <?php } ?>
            </ul>
        </section>

        <section class="pate">
            <h2>Les pâtes</h2>
            <ul class="list">
            <?php
            $return_info = return_info_produit(3);
            $info_produit = $return_info->fetchAll();

            foreach ($info_produit as $res) {
                $prix = $res["prix"];
                $nom_produit = $res["label"];
                $img = $res["img"];
                $idP = $res["id"];

                $return_ingre = return_ingrediant($idP);
                $returnIngre = $return_ingre->fetchAll();
            ?>
                <li class="list-item">
                    <h4><?= $nom_produit ?></h4>
                    <p class="prix"><strong>Prix : </strong><?= $prix ?> €</p>
                    <p class="aliment"><strong>Aliments : </strong><?php foreach ($returnIngre as $resIngre) {echo $resIngre["label"].", ";} ?></p>

                    <div class="buttons">
                        <a href="supprimer_produit?produit=<?= $idP ?>" class="btn">Supprimer</a>
                        <a href="admin/ajoutProduit?produit=<?= $idP ?>" class="btn">Modifier</a>
                    </div>
                </li>
            </ul>
            <?php } ?>
        </section>

        <section class="panini">
            <h2>Les paninis</h2>
            <ul class="list">
            <?php
            $return_info = return_info_produit(2);
            $info_produit = $return_info->fetchAll();

            foreach ($info_produit as $res) {
                $prix = $res["prix"];
                $nom_produit = $res["label"];
                $img = $res["img"];
                $idP = $res["id"];

                $return_ingre = return_ingrediant($idP);
                $returnIngre = $return_ingre->fetchAll();
            ?>
                <li class="list-item">
                    <h4><?= $nom_produit ?></h4>
                    <p class="prix"><strong>Prix : </strong><?= $prix ?> €</p>
                    <p class="aliment"><strong>Aliments : </strong><?php foreach ($returnIngre as $resIngre) {echo $resIngre["label"].", ";} ?></p>

                    <div class="buttons">
                        <a href="supprimer_produit?produit=<?= $idP ?>" class="btn">Supprimer</a>
                        <a href="admin/ajoutProduit?produit=<?= $idP ?>" class="btn">Modifier</a>
                    </div>
                </li>
            <?php } ?>
            </ul>
        </section>

        <section class="dessert">
            <h2>Les desserts</h2>
            <ul class="list">
            <?php
            $return_info = return_info_produit(5);
            $info_produit = $return_info->fetchAll();

            foreach ($info_produit as $res) {
                $prix = $res["prix"];
                $nom_produit = $res["label"];
                $img = $res["img"];
                $idP = $res["id"];

                $return_ingre = return_ingrediant($idP);
                $returnIngre = $return_ingre->fetchAll();
            ?>
                <li class="list-item">
                    <h4><?= $nom_produit ?></h4>
                    <p class="prix"><strong>Prix : </strong><?= $prix ?> €</p>
                    <p class="aliment"><strong>Aliments : </strong><?php foreach ($returnIngre as $resIngre) {echo $resIngre["label"].", ";} ?></p>

                    <div class="buttons">
                        <a href="supprimer_produit?produit=<?= $idP ?>" class="btn">Supprimer</a>
                        <a href="admin/ajoutProduit?produit=<?= $idP ?>" class="btn">Modifier</a>
                    </div>
                </li>
            <?php } ?>
            </ul>
        </section>

        <section class="boisson">
            <h2>Les boissons</h2>
            <ul class="list">
            <?php
            $return_info = return_info_produit(4);
            $info_produit = $return_info->fetchAll();
            $liste_ingre = array();

            foreach ($info_produit as $res) {
                $prix = $res["prix"];
                $nom_produit = $res["label"];
                $img = $res["img"];
                $idP = $res["id"];

                $return_ingre = return_ingrediant($idP);
                $returnIngre = $return_ingre->fetchAll();
                foreach ($returnIngre as $resIngre) {
                    array_push($liste_ingre, $resIngre["label"]);
                }
            ?>
                <li class="list-item">
                    <h4><?= $nom_produit ?></h4>
                    <p class="prix"><strong>Prix : </strong><?= $prix ?> €</p>
                    <div class="buttons">
                        <a href="supprimer_produit?produit=<?= $idP ?>" class="btn">Supprimer</a>
                    </div>
                </li>
            <?php } ?>
            </ul>
        </section>
    </section>
</body>
</html>
<?php
    }else {
        header("Location: ../index");
    }
?>