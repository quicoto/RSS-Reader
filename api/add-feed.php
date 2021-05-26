<?php

require('_connection.php');
require('../values.php');

$url = urldecode($_GET['url']);

// Fetch the feed to get the site title
$xml = simplexml_load_file($url);

$check_query = sprintf(
  "SELECT url FROM feeds WHERE url = '%s'",
       $mysqli->escape_string($url)
);
$check = $mysqli->query($check_query);
$row = $check->fetch_assoc();

if (empty($row)) {
  $insert = sprintf(
    "INSERT INTO feeds (title, url) VALUES ('%s', '%s')",
    $mysqli->escape_string($xml->channel->title),
    $mysqli->escape_string($url)
  );
  $mysqli->query($insert);

  echo "1";
} else {
  echo "0";
}