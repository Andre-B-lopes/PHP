<?php

error_reporting(0);


/*$servername = "localhost";
$username = "tifixcom_guard";
$password = "guardiaoroot";
$dbname = "tifixcom_os";
*/
$servername = "localhost";
$username = "postgres";
$password = "postgres";
$dbname = "postgres";
$port = "5432";

// Create connection
//$conn = pg_connect($servername, $username, $password, $dbname, $port);
$conn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=postgres");
// Check connection
if (!$conn) {
    die("Connection failed: Deu Ruim!");
}

//echo "Connected successfully";

?>
