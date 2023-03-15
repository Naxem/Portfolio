<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pannel Admin</title>
</head>
<body>
    <section>
        <h1>ADMIN</h1>
        <form action="requete.php" method="POST">
            <p>Num Secu</p>
            <input type="text" placeholder="Entrée le num secu d'un patient" name="numSecuPatient">
            <input type="submit" value="Supprimer un patient" name="btn-supp">
        </form>
    </section>
</body>
</html>