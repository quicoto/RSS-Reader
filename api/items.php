<?php

require('_connection.php');

$query = "SELECT * FROM rss where is_read = 0 order by site, id asc";

if (isset($_GET['starred'])) {
    $query = "SELECT * FROM rss where is_starred = 1 order by site, id desc";
}
if (isset($_GET['all'])) {
    $query = "SELECT * FROM rss order by site, id desc";
}
if (isset($_GET['search'])) {
    $query = "SELECT * FROM rss where title like '%{$_GET['search']}%' order by site, id desc";
}

$result = $mysqli->query($query);
$result->data_seek(0);
$site_last = "";
$site = "diff";

$data = array();

while ($row = $result->fetch_assoc()) {
  array_push($data, $row);
}

header('Content-Type: application/json');

echo json_encode($data);