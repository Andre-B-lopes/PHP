<?php
error_reporting(0);
require_once('conn/conn.php');

$result=pg_query($conn, "SELECT * FROM dinamica;");


$alunos=pg_affected_rows($result);
$contador_alunos=1;
while ($contador_alunos<=$alunos) {
	$nota=0;
	$cont=0;
	//echo "<br>contador_alunos=".$contador_alunos;
	$result2=pg_query($conn, "SELECT * FROM pontos ORDER BY id_nome");
	while($row2=pg_fetch_array($result2)){
		if ($row2["id_nome"]==$contador_alunos) {
			$nota=$nota+$row2["pontos"];
			$cont++;
		}
	}
	//echo "nota=".$nota."<br><br>";
	//echo "contador=".$cont."<br><br>";
	$nota=$nota/$cont;
	$result3=pg_query($conn, "UPDATE dinamica SET \"pontos\"='$nota' WHERE id='$contador_alunos'; ");
	$contador_alunos++;
}

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="refresh" content="5" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/responsivo.css" rel="stylesheet">
<title>DINÂMICA</title>
</head>

<body>
<div align="center">
<img class="img-monitor" src="img/brasao.png"><br><br>
<table width="100%" border="2">
<tr align="center"><td>
	<p class="texto-index">Ranking</p>	
</td><td>
	<p class="texto-index">Nome</p>
</td><td>
	<p class="texto-index">Pontuação</p>
</td></tr>
<?php
$contador=1;
$result=pg_query($conn, "SELECT * FROM dinamica ORDER BY pontos DESC;");
while($row=pg_fetch_array($result)){
	echo "<tr><td><p class=\"texto-aluno2\">".$contador."</p></td>";
	echo "<td><p class=\"texto-aluno2\">".$row["nome"]."</p></td>";		
	echo "<td><p class=\"texto-aluno2\">".$row["pontos"]."</p></td></tr>";
	$contador++;
}

?>
</table>
</div>  
</body>
</html>