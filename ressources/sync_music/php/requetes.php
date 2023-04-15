<?php
  require("conexion_bdd.php");
  session_start();
  $_SESSION["date"] = date("Y-m-d");
  date_default_timezone_set('Europe/Paris');// Définit le fuseau horaire à Paris
  $_SESSION["heure"] = date('H:i:s');

  if(isset($_POST["btn-addPlaylist"])) {
    $labelle = $_POST["txt-nom"];
    if((empty($labelle)) || ($labelle === "")) {
      $_SESSION["status_uploade"] = "Nom de la playliste vide";
      $_SESSION["reussi"] = false;
      header("Location: admin");
    } else {
      create_playlist($labelle);
      $_SESSION["status_uploade"] = "Nom de la playliste Valide";
      $_SESSION["reussi"] = true;
      header("Location: admin");
    }
  }

  if (isset($_POST['btn-addMusic'])) {
    uploadFichier($_POST["s_playlist"]);
    header("Location: admin");
  }

  //return
  function return_id_role($login) {
    $pdo = connexion_bdd();
    $stmt = $pdo ->prepare("select role from users where Login = ?;");
    $stmt->execute(array($login));
    return $stmt;
  }

  function return_playlist_by_id() {
    $pdo = connexion_bdd();
    $sql="select Labelle from playlist
    where User = ?;";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array($_SESSION["id"]));
    return $stmt;
  }

  function return_playlist_x_music($labelle) {
    $pdo = connexion_bdd();
    $sql="select m.Labelle from playlist_x_music pxm
    inner join playlist p on pxm.idPlaylist = p.idPlaylist
    inner join music m on pxm.idMusic = m.idMusic
    where p.Labelle = ?;";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array($labelle));
    return $stmt;
  }

  function return_users() {
    $pdo = connexion_bdd();
    $sql="SELECT Login, derniere FROM users
    WHERE role NOT IN (1, 2)
    ORDER BY Login ASC;";
    $stmt=$pdo->prepare($sql);
    $stmt->execute();
    return $stmt;
  }

  function return_staff() {
    $pdo = connexion_bdd();
    $sql="SELECT Login, derniere FROM users
    WHERE role != 3
    ORDER BY Login ASC;";
    $stmt=$pdo->prepare($sql);
    $stmt->execute();
    return $stmt;
  }

  function return_playlist() {
    $pdo = connexion_bdd();
    $sql="select Labelle from playlist;";
    $stmt=$pdo->prepare($sql);
    $stmt->execute();
    return $stmt;
  }

  function return_count_music($labelle) {
    $pdo = connexion_bdd();
    $sql="select count(Labelle) from music
    where Labelle LIKE CONCAT('%', ?, '%');";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array($labelle));
    return $stmt;
  }

  function return_id_playlist($labelle) {
    $pdo = connexion_bdd();
    $sql="select idPlaylist from playlist
    where Labelle = ?;";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array($labelle));
    return $stmt;
  }

  function return_name_playlist($idP) {
    $pdo = connexion_bdd();
    $sql="select Labelle from playlist
    where idPlaylist = ?;";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array($idP));
    return $stmt;
  }

  function return_id_music($labelle) {
    $pdo = connexion_bdd();
    $sql="select idMusic from music
    where Labelle = ?;";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array($labelle));
    return $stmt;
  }

  function return_name_music($id) {
    $pdo = connexion_bdd();
    $sql="select Labelle from music
    where idMusic = ?;";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array($id));
    return $stmt;
  }

  //add music
  function uploadFichier($playliste) {
    $extentionValides = array('mp3');
    $fichierUpload = strtolower(substr(strchr($_FILES["musique"]["name"], '.'), 1));
    if(in_array($fichierUpload, $extentionValides)) {
        $nomMusic = $_FILES["musique"]["name"];
        $cheminFichier = "../ressources/music/".$nomMusic;
        if(move_uploaded_file($_FILES['musique']["tmp_name"], $cheminFichier)) {
          $_SESSION["status_uploade"] = "Fichier envoyé avec succès !";
        } else {
          switch($_FILES['musique']["error"]) {
            case 1:
              $_SESSION["status_uploade"] = "La taille du fichier uploadé dépasse la valeur de upload_max_filesize";
              break;
            case 2:
              $_SESSION["status_uploade"] = "La taille du fichier uploadé dépasse la valeur de MAX_FILE_SIZE";
              break;
            case 3:
              $_SESSION["status_uploade"] = "Le fichier n'a été que partiellement uploadé";
              break;
            case 4:
              $_SESSION["status_uploade"] = "Aucun fichier n'a été uploadé";
              break;
            case 5:
              $_SESSION["status_uploade"] = "Erreur type 5";
              break;
            case 6:
              $_SESSION["status_uploade"] = "Le dossier temporaire est manquant";
              break;
            case 7:
              $_SESSION["status_uploade"] = "Échec de l'écriture du fichier sur le disque";
              break;
            case 8:
              $_SESSION["status_uploade"] = "Une extension PHP a bloqué l'upload du fichier";
              break;
            default:
            $_SESSION["status_uploade"] = "Erreur inconue";
              break;
          }
        }

        if(is_readable($cheminFichier)) {
          $count_music = return_count_music($nomMusic);
          $isExiste = $count_music->fetchAll();
          foreach($isExiste as $res) {if(!$res["count(Labelle)"] > 0) {insert_music($nomMusic, $_SESSION["date"]);}}

          $id_playlist = return_id_playlist($playliste);
          $idPL = $id_playlist->fetchAll();
          foreach($idPL as $res) {$idPL = $res["idPlaylist"];}

          $id_music = return_id_music($nomMusic);
          $idM = $id_music->fetchAll();
          foreach($idM as $res) {$idM = $res["idMusic"];}

          insert_music_in_playliste($idPL, $idM);
          $_SESSION["reussi"] = true;
        } else {
          echo "imposible d'update la Base de donnée";
          $_SESSION["reussi"] = false;
        }
    }
  }

  function insert_music($labelle, $date) {
    $pdo = connexion_bdd();
    $sql="INSERT INTO music
    (Labelle, `Date`) VALUES(?, ?);";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array($labelle, $date));
  }

  function insert_music_in_playliste($idPL, $idM) {
    $pdo = connexion_bdd();
    $sql="INSERT INTO playlist_x_music
    (idPlaylist, idMusic) VALUES(?, ?);";
    $stmt=$pdo->prepare($sql);
    $stmt->execute(array($idPL, $idM));
  }

  //play & pause
  function play_music($labelle, $timecode) {
    $return_id_music = return_id_music($labelle);
    $id_music = $return_id_music->fetchAll();
    foreach($id_music as $res) {$idM = $res["idMusic"];}
    $pdo = connexion_bdd();
    $stmt = $pdo ->prepare("INSERT INTO play
    (idMusic, idPlaylist, IdUser, heureDebut, timeCode)
    VALUES(?, ?, ?, ?, ?);");
    $stmt->execute(array($idM, $_SESSION["id_playliste"], $_SESSION["id"], $_SESSION["heure"], $timecode));
  }

  function pause_music() {
    $pdo = connexion_bdd();
    $stmt = $pdo ->prepare("DELETE FROM play
    WHERE IdUser = ?;");
    $stmt->execute(array($_SESSION["id"]));
  }

  function return_time_code($idU) {
    $pdo = connexion_bdd();
    $stmt = $pdo ->prepare("select timeCode, heureDebut from play
    where IdUser = ?;");
    $stmt->execute(array($idU));
    return $stmt;
  }

  function return_idM($idU) {
    $pdo = connexion_bdd();
    $stmt = $pdo ->prepare("select idMusic from play
    where IdUser = ?;");
    $stmt->execute(array($idU));
    return $stmt;
  }

  //Créa playliste
  function create_playlist($labelle) {
    $pdo = connexion_bdd();
    $labelle = htmlspecialchars($labelle);
    $stmt = $pdo ->prepare("INSERT INTO playlist
    (Labelle, User) VALUES(?, ?);");
    $stmt->execute(array($labelle, $_SESSION["id"]));
  }

  //find user
  function return_all_user() {
    $pdo = connexion_bdd();
    $stmt = $pdo ->prepare("select Login from users");
    $stmt->execute();
    return $stmt;
  }

  function return_id_music_by_played($idU) {
    $pdo = connexion_bdd();
    $stmt = $pdo ->prepare("select * from play where IdUser = ?");
    $stmt->execute(array($idU));
    return $stmt;
  }

  //Conexion
  function authentification($login) {
    $pdo = connexion_bdd();
    $login = htmlspecialchars($login);
    $stmt=$pdo->prepare("SELECT count(Login), MDP FROM users
    where Login = ?;");
    $stmt->execute(array($login));
    return $stmt;
  }

  function return_id_user($login) {
    $pdo = connexion_bdd();
    $login = htmlspecialchars($login);
    $stmt = $pdo ->prepare("SELECT IdUser FROM users
    where Login = ?;");
    $stmt->execute(array($login));
    return $stmt;
  }

  //logs
  function log_conexion($label, $date, $heure, $user, $idRole) {
    $pdo = connexion_bdd();
    $stmt = $pdo ->prepare("INSERT INTO logs
    (Label, `Date`, Heure, User, `Role`)
    VALUES(?, ?, ?, ?, ?);");
    $stmt->execute(array($label, $date, $heure, $user, $idRole));
    return $stmt;
  }

  //création de compte
  function create_users($login, $mdp, $date, $role) {
    $pdo = connexion_bdd();
    $role = filter_var($role, FILTER_SANITIZE_NUMBER_INT);
    $stmt = $pdo ->prepare("INSERT INTO users
    (Login, MDP, derniere, `role`)
    VALUES(?, ?, ?, ?);");
    $stmt->execute(array($login, $mdp, $date, $role));
    return $stmt;
  }
?>