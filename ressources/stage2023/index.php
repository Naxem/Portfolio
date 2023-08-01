<?php
    require("php/requette.php");
    $_SESSION["liste_nom_res"] = 0;
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
    <link rel="icon" href="resources/photos/site/logo.png" type="image/icon type">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://oldschoolpizza.fr/">
    <meta property="og:title" content="Pizzeria - Old School P'zzas">
    <meta property="og:description" content="Site officiel de Old School P'zzas au 42 Route nationale 59241, Masnières.">
    <meta property="og:image" content="resources/photos/site/index_pizza.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="http://oldschoolpizza.fr/">
    <meta property="twitter:title" content="Pizzeria - Old School P'zzas">
    <meta property="twitter:description" content="Site officiel de Old School P'zzas au 42 Route nationale 59241, Masnières.">
    <meta property="twitter:image" content="resources/photos/site/index_pizza.png">
    
    <link rel="stylesheet" href="style/style.css">

    <script src="https://kit.fontawesome.com/b9c6e88654.js" crossorigin="anonymous"></script>

    <title>Pizzeria - Old School P'zzas</title>
</head>
<body>
    <header>
        <ul class="list">
            <li class="list-item img"><a href="index"><img src="resources/photos/site/logo_blanc.png"></a></li>
            <li class="list-item accueil"><a href="#presentation">Accueil</a></li>
            <li class="list-item pizza"><a href="#pizza">Nos pizzas</a></li>
            <li class="list-item snack"><a href="#pate">Nos snacks</a></li>
            <li class="list-item dessert"><a href="#dessert">Nos boissons et desserts</a></li>
            <li class="list-item engaement"><a href="pages/engagements">La pizzeria</a></li>
            <li class="list-item contact"><a href="pages/devis">Contact</a></li>
        </ul>
    </header>

    <!-- Présentation de la pizzaria -->
    <section id="presentation">
        <div class="titre">
            <div class="moyen">
                <div class="livraison">
                    <i class="fa-solid fa-truck-fast"></i>
                    Livraison
                </div>

                <div class="place">
                    <i class="fa-solid fa-location-dot"></i>
                    Sur place
                </div>

                <div class="emporte">
                    <i class="fa-solid fa-bag-shopping"></i>
                    A emporter
                </div>
            </div>

            <h1>Old school P'zzas</h1>
            <span>42 route nationale<br>59241 <span class="uppercase">Masnieres</span><br>06 95 13 00 79</span>
        </div>
        <div class="background"></div>
        <img class="img" src="resources/photos/site/background_img.jpg" alt="Photo de la pizzeria">

        <div class="reseaux">
            <a href="https://www.facebook.com/gregetcecilemasnieres/" target="_blank"><img src="resources/photos/site/facebook.png" class="facebook" alt="icon facebook"></a>
        </div>
        
    </section>

    <!-- SECTION PIZZA -->
    <section id="pizza">
        <div class="pizza-header">
            <img class="image" src="resources/photos/site/gauche.png" alt="">

            <div class="autres"> 
                <div class="textes">
                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>

                    <h2 class="titre">Les p'zzas</h2>

                    <div class="stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>

                </div>
            </div>
            
            <img class="image" src="resources/photos/site/droite.png" alt="">
        </div>

        <select name="base" id="">
                <option value=0 hidden selected>Filtrer par base</option>
                <option value=1>Base tomate</option>
                <option value=2>Base creme</option>
        </select>

        <ul class="list-pizza">
            <?php
                $return_info = return_info_produit(1);
                $info_produit = $return_info->fetchAll();

                $return_info_new = return_info_new(1);
                $info_produit_new = $return_info_new->fetchAll();
                $array_new = array();

                foreach ($info_produit_new as $res) {
                    $prix = $res["prix"];
                    $nom_produit = $res["label"];
                    $img = $res["img"];
                    $new = $res["new"];
                    $id = $res['id'];
                    
                    $return_img = return_img($img);
                    $img_produit = $return_img->fetchAll();

                    foreach ($img_produit as $res) {
                        $image = $res["nom"];
                    }
                    array_push($array_new, $id);
            ?>
                <a href="pages/produit.php?idProduit=<?= $id ?>">
                    <div class="pizza">
                        <img src="resources/photos/produits/<?= $image ?>" alt="<?= $nom_produit ?>">
                        <div class="nom-pizza"><?= $nom_produit ?>
                        <br><span class="prix"><?= $prix ?>€</span></div>
                        <?php if($new == 1) { echo '<div class="notif"><p>Nouveaute</p></div>'; }?>
                    </div>
                </a>
             <?php }


                foreach ($info_produit as $res) {
                    $prix = $res["prix"];
                    $nom_produit = $res["label"];
                    $img = $res["img"];
                    $new = $res["new"];
                    $id = $res['id'];
                    
                    $return_img = return_img($img);
                    $img_produit = $return_img->fetchAll();

                    foreach ($img_produit as $res) {
                        $image = $res["nom"];
                    }
                    if (!in_array($id, $array_new)) {

            ?>
                <a href="pages/produit.php?idProduit=<?= $id ?>">
                    <div class="pizza">
                        <img src="resources/photos/produits/<?= $image ?>" alt="<?= $nom_produit ?>">
                        <div class="nom-pizza"><?= $nom_produit ?>
                        <br><span class="prix"><?= $prix ?>€</span></div>
                    </div>
                </a>
             <?php }} ?>
        </ul>
    </section>


    <!-- SECTION PATES -->
    <section id="pate">
        <div class="pate-header">

            <div class="textes">
                <div class="stars">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>

                <h2 class="titre">Les pates</h2>

                <div class="stars">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
            </div>
        </div>
        
        <ul class="list-pate">
            <?php
                $return_info = return_info_produit(3);
                $info_produit = $return_info->fetchAll();
                $return_info_new = return_info_new(3);
                $info_produit_new = $return_info_new->fetchAll();
                $array_new = array();

                foreach ($info_produit_new as $res) {
                    $prix = $res["prix"];
                    $nom_produit = $res["label"];
                    $img = $res["img"];
                    $new = $res["new"];
                    $id = $res['id'];
                    
                    $return_img = return_img($img);
                    $img_produit = $return_img->fetchAll();

                    foreach ($img_produit as $res) {
                        $image = $res["nom"];
                    }
                    array_push($array_new, $id);
            ?>
                    <a href="pages/produit.php?idProduit=<?= $id ?>">
                        <div class="pate">
                            <img src="resources/photos/produits/<?= $image ?>" alt="">
                            <div class="nom-pate"><?= $nom_produit ?>
                            <br><span class="prix"><?= $prix ?>€</span></div>
                            <?php if($new == 1) { echo '<div class="notif"><p>Nouveauté</p></div>'; }?>
                        </div>
                    </a>
                    <?php
                }
                foreach ($info_produit as $res) {
                    $prix = $res["prix"];
                    $nom_produit = $res["label"];
                    $img = $res["img"];
                    $new = $res["new"];
                    $id = $res['id'];
                    
                    $return_img = return_img($img);
                    $img_produit = $return_img->fetchAll();

                    foreach ($img_produit as $res) {
                        $image = $res["nom"];
                    }
                    if (!in_array($id, $array_new)) {
                ?>
                    <a href="pages/produit.php?idProduit=<?= $id ?>">
                        <div class="pate">
                            <img src="resources/photos/produits/<?= $image ?>" alt="">
                            <div class="nom-pate"><?= $nom_produit ?>
                            <br><span class="prix"><?= $prix ?>€</span></div>
                        </div>
                    </a>
                <?php }} ?>
        </ul>
    </section>


    <!-- SECTION PANINI -->
    <section id="panini">
        <div class="panini-header">
            
            <div class="textes">
                <div class="stars">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>

                <h2 class="titre">Les paninis</h2>

                <div class="stars">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                </div>
            </div>
        </div>

        <ul class="list-panini">
            <?php
                $return_info = return_info_produit(2);
                $info_produit = $return_info->fetchAll();

                $return_info_new = return_info_new(2);
                $info_produit_new = $return_info_new->fetchAll();
                $array_new = array();

                foreach ($info_produit_new as $res) {
                    $prix = $res["prix"];
                    $nom_produit = $res["label"];
                    $img = $res["img"];
                    $new = $res["new"];
                    $id = $res['id'];
                    
                    $return_img = return_img($img);
                    $img_produit = $return_img->fetchAll();

                    foreach ($img_produit as $res) {
                        $image = $res["nom"];
                    }
                    array_push($array_new, $id);
            ?>
                    <a href="pages/produit.php?idProduit=<?= $id ?>">
                        <div class="panini">
                            <img src="resources/photos/produits/<?= $image ?>" alt="">
                            <div class="nom-panini"><?= $nom_produit ?>
                            <br><span class="prix"><?= $prix ?>€</span></div>
                            <?php if($new == 1) { echo '<div class="notif"><p>Nouveauté</p></div>'; }?>
                        </div>
                    </a>
            <?php
                }
                foreach ($info_produit as $res) {
                    $prix = $res["prix"];
                    $nom_produit = $res["label"];
                    $img = $res["img"];
                    $new = $res["new"];
                    $id = $res['id'];
                    
                    $return_img = return_img($img);
                    $img_produit = $return_img->fetchAll();

                    foreach ($img_produit as $res) {
                        $image = $res["nom"];
                    }
                    if (!in_array($id, $array_new)) {
            ?>
                    <a href="pages/produit.php?idProduit=<?= $id ?>">
                        <div class="panini">
                            <img src="resources/photos/produits/<?= $image ?>" alt="">
                            <div class="nom-panini"><?= $nom_produit ?>
                            <br><span class="prix"><?= $prix ?>€</span></div>
                        </div>
                    </a>
            <?php }} ?>
        </ul>
    </section>


    <!-- SECTION DESSERTS -->
    <section id="dessert">
    <div class="dessert-header">
        <div class="textes">
            <div class="stars">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
            </div>

            <h2 class="titre">Les boissons et desserts</h2>

            <div class="stars">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
            </div>
        </div>
    </div>
        <ul class="list-dessert">
            <?php
                $return_info = return_info_produit(5);
                $info_produit = $return_info->fetchAll();

                $return_info_new = return_info_new(5);
                $info_produit_new = $return_info_new->fetchAll();
                $array_new = array();

                foreach ($info_produit_new as $res) {
                    $prix = $res["prix"];
                    $nom_produit = $res["label"];
                    $img = $res["img"];
                    $new = $res["new"];
                    $id = $res['id'];
                    
                    $return_img = return_img($img);
                    $img_produit = $return_img->fetchAll();

                    foreach ($img_produit as $res) {
                        $image = $res["nom"];
                    }
                    array_push($array_new, $id);
            ?>
                    <div class="dessert">
                        <img src="resources/photos/produits/<?= $image ?>" alt="">
                        <div class="nom-dessert"><?= $nom_produit ?>
                        <br><span class="prix"><?= $prix ?>€</span></div>
                        <?php if($new == 1) { echo '<div class="notif"><p>Nouveauté</p></div>'; }?>
                    </div>
            <?php
                }
                foreach ($info_produit as $res) {
                    $prix = $res["prix"];
                    $nom_produit = $res["label"];
                    $img = $res["img"];
                    $new = $res["new"];
                    
                    $return_img = return_img($img);
                    $img_produit = $return_img->fetchAll();

                    foreach ($img_produit as $res) {
                        $image = $res["nom"];
                    }
                    if (!in_array($id, $array_new)) {
            ?>
                    <div class="dessert">
                        <img src="resources/photos/produits/<?= $image ?>" alt="">
                        <div class="nom-dessert"><?= $nom_produit ?>
                        <br><span class="prix"><?= $prix ?>€</span></div>
                    </div>
            <?php }} ?>
        </ul>
        <ul class="list-dessert">
            <?php
                $return_info = return_info_produit(4);
                $info_produit = $return_info->fetchAll();

                $return_info_new = return_info_new(4);
                $info_produit_new = $return_info_new->fetchAll();
                $array_new = array();

                foreach ($info_produit_new as $res) {
                    $prix = $res["prix"];
                    $nom_produit = $res["label"];
                    $img = $res["img"];
                    $new = $res["new"];
                    $id = $res['id'];
                    
                    $return_img = return_img($img);
                    $img_produit = $return_img->fetchAll();

                    foreach ($img_produit as $res) {
                        $image = $res["nom"];
                    }
                    array_push($array_new, $id);
            ?>
                    <div class="dessert">
                        <img src="resources/photos/produits/<?= $image ?>" alt="">
                        <div class="nom-dessert"><?= $nom_produit ?>
                        <br><span class="prix"><?= $prix ?>€</span></div>
                        <?php if($new == 1) { echo '<div class="notif"><p>Nouveauté</p></div>'; }?>
                    </div>
            <?php
                }
                foreach ($info_produit as $res) {
                    $prix = $res["prix"];
                    $nom_produit = $res["label"];
                    $img = $res["img"];
                    $new = $res["new"];
                    
                    $return_img = return_img($img);
                    $img_produit = $return_img->fetchAll();

                    foreach ($img_produit as $res) {
                        $image = $res["nom"];
                    }
                    if (!in_array($id, $array_new)) {
            ?>
                    <div class="dessert">
                        <img src="resources/photos/produits/<?= $image ?>" alt="">
                        <div class="nom-dessert"><?= $nom_produit ?>
                        <br><span class="prix"><?= $prix ?>€</span></div>
                    </div>
            <?php }} ?>
        </ul>
    </section>

    <section id="footer">
        <div class="produits">
            <h2 class="titre">Nos produits</h2>
            <ul class="list">
                <li class="list-item"><a href="#pizza">P'zzas</a></li>
                <li class="list-item"><a href="#pate">Nos snacks</a></li>
                <li class="list-item"><a href="#dessert">Boissons et desserts</a></li>
            </ul>
        </div>

        <div class="pizzaria">
            <h2 class="titre">Old school P'zza</h2>
            <ul class="list">
                <li class="list-item"><a href="pages/engagements#enga">Nos engagements</a></li>
                <li class="list-item"><a href="pages/engagements#galerie">La pizzeria</a></li>
            </ul>
        </div>

        <div class="contact">
            <h2 class="titre">Contact</h2>
            <ul class="list">
                <li class="list-item"><a href="pages/devis">Faire un devis</a></li>
                <li class="list-item"><a href="tel:06 95 13 00 79">06 95 13 00 79</a></li>
            </ul>
        </div>

        <div class="mentions">
            <h2 class="titre">Divers</h2>
            <ul class="list">
                <li class="list-item"><a href="pages/mentions-cgv#mentions">Mentions Legales</a></li>
                <li class="list-item"><a href="pages/mentions-cgv#cgv">Conditions generales de vente</a></li>
            </ul>
        </div>
    </section>
</body>
</html>