<?php

DEFINE ('DB_USER', 'users_form');
DEFINE ('DB_PASSWORD', 'zY0TwAQnbzmdg0p0KGjF');
DEFINE ('DB_HOST', 'mysql.lib.utc.edu');
DEFINE ('DB_NAME', 'Login');

$con = mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

?>