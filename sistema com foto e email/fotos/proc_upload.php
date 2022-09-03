<?php
	include_once("../conn/conn.php");

	$status=$_POST['status'];
	$userLogado=$_POST['userLogado'];
	$condominio=$_POST['condominio'];
	$coment = $_POST['nComentario'];
	$desc = $_POST['nDescricao'];
	$empresa = $_POST['empresa'];
	$emails = $_POST['emails'];
	$email = $_POST['email'];

	if ($email!="" and $empresa!="") {
		$destinatario=$empresa;
		$email1=$email;
		$sql = "SELECT * FROM empresas";
        $result = $conn->query($sql);
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
        	if($row['nome']==$empresa){
        		$flag=1;
        		break;
        	}else{
        		$flag=0;
        	}
		}
		if ($flag==1) {
			$sql = "UPDATE empresas SET email='".$email."' WHERE nome='".$empresa."'";
			$result = $conn->query($sql);
		}else{
			$sql = "INSERT INTO empresas (nome,email,condominio) VALUES ('".$empresa."','".$email."','".$condominio."')";
			$result = $conn->query($sql);
		}
	}else{	
		$email1=$emails;
		$sql = "SELECT * FROM empresas WHERE email='".$email1."'";
    	$result = $conn->query($sql);
    	while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
    		$destinatario=$row['nome'];
    	}
	}
	
	$sql = "SELECT * FROM user WHERE condominio='".$condominio."'";
    $result = $conn->query($sql);
    while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
    	if ($row['tipo']=="condominio") {
    		$email2=$row['email'];
    		$destinatario2=$row['usuario'];
    	}
    }

	$arquivo 	= $_FILES['nArquivo']['name'];
	
	//Pasta onde o arquivo vai ser salvo
	$_UP['pasta'] = '../foto/';
	
	//Tamanho máximo do arquivo em Bytes
	$_UP['tamanho'] = 1024*1024*100; //5mb
	
	//Array com a extensões permitidas
	$_UP['extensoes'] = array('png', 'jpg', 'jpeg', 'gif');
	
	//Renomeiar
	$_UP['renomeia'] = false;
	
	//Array com os tipos de erros de upload do PHP
	$_UP['erros'][0] = 'Não houve erro';
	$_UP['erros'][1] = 'O arquivo no upload é maior que o limite do PHP';
	$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especificado no HTML';
	$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
	$_UP['erros'][4] = 'Não foi feito o upload do arquivo';
	
	//Verifica se houve algum erro com o upload. Sem sim, exibe a mensagem do erro
	if($_FILES['nArquivo']['error'] != 0){
		die("Não foi possivel fazer o upload, erro: <br />". $_UP['erros'][$_FILES['nArquivo']['error']]);
		exit; //Para a execução do script
	}
	
	//Faz a verificação da extensao do arquivo
	$extensao = strtolower(end(explode('.', $_FILES['nArquivo']['name'])));
	if(array_search($extensao, $_UP['extensoes'])=== false){		
		echo "
			<script type=\"text/javascript\">
				window.location.replace(\"../index2.php?status=".$status."&userLogado=".$userLogado."&cond=".$condominio."\");
				alert(\"A imagem não foi cadastrada extesão inválida.\");
			</script>
		";
	}
	
	//Faz a verificação do tamanho do arquivo
	else if ($_UP['tamanho'] < $_FILES['nArquivo']['size']){
		echo "
			<script type=\"text/javascript\">
				window.location.replace(\"../index2.php?status=".$status."&userLogado=".$userLogado."&cond=".$condominio."\");
				alert(\"Arquivo muito grande.\");
			</script>
		";
	}
	
	//O arquivo passou em todas as verificações, hora de tentar move-lo para a pasta foto
	else{
		//Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
		$nome_final = time().'.jpg';
		
		//Verificar se é possivel mover o arquivo para a pasta escolhida
		if(move_uploaded_file($_FILES['nArquivo']['tmp_name'], $_UP['pasta']. $nome_final)){
			//Upload efetuado com sucesso, exibe a mensagem
			$sql = "INSERT INTO os_".$condominio." (data_criacao,zelador_abriu,descricao,obs,foto,status) VALUES (now(),'".$userLogado."','".$desc."','".$coment."','foto/".$nome_final."','1')";
			$result = $conn->query($sql);

			$sql = "SELECT * FROM os_".$condominio." WHERE enviado='0' ";
			$result = $conn->query($sql);

			while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
				$os=$row['numero_os'];
				$data=$row['data_criacao'];
				$sql = "UPDATE os_".$condominio." SET enviado='1' WHERE numero_os='".$os."' ";
				$result = $conn->query($sql);    			
    		}

    		$destinatario3=$condominio;

    		if ($condominio=='Residencial_Aquarela') {
    			$email3='guardiao.aquarela@gmail.com';
    		}elseif($condominio=='Escritorio'){
    			$email3='escritorio.guardiao@gmail.com';
    		}else{
    		    $email3='guardiao.rossi@gmail.com';
    		}
			echo "
				<script type=\"text/javascript\">
					window.location.replace(\"../enviaEmail.php?status1=".$status."&userLogado=".$userLogado."&data=".$data."&cond=".$condominio."&nComentario=".$coment."&nDescricao=".$desc."&os=".$os."&foto=".$nome_final."&destinatario=".$destinatario."&email1=".$email1."&destinatario2=".$destinatario2."&email2=".$email2."&destinatario3=".$destinatario3."&email3=".$email3."\");
				</script>
			";	
		}}/*else{
			//Upload não efetuado com sucesso, exibe a mensagem
			echo "
				<script type=\"text/javascript\">
					window.location.replace(\"../index2.php?status=".$status."&userLogado=".$userLogado."&cond=".$condominio."\");
					alert(\"Imagem não foi cadastrada com Sucesso.\");
				</script>
			";
		}*/
	//window.location.replace(\"../index2.php?status=".$status."&userLogado=".$userLogado."&cond=".$condominio."&os=".$os."\");
?>