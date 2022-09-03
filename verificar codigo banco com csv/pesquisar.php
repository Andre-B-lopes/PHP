<?php
//require_once('conn/conn.php');

if($_POST['codigo']){$codigo = $_POST['codigo'];}else{$codigo = "0";}
$flag=0;
if ($codigo=="0"){
	echo "<script>
			alert(\"Código Inválido.\");
			window.location.replace(\"index.php\");
		  </script>";
}
//echo $codigo;
$result = pg_query($conn,"SELECT * FROM certificados");

while($row=pg_fetch_array($result)){
	if($row["cod_validar"]==$codigo){
		$curso=$row["nome_curso"];
		$aluno=$row["nome"];
		$data=$row["data_conclusao"];
		$os=$row["os"];
		$flag=1;
	}
}
if ($flag!=1) {
	echo "<script>
			alert(\"Código Inválido.\");
			window.location.replace(\"index.php\");
		  </script>";
}
//echo $curso;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9" />
<title>VERCERT</title>
</head>

<body>
<div align="center">
<form action="index.php" method="post">
<div align="center">
<img src="img/brasao.png" width="5%">
</div>
<p style="font-size: 30px">Verificação de Certificados:</p>
<table border="1" width="50%">
	<tr><td width="30%">
		<p>Nome do Curso:</p>
	</td><td width="70%">
		<?php echo $curso; ?>
	</td></tr>
	<tr><td>
		<p>Nome do Aluno:</p>
	</td><td>
		<?php echo $aluno; ?>
	</td></tr>
	<tr><td>
		<p>Data de Conclusão:</p>
	</td><td>
		<?php echo $data; ?>
	</td></tr>
	<tr><td>
		<p>Ordem de Serviço:</p>
	</td><td>
		<?php echo $os; ?>
	</td></tr>
</table>
<input type="submit" name="enviar" value="Voltar">
</form>
</div>  
</body>
</html>