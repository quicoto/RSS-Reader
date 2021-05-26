<?php

require(__DIR__.'/_connection.php');
require(__DIR__.'/../values.php');

$mysqli->query("DELETE FROM ". $table_items . " WHERE feed_id = " . $_GET['id']);
$mysqli->query("DELETE FROM ". $table_feeds . " WHERE id = " . $_GET['id']);