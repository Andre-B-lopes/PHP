<?php

error_reporting(0);


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

$coment = $_GET['coment'];
$desc = $_GET['desc'];
$condominio= $_GET['cond'];


$sql = "INSERT INTO os_".$condominio." (data_criacao,descricao,obs,status) VALUES (now(),'".$desc."','".$coment."','1')";
$result = $conn->query($sql);

?>