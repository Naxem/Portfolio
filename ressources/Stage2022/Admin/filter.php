<?php
    session_start();
    require('config.php');
?>
<?php
    $request = $_POST['request'];

    if ($_POST['request']) {
        $pdo = connexion_bdd();
        $sql = "SELECT * FROM images WHERE $request = 1 order by date";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    }

    if ($_SESSION['page'] == false and $request == "dermoRepa") {
?>
<!DOCTYPE html>
<body>
    <form action="galerie.php" method="POST">
        <div class="container">
            <label>Avez-vous plus de 18 ans</label>
            <center>
            <input type="submit" class="btn-classe btn" name="btn-non" value="Non">
            <input type="submit" class="btn-classe btn" name="btn-oui" value="Oui">
            </center>
        </div>
    </form>
</body>
<?php
    }
    else {
        while($row = $stmt->fetch()) {
            echo '<div class="grid-item img-grid">
                <img class="img-grid" src="Ressources/img/' . $row['name'] .'.jpg" width=100 height=100 alt="Photo $request">
            </div>';
        }
    }  
?>