<?php
require('config.php');

// @TODO
// Get the feeds from the table

$mysqli = new mysqli($host, $user, $password, $database);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$max_items = 10;

$feeds_query = "SELECT * FROM feeds";
$feeds = $mysqli->query($feeds_query);

while ($feed = $feeds->fetch_assoc()) {
    $xml = simplexml_load_file($feed['url']);
    $items = $xml->channel->item;
    if (empty($items)) {
        $items = $xml->entry;
    }
    if (empty($items)) {
        $items = $xml->item;
    }
    for ($i = 0; $i < $max_items; $i++) {
        $link = $items[$i]->link;
        if (strpos($link, 'http') === false) {
            $link = $items[$i]->link->attributes();
            $link = $link['href'];
        }
        $check_query = sprintf(
            "SELECT URL FROM rss WHERE url = '%s'",
                 $mysqli->escape_string($link)
        );
        $check = $mysqli->query($check_query);
        $check->data_seek(0);
        $row = $check->fetch_assoc();
        if (empty($row)) {
            $insert = sprintf(
                "INSERT INTO rss (title, url, site, is_read, is_starred) VALUES ('%s', '%s', '%s', 0, 0)",
                 $mysqli->escape_string($items[$i]->title),
                 $mysqli->escape_string($link),
                 $mysqli->escape_string($xml->channel->title)
            );
            $mysqli->query($insert);
        }
    }
}
