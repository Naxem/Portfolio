<?php
    require("../php/requette.php");

    $id = $_GET['idProduit'];

    $res = page_produit($id);
    $produit = $res->fetch();

    $id_img = $produit['img'];
    $id_cat = $produit['cat'];

    $categorie = return_categorie_produit($id_cat);
    $categorie_produit = $categorie->fetch();

    $res = return_img($id_img);
    $produit_img = $res->fetch();

    $return_ingredient = return_ingrediant($id);
    $return_ingredient = $return_ingredient->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Primary Meta Tags -->
    <title>Pizzeria - Old School P'zzas</title>
    <meta name="title" content="Pizzeria - Old School P'zzas">
    <meta name="description" content="Site officiel de Old School P'zzas au 42 Route nationale 59241, Masnières.">
    <link rel="icon" href="../resources/photos/site/logo.png" type="image/icon type">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://oldschoolpizza.fr/">
    <meta property="og:title" content="Pizzeria - Old School P'zzas">
    <meta property="og:description" content="Site officiel de Old School P'zzas au 42 Route nationale 59241, Masnières.">
    <meta property="og:image" content="../resources/photos/site/index_pizza.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="http://oldschoolpizza.fr/">
    <meta property="twitter:title" content="Pizzeria - Old School P'zzas">
    <meta property="twitter:description" content="Site officiel de Old School P'zzas au 42 Route nationale 59241, Masnières.">
    <meta property="twitter:image" content="../resources/photos/site/index_pizza.png">

    <link rel="stylesheet" href="../style/page_produit.css">
</head>
<body>
    <header>
        <ul class="list">
            <li class="list-item"><a href="../index.php"><img src="../resources/photos/site/logo_noir.png"></a></li>
            <li class="list-item"><a href="../index.php">Accueil</a></li>
            <li class="list-item"><a href="engagements">Nos engagements</a></li>
            <li class="list-item"><a href="devis">Contact</a></li>
        </ul>
    </header>


    <section id="produit">
        <img src="../resources/photos/produits/<?= $produit_img['nom'] ?>" alt="">

        <div class="produit">
            <h1><?= $categorie_produit['label'] . ' ' ?><span class="nom"><?= $produit['label'] ?> </span><span class="prix"><?= $produit['prix'] ?>€</span></h1>

            <ul class="list">
                <li class="list-item">
                    <?php 
                        switch ($categorie_produit['label']) {
                            case 'Pizza':
                                $cat_produit = 'Base tomate ou creme ';
                                break;
                            
                            case 'Pates':
                                $cat_produit = 'Pates ';
                                break;

                            case 'Panini';
                                $cat_produit = 'Pain panini ';
                                break;
                        }

                        echo $cat_produit;
                        
                        foreach($return_ingredient as $ingredient) {
                            echo ' - ' . $ingredient['label'];
                        }
                    ?>
                </li>
                <li class="list-item">30cm, taille unique</li>
                <li class="list-item">Possibilite de changer la base ou de faire un duo</li>
                <li class="list-item">Supplement 1€<span class="info"> = fromage, charcuterie, viande...</span></li>
                <li class="list-item">Livraison des 2 pizzas <span class="info">dans un rayon de 10km</span></li>
            </ul>

            <button>Ajouter en coup de coeur</button>
            <a class="btn" href="tel:06 95 13 00 79">Appeler pour commander</a>
        </div>
    </section>

    <section id="footer">
        <div class="produits">
            <div class="titre">Nos produits</div>
            <ul class="list">
                <li class="list-item"><a href="../index#pizza">Pizzas</a></li>
                <li class="list-item"><a href="../index#pate">Nos snacks</a></li>
                <li class="list-item"><a href="../index#dessert">Boissons et desserts</a></li>
            </ul>
        </div>

        <div class="pizzaria">
            <div class="titre">Old school P'zza</div>
            <ul class="list">
                <li class="list-item"><a href="engagements#enga">Nos engagements</a></li>
                <li class="list-item"><a href="engagements#galerie">La pizzeria</a></li>
            </ul>
        </div>

        <div class="contact">
            <div class="titre">Contact</div>
            <ul class="list">
                <li class="list-item"><a href="devis">Faire un devis</a></li>
                <li class="list-item"><a href="tel:06 95 13 00 79">06 95 13 00 79</a></li>
            </ul>
        </div>

        <div class="mentions">
            <div class="titre">Divers</div>
            <ul class="list">
                <li class="list-item"><a href="mentions-cgv#mentions">Mentions Legales</a></li>
                <li class="list-item"><a href="mentions-cgv#cgv">Conditions generales de vente</a></li>
            </ul>
        </div>
    </section>
</body>
</html>