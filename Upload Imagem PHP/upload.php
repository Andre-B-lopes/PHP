<?php
//error_reporting(0);

$arquivo = $_FILES['nArquivo']['name'];
	
	//Pasta onde o arquivo vai ser salvo
	$_UP['pasta'] = 'foto/';
	
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
		die('Não foi possivel fazer o upload');
		exit; //Para a execução do script
	}
	
	//Faz a verificação da extensao do arquivo
	$extensao = strtolower(end(explode('.', $_FILES['nArquivo']['name'])));
	if(array_search($extensao, $_UP['extensoes'])=== false){		
		echo "
			<script type='text/javascript'>
				alert('A imagem não foi cadastrada extesão inválida.');
			</script>
		";
	}
	
	//Faz a verificação do tamanho do arquivo
	else if ($_UP['tamanho'] < $_FILES['nArquivo']['size']){
		echo "
			<script type='text/javascript'>
				alert('Arquivo muito grande.');
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
			echo "
				<script type='text/javascript'>
				alert('Arquivo enviado com sucesso.');
				</script>
			";	
		}}
?>