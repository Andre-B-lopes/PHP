<?php
error_reporting(0);
//pegar json 
$alunos = json_decode($_POST['nome2'], true);

if($_POST['nome']){$nome = $_POST['nome'];}else{$nome = "0";}

for ($i=0; $alunos[$i]!="" ; $i++) { 
	//echo $alunos[$i]."<br>";
}
//echo $i."<br>";
if ($nome!="0") {
	$alunos[$i]=$nome;
}

//echo $alunos[$i]."<br>";

//transformar array em json
$json = json_encode($alunos);

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
<img class="img-index" src="img/brasao.png">
<p class="texto-index">Digite o Nome de Guerra dos alunos, na ordem em que será realizada as apresentações:</p>
<form action="professor2.php" method="post">
<input type="text" name="nome" class="texto-index escrever" style='text-transform:uppercase'><br><br>

<!-- Passar json via input "hidden" -->
<input type="hidden" name="nome2" value="<?= htmlentities($json, ENT_QUOTES, 'UTF-8') ?>">

<button class="btn-xlg btn-primary">Próximo</button>
</form>
<?php 
	if ($alunos!="") {
		$i++;
	}
?>
<p class="texto-index">Número de pessoas cadastradas na dinâmica: <?php echo $i;?></p>
<br><br>
<form action="create-drop.php" method="get">
<input type="hidden" name="create" value="<?= htmlentities($json, ENT_QUOTES, 'UTF-8') ?>">
<button class="btn-xlg btn-success">Iniciar Dinâmica</button>
</form>
<form action="create-drop.php" method="get">
<input type="hidden" name="drop" value="1">
<button class="btn-xlg btn-danger">Finalizar Dinâmica</button>
</form>
<br><br>
<form action="index.php">
<input type="submit" value="Voltar" class="btn-xlg">
</form>
</div>  
</body>
</html>