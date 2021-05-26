<?php

require(__DIR__.'/_connection.php');
require(__DIR__.'/../values.php');

$query = "SELECT * FROM ". $table_feeds . " order by title, id asc";

$result = $mysqli->query($query);
$result->data_seek(0);
$site_last = "";

$data = array();

while ($row = $result->fetch_assoc()) {
  array_push($data, $row);
}

header('Content-Type: application/json');

echo json_encode($data);