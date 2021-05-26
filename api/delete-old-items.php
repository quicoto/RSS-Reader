<?php
require(__DIR__.'/_connection.php');
require(__DIR__.'/../values.php');

$mysqli->query("DELETE FROM ".$table_items." WHERE DATEDIFF(NOW(),date) > ".$delete_old_items_days);