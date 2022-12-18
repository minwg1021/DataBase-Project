<?php session_start();
$hostname="localhost:3306";
$dbuserid="root";
$dbpasswd="Woong5372!@";
$dbname="testdb";

$mysqli = new mysqli($hostname, $dbuserid, $dbpasswd, $dbname);
if ($mysqli->connect_errno) {
    die('Connect Error: '.$mysqli->connect_error);
}

?>