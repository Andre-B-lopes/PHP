<?php

error_reporting(0);


/*$servername = "localhost";
$username = "tifixcom_guard";
$password = "guardiaoroot";
$dbname = "tifixcom_os";
*/
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "os";

// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//echo "Connected successfully";

?>
