<?php
$servername = "localhost";
$username = "anees_db";
$password = "09z31Ymi6)yL";
$dbname = "anees_db";

// Create connection
$link = mysqli_connect($servername, $username, $password, $dbname);
mysqli_set_charset($link,"utf8");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>