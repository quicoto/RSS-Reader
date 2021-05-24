<?php

$mysqli->query("update rss set is_read=1 where id=" . $id);