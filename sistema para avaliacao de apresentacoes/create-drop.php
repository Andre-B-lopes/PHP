<?php
require_once('conn/conn.php');
$criar=0;
$alunos = json_decode($_GET['create'], true);
if ($alunos!="") {
	$criar=1;
}

//criar tabela no banco de dados

if ($criar!="0") {
	$result=pg_query($conn, "CREATE TABLE dinamica (id serial PRIMARY KEY, nome text, pontos DECIMAL(5,2) )");
	$result=pg_query($conn, "CREATE TABLE pontos (id serial PRIMARY KEY,id_nome int, pontos DECIMAL(5,2), nota1 int, nota2 int, nota3 int, nota4 int, nota5 int, nota6 int, nota7 int, nota8 int, nota9 int, nota10 int, nota11 int, nota12 int, nota13 int, nota14 int, nota15 int, nota16 int, nota17 int, nota18 int )");
	for ($i=0; $alunos[$i]!="" ; $i++) { 
		//echo $alunos[$i]."<br>";
		$result=pg_query($conn, "INSERT INTO dinamica (\"nome\") VALUES ('$alunos[$i]')");
	}
}

//exclui tabela no banco de dados
if($_GET['drop']){$excluir = $_GET['drop'];}else{$excluir = "0";}
if ($excluir!="0") {
	$result=pg_query($conn, "DROP TABLE dinamica");
	$result=pg_query($conn, "DROP TABLE pontos");
}


?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/responsivo.css" rel="stylesheet">
<title>DINÂMICA</title>

<script>
	window.location.href='index.php';
</script>

</head>

<body>  
</body>
</html>