<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fondo_solidario";

// Create connection
$link = mysqli_connect($servername, $username, $password, $dbname);
mysqli_set_charset($link,"utf8");
// Check connection
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

?>