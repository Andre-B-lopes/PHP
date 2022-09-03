<?php
require_once('conn/conn.php');

$email=$POST['nEmail'];

$sql = "SELECT * FROM user WHERE email=".$email."";
$result = $conn->query($sql);

while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
	if($row['email']==$email){
		echo "<script>
			  alert \"Email Enviado!\";
			  </script>";
	}
}