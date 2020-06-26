<?php

$server = "localhost";

$dbusername = "root";

$password = "";

$db = "se_20s_g01_db";

 

$dbconn = mysqli_connect($server, $dbusername, $password, $db);

 

if ($dbconn->connect_error) {
    die('Could not connect: ' . $dbconn->connect_error);
}


//You can use the command below to set the default database to another db.

//mysqli_select_db($dbconn, "webiii");


