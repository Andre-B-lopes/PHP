<?php
error_reporting(0);
require_once('conn/conn.php');

$result=pg_query($conn, "SELECT * FROM dinamica;");

if($_POST['id_aluno']){$id = $_POST['id_aluno'];}else{$id = "0";}
if ($id=="0") {
	echo "<script type=\"text/javascript\">
		alert(\"ERRO: Você não escolheu um Aluno para avaliar!\");
		window.location.href=\"index.php\";
		</script>";
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/responsivo.css" rel="stylesheet">
<title>DINÂMICA</title>

<script>
	function SomenteNumero(e) {
    	var tecla; //Armazena a tecka pressionada.	
        if (e.which) {
        	tecla = e.which;
		} else {
            tecla = e.keyCode;
        }

        if ((tecla >= 48 && tecla <= 51) || (e.which == 08)) {
        	return true;
	    } else {
			return false;
	    }
	}
</script>


</head>

<body>
<div align="center">

<img class="img-monitor" src="img/brasao.png">
<p class="texto-aluno">Avalie seus colegas com valores entre "0 e 3" </p><br><br>
<?php
	while($row=pg_fetch_array($result)){
		if ($row["id"]==$id) {
			echo "<tr><td align=\"center\">";
			echo "<p class=\"texto-aluno2\">".$row["nome"]."</p><br><br>";
		}
	}
?>
<form action="pontuar.php" method="post">
<input type="hidden" name="id_aluno" value="<?php echo $id;?>">
<table width="100%" border="1">
	<tr align="center"><td width="70%">
		<p class="texto-aluno">ITEM PARA AVALIAÇÃO</p>
	</td><td>
		<p class="texto-aluno">NOTA</p>
	</td></tr>
		<tr><td width="70%">
		<p class="texto-aluno3">Contextualização do assunto da aula.</p>
	</td><td>
		<input class="texto-nota escrever" type="number" name="nota1" onkeypress="return SomenteNumero(event,this);" maxlength="1">
	</td></tr>
		<tr><td width="70%">
		<p class="texto-aluno3">Informação do objetivo da aula.</p>
	</td><td>
		<input class="texto-nota escrever" type="number" name="nota2" onkeypress="return SomenteNumero(event,this);" maxlength="1">
	</td></tr>
		<tr><td width="70%">
		<p class="texto-aluno3">incentivação inicial.</p>
	</td><td>
		<input class="texto-nota escrever" type="number" name="nota3" onkeypress="return SomenteNumero(event,this);" maxlength="1">
	</td></tr>
		<tr><td width="70%">
		<p class="texto-aluno3">ritmo de fala</p>
	</td><td>
		<input class="texto-nota escrever" type="number" name="nota4" onkeypress="return SomenteNumero(event,this);" maxlength="1">
	</td></tr>
		<tr><td width="70%">
		<p class="texto-aluno3">variação de intensidade de voz</p>
	</td><td>
		<input class="texto-nota escrever" type="number" name="nota5" onkeypress="return SomenteNumero(event,this);" maxlength="1">
	</td></tr>
		<tr><td width="70%">
		<p class="texto-aluno3">movimentou-se na aula</p>
	</td><td>
		<input class="texto-nota escrever" type="number" name="nota6" onkeypress="return SomenteNumero(event,this);" maxlength="1">
	</td></tr>
		<tr><td width="70%">
		<p class="texto-aluno3">contato visual</p>
	</td><td>
		<input class="texto-nota escrever" type="number" name="nota7" onkeypress="return SomenteNumero(event,this);" maxlength="1">
	</td></tr>
		<tr><td width="70%">
		<p class="texto-aluno3">postura</p>
	</td><td>
		<input class="texto-nota escrever" type="number" name="nota8" onkeypress="return SomenteNumero(event,this);" maxlength="1">
	</td></tr>
	<tr><td width="70%">	
		<p class="texto-aluno3">linguagem sem vícios</p>
	</td><td>
		<input class="texto-nota escrever" type="number" name="nota9" onkeypress="return SomenteNumero(event,this);" maxlength="1">
	</td></tr>
		<tr><td width="70%">
		<p class="texto-aluno3">articulação das palavras</p>
	</td><td>
		<input class="texto-nota escrever" type="number" name="nota10" onkeypress="return SomenteNumero(event,this);" maxlength="1">
	</td></tr>
		<tr><td width="70%">
		<p class="texto-aluno3">segurança no conteúdo</p>
	</td><td>
		<input class="texto-nota escrever" type="number" name="nota11" onkeypress="return SomenteNumero(event,this);" maxlength="1">
	</td></tr>
		<tr><td width="70%">
		<p class="texto-aluno3">técnicas de aprendizagem</p>
	</td><td>
		<input class="texto-nota escrever" type="number" name="nota12" onkeypress="return SomenteNumero(event,this);" maxlength="1">
	</td></tr>
		<tr><td width="70%">
		<p class="texto-aluno3">verificação da aprendizagem</p>
	</td><td>
		<input class="texto-nota escrever" type="number" name="nota13" onkeypress="return SomenteNumero(event,this);" maxlength="1">
	</td></tr>
		<tr><td width="70%">
		<p class="texto-aluno3">incentiva participação</p>
	</td><td>
		<input class="texto-nota escrever" type="number" name="nota14" onkeypress="return SomenteNumero(event,this);" maxlength="1">
	</td></tr>
		<tr><td width="70%">
		<p class="texto-aluno3">aula dinâmica</p>
	</td><td>
		<input class="texto-nota escrever" type="number" name="nota15" onkeypress="return SomenteNumero(event,this);" maxlength="1">
	</td></tr>
		<tr><td width="70%">
		<p class="texto-aluno3">desenvoltura para situações adversas</p>
	</td><td>
		<input class="texto-nota escrever" type="number" name="nota16" onkeypress="return SomenteNumero(event,this);" maxlength="1">
	</td></tr>
		<tr><td width="70%">
		<p class="texto-aluno3">usa RI</p>
	</td><td>
		<input class="texto-nota escrever" type="number" name="nota17" onkeypress="return SomenteNumero(event,this);" maxlength="1">
	</td></tr>
		<tr><td width="70%">
		<p class="texto-aluno3">criatividade do RI</p>
	</td><td>
		<input class="texto-nota escrever" type="number" name="nota18" onkeypress="return SomenteNumero(event,this);" maxlength="1">
	</td></tr>
</table>
<input type="submit" value="ENVIAR" class="btn-xlg btn-success">
</form>
<a href="aluno.php"><button class="btn-xlg">Voltar</button></a>
</div>  
</body>
</html>