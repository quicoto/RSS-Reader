<?php
require(__DIR__.'/_connection.php');
require(__DIR__.'/../values.php');

$query_feeds = "SELECT * from ".$table_feeds;
$feeds = $mysqli->query($query_feeds);

while ($feed = $feeds->fetch_assoc()) {
  // Always leave the 10 newest items
  // Subqueries needed for LIMIT https://ricard.dev/how-to-delete-with-limit-and-offset-in-mysql/
  $query_old_items = "DELETE FROM ".$table_items." WHERE ID in (SELECT ID from (select ID from ".$table_items." WHERE DATEDIFF(NOW(),date) > ".$delete_old_items_days . " AND feed_id = ".$feed['id']." ORDER BY ID DESC LIMIT 10, 100) x)";

  $mysqli->query($query_old_items);
}


