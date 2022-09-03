<?php
error_reporting(0);
require_once('conn/conn.php');

$result=pg_query($conn, "SELECT * FROM dinamica;");

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/responsivo.css" rel="stylesheet">
<title>DINÂMICA</title>
</head>

<body>
<div align="center">

<img class="img-monitor" src="img/brasao.png">
<p class="texto-aluno">Avalie seus colegas com valores entre "0 e 3" </p><br><br>
<table width="100%" border="1">
	<tr align="center"><td width="70%">
		<p class="texto-aluno">NOME</p>
	</td><td>
		<p class="texto-aluno">-</p>
	</td></tr>
	<?php
		while($row=pg_fetch_array($result)){
			echo "<form action=\"avaliar.php\" method=\"post\"><tr><td>";
			echo "<input type=\"hidden\" name=\"id_aluno\" value=".$row["id"].">";
			echo "<p class=\"texto-aluno2\">".$row["nome"]."</p><br><br>";
			echo "</td><td><input type=\"submit\" class=\"btn-g btn-primary\" value=\"AVALIAR\"></td></tr>";
			echo "</form>";
		}
	?>
</table>
<a href="index.php"><button class="btn-xlg">Voltar</button></a>
</form>
</div>  
</body>
</html>