<?php

require('_connection.php');

$mysqli->query("update rss set is_read=1 where id=" . $_GET['id']);