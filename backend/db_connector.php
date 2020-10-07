<?php 
include_once('config.php');

$dbconn = mysqli_connect($server, $dbusername, $password, $db);

if ($dbconn->connect_error) {
    die('Could not connect: ' . $dbconn->connect_error);
}
?>