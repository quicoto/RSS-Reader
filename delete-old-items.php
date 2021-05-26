<?php
require('config.php');
require('values.php');

$mysqli->query("DELETE FROM ".$table_items." WHERE DATEDIFF(NOW(),date) > ".$delete_old_items_days);