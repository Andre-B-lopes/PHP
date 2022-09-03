<?php
	//#########################################
	// Recebe as informações do formulário
	//#########################################

	$assunto = "Nova OS - Grupo Guardiao ".date("d/m/Y")." - ".date("H:i"); //texto pré definido.
	$descricao = $_GET['nDescricao']; //pega os dados que foi digitado no name="nDescrição".
	$comentario = $_GET['nComentario']; //pega os dados que foi digitado no comentário ="nComentário".
	$status1=$_GET['status1'];
	$userLogado=$_GET['userLogado'];
	$condominio=$_GET['cond'];
	$os=$_GET['os'];
	$data=$_GET['data'];
	$foto=$_GET['foto'];
	$destinatario=$_GET['destinatario'];
	$email1=$_GET['email1'];
	$destinatario2=$_GET['destinatario2'];
	$email2=$_GET['email2'];
	$destinatario3=$_GET['destinatario3'];
	$email3=$_GET['email3'];
	$ano=date('Y');
	$osemail=$os."/".$ano;
	//$arquivo = $_FILE['nArquivo']; //pega os dados que foi digitado no comentário ="nComentário".+
/*
	$imagem_nome="https://tifix.com.br/guardiao/foto/1534465774.jpg";
	$arquivo=fopen($imagem_nome,'r');
	$contents = fread($arquivo, filesize($imagem_nome));
	$encoded_attach = chunk_split(base64_encode($contents));
	fclose($arquivo);
	$limitador = "_=======". date('YmdHms'). time() . "=======_";

	$mailheaders = "From: remetente@host.com\r\n";
	$mailheaders .= "MIME-version: 1.0\n";
	$mailheaders .= "Content-type: multipart/related; boundary=\"$limitador\"\r\n";
	$cid = date('YmdHms').'.'.time();

	$texto="
	<html>
	<body>
	<img src=\"cid:' . $cid . '\">
	<font size=6><br />blablabla </font>
	</body>
	</html>
	";

$msg_body = "--$limitador\n";
$msg_body .= "Content-Transfer-Encoding: 7bit\n";
$msg_body .= "Content-type: text/html; charset=iso-8859-1\n";
$msg_body .= "$texto\n\n";
$msg_body .= "Content-type: image/jpeg;\n\tname=\"$imagem_name\"\n";
$msg_body .= "Content-Disposition: inline;\n\tfilename=\"$imagem_name\"\n";
$msg_body .= "Content-Transfer-Encoding: base64\n";
$msg_body .= "Content-ID: <$cid>\n\n";
$msg_body .= "$encoded_attach\n";
$msg_body .= "--$limitador--\n";


	mail("contato@guardiaovigilancia.com.br","Assunto",$msg_body, $mailheaders);
*/
	$headers  = "From: grupo_guardiao@guardiao.com.br\r\n";
	$headers .= "Reply-To: $email\r\n";
	$headers .= "Content-type: text/html; charset=utf-8" . "\r\n";


	/*abaixo contém os dados que serão enviados para o email
	cadastrado para receber o formulário*/

	$corpo .="
	    <html>
			<head>
				<title>Nova OS - Grupo Guardiao</title>
			</head>
			<body style='font-family: sans-serif;'>
				<h2>Nova OS - Grupo Guardião</h2>
				<table border='1' cellspacing='2' cellpadding='5'>
				    <tr>
				        <td colspan='3' align='center'>Nova OS - ".$condominio."<br><font align='center'>".$descricao."</font> </td>
				    </tr>
				    <tr>
				    	<td rowspan='9' align='center'><img src='tifix.com.br/guardiao/img/logo-guardiao.png'  width='100px' height='100px' >
				    </tr>
				    <tr>
				    	<td><strong>OS número:  </strong></td>
						<td>".$osemail."</td>
						
					</tr>
					<tr>
						<td><strong>Zelador que abriu:  </strong></td>
						<td>".$userLogado."</td>
					</tr>
					<tr>
						<td><strong>Data de Abertura da OS: </strong></td>
						<td>" . $data . "</td>
					</tr>
					<tr>
						<td><strong>Data de Execução da OS: </strong></td>
						<td></td>
					</tr>
					<tr>
						<td><strong>Data de Finalização da OS: </strong></td>
						<td></td>
					</tr>
					<tr>
						<td><strong>Descrição: </strong></td>
						<td>" . $comentario . "</td>
					</tr>
					<tr>
						<td><strong>Enviado para: </strong></td>
						<td>" . $destinatario . ", ".$destinatario2.", ".$destinatario3."</td>
					</tr>
					<tr>
						<td><strong>Imagem da OS: </strong></td>
						<td><img src='tifix.com.br/guardiao/foto/".$foto."'width='500px' height='500px' ></td>
					</tr>
				</table>
			</body>
		</html>";

	//Multiplos endereços para envio
	$email_to  = $email1 . ', ';
	$email_to .= $email2 . ', '; 
	$email_to .= $email3 ;

	$status = mail($email_to, $assunto, $corpo, $headers); //enviando o email.
   
   

	if ($status) {
	  //echo "<script> alert('Nova OS cadastrada com sucesso!'); </script>";
	  echo "<script> window.location.replace(\"index2.php?status=".$status1."&userLogado=".$userLogado."&cond=".$condominio."\");</script>"; //Altere aqui para o endereço de sua página.
	//mensagem de form enviado com sucesso.

	} else {
	  //echo "<script> alert('Falha ao cadastrar OS.'); </script>";
	  echo "<script>window.location.replace(\"index2.php?status=".$status1."&userLogado=".$userLogado."&cond=".$condominio."\");</script>"; //Altere aqui para o endereço de sua página.
	//mensagem de erro no envio. 

	}


?>
