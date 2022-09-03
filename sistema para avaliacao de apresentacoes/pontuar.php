<?php
error_reporting(0);
require_once('conn/conn.php');

if($_POST['id_aluno']){$id = $_POST['id_aluno'];}else{$id = "0";}
if($_POST['nota1']){$nota1 = $_POST['nota1'];}else{$nota1 = "0";}
if($_POST['nota2']){$nota2 = $_POST['nota2'];}else{$nota2 = "0";}
if($_POST['nota3']){$nota3 = $_POST['nota3'];}else{$nota3 = "0";}
if($_POST['nota4']){$nota4 = $_POST['nota4'];}else{$nota4 = "0";}
if($_POST['nota5']){$nota5 = $_POST['nota5'];}else{$nota5 = "0";}
if($_POST['nota6']){$nota6 = $_POST['nota6'];}else{$nota6 = "0";}
if($_POST['nota7']){$nota7 = $_POST['nota7'];}else{$nota7 = "0";}
if($_POST['nota8']){$nota8 = $_POST['nota8'];}else{$nota8 = "0";}
if($_POST['nota9']){$nota9 = $_POST['nota9'];}else{$nota9 = "0";}
if($_POST['nota10']){$nota10 = $_POST['nota10'];}else{$nota10 = "0";}
if($_POST['nota11']){$nota11 = $_POST['nota11'];}else{$nota11 = "0";}
if($_POST['nota12']){$nota12 = $_POST['nota12'];}else{$nota12 = "0";}
if($_POST['nota13']){$nota13 = $_POST['nota13'];}else{$nota13 = "0";}
if($_POST['nota14']){$nota14 = $_POST['nota14'];}else{$nota14 = "0";}
if($_POST['nota15']){$nota15 = $_POST['nota15'];}else{$nota15 = "0";}
if($_POST['nota16']){$nota16 = $_POST['nota16'];}else{$nota16 = "0";}
if($_POST['nota17']){$nota17 = $_POST['nota17'];}else{$nota17 = "0";}
if($_POST['nota18']){$nota18 = $_POST['nota18'];}else{$nota18 = "0";}
if ($id=="0") {
	echo "<script type=\"text/javascript\">
		alert(\"ERRO: Você não escolheu um Aluno para avaliar!\");
		window.location.href=\"index.php\";
		</script>";
}
$nota_final=(($nota1+$nota2+$nota3+$nota4+$nota5+$nota6+$nota7+$nota8+$nota9+$nota10+2*($nota11+$nota12+$nota13+$nota14+$nota15+$nota16)+$nota17+$nota18)*10)/72;

$result=pg_query($conn, "INSERT INTO pontos (\"id_nome\",\"pontos\",\"nota1\",\"nota2\",\"nota3\",\"nota4\",\"nota5\",\"nota6\",\"nota7\",\"nota8\",\"nota9\",\"nota10\",\"nota11\",\"nota12\",\"nota13\",\"nota14\",\"nota15\",\"nota16\",\"nota17\",\"nota18\") VALUES ('$id','$nota_final','$nota1','$nota2','$nota3','$nota4','$nota5','$nota6','$nota7','$nota8','$nota9','$nota10','$nota11','$nota12','$nota13','$nota14','$nota15','$nota16','$nota17','$nota18')");

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/responsivo.css" rel="stylesheet">
<title>DINÂMICA</title>

<script>
	window.location.href='aluno.php';
</script>

</head>

<body>  
</body>
</html>