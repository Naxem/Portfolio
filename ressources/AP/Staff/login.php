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
    <link rel="stylesheet" href="../css/navbar.css">
</head>
<body>
    <div class="nav">
        <input type="checkbox" id="nav-check">
        <div class="nav-header">
            <div class="nav-title">
                <a href="../index.html"><img src="../ressources/medical.png" style="margin-top:-10px;width: 50px;height:50px;"></a>
            </div>
        </div>
        <div class="nav-btn">
            <label for="nav-check">
                <span></span>
                <span></span>
                <span></span>
            </label>
        </div>
        
        <div class="nav-links">
            <a href="../index.html">Retour</a>
        </div>
    </div>

    <div class="globale">
        <form action="loginTest.php" method="POST">
            <?php if(!empty($_SESSION["status"]) && $_SESSION['status'] != '') { ?>
            <div class="erreur"><?= $_SESSION["status"] ?></div>
            <?php } ?>

                <label for="login" id='lgn'>Identifiant : </label>
                <input type="text" name="txt-login" value="" class="champs"><br>
                
                <label for="password" id='lgn'>Mot de passe : </label>
                <input type="password" name="txt-password" value="" class="champs">
                <br>

                <div class="g-recaptcha" name="recaptcha-response" data-sitekey="6LccV9gkAAAAAKxU2PUoYVhSRI14gpnjbzSGLNTK"></div><br/>
                <input type="submit" name="btn-connexion" value="Connexion" class="bouton">
        </form>
    </div>
</body>
</html>