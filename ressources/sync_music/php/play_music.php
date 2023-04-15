<?php
    require("requetes.php");
    $request = $_POST['request'];
    $timeCode = $_POST['timeCode'];
    if($_POST['request']) {
        play_music($request, $timeCode);
    }
?>