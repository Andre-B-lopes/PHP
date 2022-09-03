<?php
require_once('conn/conn.php');
require "CsvToArray.Class.php";

if ( $_FILES['file']['tmp_name'] ) {
       
foreach (CsvToArray::open($_FILES['file']['tmp_name']) as $c)
 {
// Coloca cada campo do CSV em um array c[]
     $nome = $c[0];
     $codigo = $c[1];
     $nome_curso = $c[2];
     $data_conclusao = $c[3];
     $os=$c[4];
// Inclui os array no banco
     $result=pg_query($conn, "INSERT INTO certificados (\"nome\", \"cod_validar\", \"nome_curso\", \"data_conclusao\", \"os\") VALUES ('$nome', '$codigo', '$nome_curso', '$data_conclusao', '$os')");     

//echo $nome.'<br>'.$matricula.'<br>'.$cpf.'<br>'.$rg.'<br>';
 } }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9" />
<title>VERCERT</title>
<link href="css.css" rel="stylesheet" type="text/css" />
</head>

<body>

<form enctype="multipart/form-data" action="" method="post">
  <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />

<div align="center">

<div align="center">
<img src="img/brasao.png" width="15%">
</div>
<p style="font-size: 30px">Importar arquivo .CSV:</p>
<p style="font-size: 25px"

>Use o modelo em anexo: <a href="modelo.csv">modelo.csv</a></p>
<p style="font-size: 25px"><strong><span style="color:#F00">Aten&ccedil;ao:</span></strong> N&atilde;o existe a possibilidade de desfazer.</p>
<input name="file" type="file" class="txtbox2" size="3" />
<input type="submit" class="style_botao_preto" value="Confirmar" />
</form>
</div> 


</body>
</html>