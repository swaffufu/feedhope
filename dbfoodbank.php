<?php
//server info
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "foodbank";
//create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);

//check connection
if ($mysqli->connect_error) {
    die("Connection Failed: " . $mysqli->connect_error);
}
?>