<?php

$db_name = "drgdb";
$mysql_username = "root";
$mysql_pass = "123456789";
$server_name = "localhost";

$con = mysqli_connect($server_name, $mysql_username, $mysql_pass, $db_name);

if (!$con) {
    echo '{"Message":"Unable to connect to the db"}';
} else {
    echo "Connected to the db";
}
