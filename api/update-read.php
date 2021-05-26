<?php

require('_connection.php');
require('../values.php');

$mysqli->query("update ". $table_items . " set is_read=1 where id=" . $_GET['id']);