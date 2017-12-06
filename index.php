<?php
require('config.php');

$mysqli = new mysqli($host, $user, $password, $database);
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

if (isset($_GET['id']) || isset($_GET['site']) || isset($_GET['star'])) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $mysqli->query("update rss set is_read=1 where id=" . $id);
    }
    if (isset($_GET['site'])) {
        $site = $_GET['site'];
        $mysqli->query("update rss set is_read = 1 where site = '$site' and is_read = 0");
        header('Location: /rss');
    }
    if (isset($_GET['star'])) {
        $id = $_GET['star'];
        $result = $mysqli->query("select id, is_starred from rss where id = $id");
        $result->data_seek(0);
        $row = $result->fetch_assoc();
        $is_starred = $row['is_starred'];
        $toggle_star = $is_starred ? 0 : 1;
        $mysqli->query("update rss set is_starred = $toggle_star where id = $id");
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

$query = "SELECT * FROM rss where is_read = 0 order by site, id desc";
if (isset($_GET['starred'])) {
    $query = "SELECT * FROM rss where is_starred = 1 order by site, id desc";
}
if (isset($_GET['search'])) {
    $query = "SELECT * FROM rss where title like '%{$_GET['search']}%' order by site, id desc";
}
$result = $mysqli->query($query);
$result->data_seek(0);
$site_last = "";
$site = "diff";
echo '<html><head profile="http://gmpg.org/xfn/11"><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
      </head>
      <body>
        <div class="page">
            <div class="grid-item one_whole">';
echo "RSS Reader<br />";
echo '<br><a href="?starred=1">Starred</a> - <a href=".">Unread</a>';
echo '<style>
        html {font-size:20px; width:100%;}
        .text {width: 400px; height: 35px;}
        .btn {width: 100px; height: 35px; font-size: 20px;}
        @media only screen and (max-width: 1000px) {
            html {font-size:55px; width:980px;}
            .text {width: 400px; height: 90px;}
            .btn {width: 120px; height: 90px; font-size: 30px;}
        }
      </style>';
echo '<form action="." method="get">
<br />
<input class="text" type="text" name="search" />
<input class="btn" type="submit" value="search" />
</form><br>';

while ($row = $result->fetch_assoc()) {
    $site_last = $site;
    $id = $row['id'];
    $site = $row['site'];
    $title = $row['title'];
    $url = $row['url'];
    $is_read = $row['is_read'];
    $is_starred = $row['is_starred'];
    $star_or_not = $is_starred ? '&#9733;' : '&#9734;';
    if ($site !== $site_last) {
        echo "<h3><a href='?site=$site'>$site</a></h3>";
    }
    echo "<p><a href='?id=$id'>$id</a> - <a href='$url' target='_blank'>$title</a> - <a href ='?star=$id'>$star_or_not</a></p>";
}
echo "</div></div></div></body></html>";
?>

