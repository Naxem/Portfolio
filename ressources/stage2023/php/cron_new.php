<?php
    require("requette.php");

    $cron_new = cron_new();
    $return_new = $cron_new->fetchAll();
    foreach($return_new as $res) {
        $id = $res["id"];
        $intervale = $res["interval_date"];

        if($intervale >= 30) {
            cron_update_new($id);
        }
    } 
?>