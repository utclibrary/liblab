<?php

DEFINE ('DB_USER', 'coll_dev_web');
DEFINE ('DB_PASSWORD', 'a2pjcttrwo');
DEFINE ('DB_HOST', 'mysql.lib.utc.edu');
DEFINE ('DB_NAME', 'LuptonDB');

$con = @mysql_connect (DB_HOST, DB_USER, DB_PASSWORD) OR die ();
mysql_select_db (DB_NAME) OR die ();
mysql_query('SET NAMES utf8');
?>
