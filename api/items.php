<?php

require('_connection.php');
require('../values.php');

$query = "SELECT * FROM ". $table_items . " where is_read = 0 order by feed_id, id asc";

if (isset($_GET['starred'])) {
    $query = "SELECT * FROM ". $table_items . " where is_starred = 1 order by feed_id, id desc";
}
if (isset($_GET['all'])) {
    $query = "SELECT * FROM ". $table_items . " order by feed_id, id desc";
}
if (isset($_GET['search'])) {
    $query = "SELECT * FROM ". $table_items . " where title like '%{$_GET['search']}%' order by feed_id, id desc";
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