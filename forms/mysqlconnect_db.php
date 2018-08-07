<?php

DEFINE ('DB_USER', 'dbase_form');
DEFINE ('DB_PASSWORD', 'pLnAViGsyuvfoJ86skdY');
DEFINE ('DB_HOST', 'mysql.lib.utc.edu');
DEFINE ('DB_NAME', 'LuptonDB');

$link = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

?>
