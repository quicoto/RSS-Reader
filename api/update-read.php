<?php

require(__DIR__.'/_connection.php');
require(__DIR__.'/../values.php');

$mysqli->query("update ". $table_items . " set is_read=1 where id=" . $_GET['id']);