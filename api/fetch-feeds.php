<?php
require(__DIR__.'/_connection.php');
require(__DIR__.'/../values.php');
require(__DIR__.'/../utils.php');

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$feeds_query = "SELECT * FROM " . $table_feeds;
$feeds = $mysqli->query($feeds_query);

while ($feed = $feeds->fetch_assoc()) {
    if (!isXmlStructureValid($feed['url'])) { continue; }

    $xml = simplexml_load_file($feed['url']);

    if (empty($xml)) {
        continue;
    }
    $items = $xml->channel->item;
    if (empty($items)) {
        $items = $xml->entry;
    }
    if (empty($items)) {
        $items = $xml->item;
    }
    if (empty($items)) {
        continue;
    }

    for ($i = 0; $i < $fetch_feed_items_max_items; $i++) {
        if (empty($items[$i]) || empty($items[$i]->link)) { continue; }
        $link = $items[$i]->link;
        if (strpos($link, 'http') === false) {
            $link = $items[$i]->link->attributes();
            $link = $link['href'];
        }
        $check_query = sprintf(
            "SELECT * FROM ". $table_items . "  WHERE url = '%s'",
                 $mysqli->escape_string($link)
        );
        $check = $mysqli->query($check_query);
        $row = $check->fetch_assoc();

        if (!empty($row)){ continue; }

        $insert = sprintf(
            "INSERT INTO ". $table_items . " (title, url, feed_id, is_read, is_starred) VALUES ('%s', '%s', '%s', 0, 0)",
                $mysqli->escape_string($items[$i]->title),
                $mysqli->escape_string($link),
                $feed['id']
        );
        $mysqli->query($insert);
        echo $mysqli->escape_string($link) . "<br>";
    }
}
