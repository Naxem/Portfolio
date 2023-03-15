<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Connexion</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="entier">
        <section>
            <nav class="menu_top">
                <nav class="icon">
                    <div class="image"> IMAGE </div>
                </nav>
                <nav class="titre_top">
                    <p> Clinique LPF </p>
                </nav>
                <nav class="connexion">
                    <p><button class="boutonR" onclick="window.location.href = '../index.html'">Retour</button></p>
                </nav>
            </nav>
        </section>

        <form action="loginTest.php" method="POST">
            <?php if(!empty($_SESSION["status"]) && $_SESSION['status'] != '') { ?>
            <div class="erreur"><?= $_SESSION["status"] ?></div>
            <?php } ?>

            <div class="menu">  
                <div class="txt"><p> <p id='lgn'>Identifiant : <br></p><input type="text" name="txt-login" value="" class="champs"></p>
                <p><p id='mdp'>Mot de passe :</p> <input type="password" name="txt-password" value=""class="champs"></p></div>

                <div class="g-recaptcha" name="recaptcha-response" data-sitekey="6LccV9gkAAAAAKxU2PUoYVhSRI14gpnjbzSGLNTK"></div><br/>
                <p><input type="submit" name="btn-connexion" value="Connexion" class="bouton"></p>
            </div>
        </form>

        <!--<form action="loginTest.php" method="POST">
            <div class="menu"> 
                <p>Entrer les infos suivant pour créer un utilisateur</p> 
                <div class="txt"><p> <p id='lgn'>Identifiant : <br></p><input type="text" name="txt-login" value="" class="champs"></p>
                <p><p id='mdp'>Mot de passe :</p> <input type="password" name="txt-password" value=""class="champs"></p></div> 
                <p><input type="submit" name="btn-crea-user" value="Creer un utilisateur" class="bouton"></p>
            </div>
        </form>-->
    </div>
</body>
</html>