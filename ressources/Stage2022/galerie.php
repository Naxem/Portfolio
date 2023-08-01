<?php
    require('Admin/config.php');
    session_start();
    $_SESSION['page'] = false;

    if (isset($_POST['btn-non'])) {
        $_SESSION['page'] = false;
    }
    if (isset($_POST['btn-oui'])) {
        $_SESSION['page'] = true;
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="CSS/galerie.css" class="css">
    <link rel="stylesheet" href="CSS/navFooter.css"/>
    <title>Galerie</title>
    <style type="text/css">
        #filters {
            margin-left: 10%;
            margin-top: 2%;
            margin-bottom: 2%;
        }
    </style>
</head>
<header>
    <nav>
        <div class="div-title">
            <a href="index.html" id="Accueil" class="nav-icon" aria-label="visit homepage" aria-current="page">
                <span>Black Art's Tattoo</span>
            </a>
        </div>
        
        <div class="main-navlinks">
            <button class="hamburger" type="button" aria-label="Toggle navigation" aria-expanded="false">
                    <span></span>
                    <span></span>
                    <span></span>
            </button>
            <div class="navlinks-container">
                <a href="index.html" aria-current="page">Accueil</a>
                <a href="galerie.php" aria-current="Galerie">Galerie</a>
                <a href="#contact">Contact</a>
            </div>
        </div>
    </nav>
    <script src="JS/navBare.js"></script>
</header>
<body>

    <h1>Galerie photo</h1>

    <div id="filters" class="div-filter">
        <span>Filtre par &nbsp;</span>
        <select name="fetchval" id="fetchval" class="fetchval">
            <option value="" disabled="" selected="">Selectioner un filtre</option>
            <option value="tattooS">Tatouage Sébastien</option>
            <option value="tattooY">Tatouage Yoan</option>
            <!--<option value="piercing">Piercing</option>-->
            <!--<option value="dermoRepa">Dermographie Réparatrice</option>-->
        </select>
    </div>

    <div class="grille">
    <?php 
        $pdo = connexion_bdd();
        if ($_SESSION['page'] == false) {
            $sql = "SELECT * FROM images WHERE tattooS = 1 or tattooY = 1 or piercing = 1 order by date";
        }
        else if ($_SESSION['page'] == true) {
            $sql = "SELECT * FROM images WHERE tattooS = 1 or tattooY = 1 or piercing = 1 or dermoRepa = 1 order by date";
        }
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        while($row = $stmt->fetch()) {
           echo '<div class="grid-item img-grid">
               <img class="img-grid" src="Ressources/img/' . $row['name'] .'.jpg" width=100 height=100 alt="Photo $request">
           </div>';
        }
    ?>
    </div>

    <script src="JS/filter.js"></script>
</body>
<footer>
    <div class="content-footer">
        <div class="bloc footer-services">
            <center>
                <h3>Services</h3>
                <ul class="services-list">
                    <li><span class="span-footer"><a>Tatouage</a></span></li>
                    <li><span class="span-footer"><a>Piercing</a></span></li>
                    <li><span class="span-footer"><a>Dermographie Réparatrice</a></span></li>
                </ul>
            </center>
        </div>

        <div class="bloc footer-contact" id="contact">
            <center>
                <h3>Nous contacter</h3>
                <p>07.71.94.82.16</p>
                <p>09.75.39.11.24</p>
                <p>titinepurple@gmail.com</p>
                <p>35 Rue nationale, 59241 Masnières</p>
            </center>
        </div>

        <div class="bloc footer-schedule">
            <center>
                <h3>Horaires d'ouverture</h3>
                <ul class="schedule-list">
                    <li><span class="span-footer">Lundi : 15h-18h</span></li>
                    <li><span class="span-footer">Mardi : 9h-12h et 14h-18h</span></li>
                    <li><span class="span-footer">Mercredi : 9h-12h et 14h-18h</span></li>
                    <li><span class="span-footer">Jeudi : 14h-18h</span></li>
                    <li><span class="span-footer">Vendredi : 9h-12h et 14h-18h</span></li>
                    <li><span class="span-footer">Samedi : 14h-18h</span></li>
                </ul>
            </center>
        </div>

        <div class="bloc footer-medias">
            <center>
                <h3>Réseaux sociaux</h3>
                <ul class="media-list">
                    <li><a href="https://fr-fr.facebook.com/blackartstattoo" target="_blank"><svg
                        aria-hidden="true"
                        focusable="false"
                        data-prefix="fab"
                        data-icon="facebook"
                        class="svg-inline--fa fa-facebook fa-w-16"
                        role="img"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 512 512">
                        <path
                        fill="currentColor"
                        d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.78 90.69 226.38 209.25 245V327.69h-63V256h63v-54.64c0-62.15 37-96.48 93.67-96.48 27.14 0 55.52 4.84 55.52 4.84v61h-31.28c-30.8 0-40.41 19.12-40.41 38.73V256h68.78l-11 71.69h-57.78V501C413.31 482.38 504 379.78 504 256z"
                        ></path>
                        </svg>
                        Facebook</a>
                    </li>
                    <li><a href="https://www.instagram.com/blackartstattooseb/" target="_blank"><svg
                        aria-hidden="true"
                        focusable="false"
                        data-prefix="fab"
                        data-icon="instagram"
                        class="svg-inline--fa fa-instagram fa-w-14"
                        role="img"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 448 512">
                        <path
                        fill="currentColor"
                        d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"
                        ></path>
                        </svg>
                        Instagram</a>
                    </li>
                </ul>
            </center>
        </div>
    </div>

    <div class="mentionLegal">
        <center>
            <a href="mentionL.html">Mentions légales</a>
        </center>
    </div>
</footer>
</html>

