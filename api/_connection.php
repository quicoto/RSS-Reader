<?php
require(__DIR__.'/../config.php');
require(__DIR__.'/../values.php');

$mysqli = new mysqli($host, $user, $password, $database);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

if (isset($_GET['mark-read'])
    || isset($_GET['mark-unread'])
    || isset($_GET['site'])
    || isset($_GET['star'])
  ) {
    if (isset($_GET['mark-read'])) {
        $id = $_GET['mark-read'];

    }
    if (isset($_GET['mark-unread'])) {
        $id = $_GET['mark-unread'];
        $mysqli->query("update ". $table_items . "  set is_read=0 where id=" . $id);
    }
    if (isset($_GET['site'])) {
        $site = $_GET['site'];
        $mysqli->query("update ". $table_items . "  set is_read = 1 where site = '$site' and is_read = 0");
        header('Location: /fetch-feeds');
    }
    if (isset($_GET['star'])) {
        $id = $_GET['star'];
        $result = $mysqli->query("select id, is_starred from ". $table_items . "  where id = $id");
        $result->data_seek(0);
        $row = $result->fetch_assoc();
        $is_starred = $row['is_starred'];
        $toggle_star = $is_starred ? 0 : 1;
        $mysqli->query("update ". $table_items . "  set is_starred = $toggle_star where id = $id");
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
