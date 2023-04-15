<?php
    require("requetes.php");
    if((empty($_SESSION["id"])) || ($_SESSION["id"] == 0)) {
        header("Location: php/login");
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/navFooter.css">
    <link rel="stylesheet" href="../css/findPlayliste.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <title>Find Playliste</title>
</head>
<nav>        
    <div class="main-navlinks">
        <button class="hamburger" type="button" aria-label="Toggle navigation" aria-expanded="false">
                <span></span>
                <span></span>
                <span></span>
        </button>
        <div class="navlinks-container">
            <a href="../index" aria-current="main">Accueil</a>
            <a href="deconexion" aria-current="deconexion">deconexion</a>
            <a href="<?= $_SESSION["role"] ?>" aria-current="profile">profile</a>
            <a href="amis" aria-current="ajout d'amis">amis</a>
        </div>
    </div>
    <!--JS-->
    <script src="js/navBare.js"></script>
</nav>
<body>
    <section>
<?php
    $return_all_playliste = return_playlist();
    $all_playliste = $return_all_playliste->fetchAll();
    foreach($all_playliste as $res) {
?>
    <div class="div-p">
        <a class="nomPlayliste" href="playlist?playlist=<?= $res["Labelle"]?>"><?= $res["Labelle"]?></a>
    </div>
<?php } ?>
    </section>
</body>
<footer>
        <div class="content-footer">
            <div class="bloc footer-services">
                <center>
                    <h3>Services</h3>
                    <ul class="services-list">
                        <li><span class="span-footer"><a>Trouver de Playlistes</a></span></li>
                        <li><span class="span-footer"><a>Trouver des amis</a></span></li>
                        <li><span class="span-footer"><a>écouté de la music</a></span></li>
                    </ul>
                </center>
            </div>

            <div class="bloc footer-contact" id="contact">
                <center>
                    <h3>Me contacter</h3>
                    <a href="mailto: maxens2009@outlook.fr">maxens2009@outlook.fr</a>
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
                        <li><a href="https://github.com/Naxem" target="_blank">
                            <img src="../ressources/images/logo_github.png" alt="logo github">
                            GitHub</a>
                        </li>
                        <li><a href="https://linkedin.com/in/maxens-telle-99a43a265" target="_blank">
                            <img src="../ressources/images/logo_linkedin.png" alt="logo linkedin">
                            Linkedin</a>
                        </li>
                    </ul>
                </center>
            </div>
        </div>

        <div class="mentionLegal">
            <center>
                <a href="../mentionLegal">Mentions légales</a>
            </center>
        </div>
</footer>
</html>