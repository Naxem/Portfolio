<?php
    $rss_link = "https://www.lebigdata.fr/feed";
    $rss_load = simplexml_load_file($rss_link);
    foreach ($rss_load->channel->item as $item) {
        echo $item->title;
        echo "<br>";
        echo $item->category;
        echo "<br>";
        echo $item->description;
        echo "<br>";
        echo $item->link;
        echo "<br><br><br><br>";
    }
?>