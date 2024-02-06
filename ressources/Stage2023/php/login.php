<?php
    session_start();

    if(isset($_POST["btn-deco"])) {
        session_destroy();
        session_start();
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style/login.css">

    <title>Connexion</title>
</head>
<body>

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
        
        <input type="submit" name="btn-connexion" value="Connexion">
    </form>
</body>
</html>