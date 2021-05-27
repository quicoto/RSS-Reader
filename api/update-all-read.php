<?php

require(__DIR__.'/_connection.php');
require(__DIR__.'/../values.php');

if (isset($_GET['starred'])) {
  $mysqli->query("update ". $table_items . " set is_read=1 where is_starred=1");
} else {
  $mysqli->query("update ". $table_items . " set is_read=1 where is_read=0");
}