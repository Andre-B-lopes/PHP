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
<table width="100%" border="1">
	<tr align="center"><td colspan="2">
		<p class="texto-aluno">NOME</p>
	</td></tr>
	<?php
		while($row=pg_fetch_array($result)){
			echo "<form action=\"pdf.php\" method=\"post\"><tr><td>";
			echo "<input type=\"hidden\" name=\"id_aluno\" value=".$row["id"].">";
			echo "<p class=\"texto-aluno2\">".$row["nome"]."</p><br><br>";
			echo "</td><td><input type=\"submit\" class=\"btn-g btn-primary\" value=\"IMPRIMIR\"></td></tr>";
			echo "</form>";
		}
	?>
</table>
<a href="index.php"><button class="btn-xlg">Voltar</button></a>
</form>
</div>  
</body>
</html>