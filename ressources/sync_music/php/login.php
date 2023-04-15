<?php
    session_start();
    $_SESSION["ifCreationCompte"] = $_GET["conexion"];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <title>Connexion</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
<?php if($_SESSION["ifCreationCompte"] == 1) { ?>
        <form action="login_authentification.php" method="POST">
            <?php if(!empty($_SESSION["status"]) && $_SESSION['status'] != '') { ?>
            <div class="erreur"><?= $_SESSION["status"] ?></div>
            <?php } ?>

            <div class="input">
                <label for="txt-login">Votre identifiant</label>
                <input type="text" name="txt-login" required>
            </div>
            
            <div class="input">
                <label for="txt-password">Votre mot de passe</label>
                <input type="password" name="txt-password" required>
            </div>

            <div class="g-recaptcha" name="recaptcha-response" data-sitekey="6LcsftUkAAAAAFWMl89rImuOTCdUmG7Si9LnMZr1"></div><br/>
            
            <input type="submit" name="btn-connexion" value="Connexion">
            <a href="login?conexion=0">Créer un compte</a>
        </form>
    <?php } elseif($_SESSION["ifCreationCompte"] == 0) {?>
        <form action="login_authentification.php" method="POST">
            <?php if(!empty($_SESSION["status"]) && $_SESSION['status'] != '') { ?>
            <div class="erreur"><?= $_SESSION["status"] ?></div>
            <?php } ?>

            <div class="input">
                <label for="txt-login">Votre identifiant</label>
                <input type="text" name="txt-login" required>
            </div>
            
            <div class="input">
                <label for="txt-password">Votre mot de passe</label>
                <input type="password" name="txt-password" required>
            </div>

            <div class="g-recaptcha" id="g-recaptcha" data-sitekey="6LcsftUkAAAAAFWMl89rImuOTCdUmG7Si9LnMZr1"></div><br/>
            
            <input type="submit" name="btn-creer" value="Créer">
            <a href="login?conexion=1">Conexion</a>
        </form>
    <?php }else { ?>
        <form>
            <p>Error loading page</p>
        </form>
    <?php } ?>
</body>
</html>