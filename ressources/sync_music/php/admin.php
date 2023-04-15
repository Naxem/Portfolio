<?php
    require("requetes.php");
    if((empty($_SESSION["id"])) || ($_SESSION["role"] != "admin") || (empty($_SESSION['role']))) {
        $_SESSION["status"] = "Vous n'etes pas autorize !";
        header("Location: login?conexion=1");
    }

    if(empty($_SESSION["reussi"])) {
        $_SESSION["reussi"] = false;
    } else {
        $_SESSION["reussi"] =  $_SESSION["reussi"];
    }
    if(empty($_SESSION["status_uploade"])) {
        $_SESSION["status_uploade"] = "vide";
    } else {
        $_SESSION["status_uploade"] =  $_SESSION["status_uploade"];
    }

    $liste_users = return_users();
    $users = $liste_users->fetchAll();

    $liste_staff = return_staff();
    $staff = $liste_staff->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/navFooter.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <title>Panel_Admin</title>
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
            <a href="../amis" aria-current="ajout d'amis">amis</a>
        </div>
    </div>
    <!--JS-->
    <script src="js/navBare.js"></script>
</nav>
<body>
    <?php if(($_SESSION["reussi"]) && ($_SESSION["status_uploade"] != "")) { ?>
        <div class="reussi"><?= $_SESSION["status_uploade"] ?></div>
    <?php } elseif((!$_SESSION["reussi"]) && ($_SESSION["status_uploade"] == "")) { ?>
        <div class="erreur"><?= $_SESSION["status_uploade"] ?></div>
    <?php } else {?>
        <div hidden class="erreur"><?= $_SESSION["status_uploade"] ?></div>
    <?php } ?>

    <form class="form-addPlayliste" action="requetes.php" method="post">
        <p>Ajouter une playliste : </p>
        <input type="text" name="txt-nom" placeholder="Nom de la playliste" class="input-nomPL">
        <input type="submit" value="Ajouter" name="btn-addPlaylist" class="input-btnAdd">
    </form>

    <form action="requetes.php" method="post" enctype="multipart/form-data" class="form-addMusic">
        <p>Ajouter une music dans une playliste : </p>
        <input type="file" name="musique" class="input-addFile">
        <select name="s_playlist" class="select-playliste">
            <option value="default" selected disabled>Choisire dans quelle playliste</option>
            <?php
            $return_playliste = return_playlist();
            $liste_playliste = $return_playliste->fetchAll();
            foreach($liste_playliste as $res) {
                echo '<option value='.$res["Labelle"].'>'.$res["Labelle"].'</option>';
            }
            ?>
        </select>
        <input type="submit" value="Ajouter" name="btn-addMusic" class="input-btnAdd">
    </form>

    <section>
        <div>
            <h2>Liste des users :</h2>
            <ul>
                <li><p>Login</p><p>Dernière conexion</p></li>
                <?php
                foreach($users as $res) {
                    $liU = $res['Login']; 
                    $liD = $res['derniere'];
                    echo "<li class='li-users'><p class='login'>".$liU."</p><p class='dateC'>".$liD."</p></li>";
                }
                ?>
            </ul>
        </div>

        <div>
        <h2>Liste Staff :</h2>
        <ul>
            <li><p>Login</p><p>Dernière conexion</p></li>
            <?php
            foreach($staff as $res) {
                $liU = $res['Login']; 
                $liD = $res['derniere'];
                echo "<li class='li-users'><p class='login'>".$liU."</p><p class='dateC'>".$liD."</p></li>";
            }
            ?>
        </ul>
        </div>
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
                <p>Tous droit réserver @Telle Maxens 2023</p>
            </center>
        </div>
</footer>
</html>
