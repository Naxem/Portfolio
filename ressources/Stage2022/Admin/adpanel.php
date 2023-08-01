<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
</head>
<body>
    <form action="update.php" method="POST">
        <label for="">Entrez le nom de l'image : </label>
        <input type="text" name="nameImg" id="nameImg">
        <br>
        <label for="">1 : Tatouage Seb / 2 : Tatouage Yoan  / 3 : Piercing / 4 : Dermographie Réparatrice</label>
        <br>
        <label for="">Cochez les casse pour les filtres de la photo : </label>
        <input type="checkbox" name="tattooS" id="tattooS" value="Tatouage Seb">
        <input type="checkbox" name="tattooY" id="tattooY" value="Tatouage Yoan">
        <input type="checkbox" name="piercing" id="piercing" value="Piercing">
        <input type="checkbox" name="dermoRepa" id="dermoRepa" value="Dermographie Réparatrice">
        <br>
        <input type="submit" value="Ajouter">
    </form>
</body>
</html>