<?php

require('_connection.php');

$mysqli->query("update rss set is_starred=" . $_GET['is_starred'] . " where id=" . $_GET['id']);