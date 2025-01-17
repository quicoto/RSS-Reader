<?php

require(__DIR__.'/_connection.php');
require(__DIR__.'/../values.php');

$query = "SELECT ".$table_items.".*, ".$table_feeds.".title as feed_title from ".$table_items." inner join ".$table_feeds." on ".$table_items.".feed_id = ".$table_feeds.".id where is_read = 0 order by date desc, id asc";

if (isset($_GET['starred'])) {
    $query = "SELECT ".$table_items.".*, ".$table_feeds.".title as feed_title from ".$table_items." inner join ".$table_feeds." on ".$table_items.".feed_id = ".$table_feeds.".id where is_starred = 1 order by date desc, id asc";
}
if (isset($_GET['all'])) {
    $query = "SELECT ".$table_items.".*, ".$table_feeds.".title as feed_title from ".$table_items." inner join ".$table_feeds." on ".$table_items.".feed_id = ".$table_feeds.".id order by date desc, id asc";
}

$result = $mysqli->query($query);
$result->data_seek(0);
$site_last = "";
$site = "diff";

$data = array();

while ($row = $result->fetch_assoc()) {
  $row['title'] = html_entity_decode($row['title'], ENT_QUOTES, 'UTF-8');

  array_push($data, $row);
}

header('Content-Type: application/json');

echo json_encode($data);