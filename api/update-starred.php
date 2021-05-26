<?php

require(__DIR__.'/_connection.php');
require(__DIR__.'/../values.php');

$mysqli->query("update ". $table_items . " set is_starred=" . $_GET['is_starred'] . " where id=" . $_GET['id']);