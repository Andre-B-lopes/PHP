	<?php
require_once('conn/conn.php');

  $status=$_GET['status'];
  $userLogado = $_GET['userLogado'];
  $condominio=$_GET['cond'];

if($_GET['nCond']){$cond = $_GET['nCond'];}else{$cond = '0';}

if ($cond!='0') {
    $cond = str_replace(' ', '_', $cond);
    $cond = str_replace('á', 'a', $cond);
    $cond = str_replace('Á', 'A', $cond);
    $cond = str_replace('é', 'e', $cond);
    $cond = str_replace('É', 'E', $cond);
    $cond = str_replace('í', 'i', $cond);
    $cond = str_replace('Í', 'I', $cond);
    $cond = str_replace('ó', 'o', $cond);
    $cond = str_replace('Ó', 'O', $cond);
    $cond = str_replace('ú', 'u', $cond);
    $cond = str_replace('Ú', 'U', $cond);
    $cond = str_replace('à', 'a', $cond);
    $cond = str_replace('À', 'A', $cond);
    $cond = str_replace('è', 'e', $cond);
    $cond = str_replace('È', 'E', $cond);
    $cond = str_replace('ì', 'i', $cond);
    $cond = str_replace('Ì', 'I', $cond);
    $cond = str_replace('ò', 'o', $cond);
    $cond = str_replace('Ò', 'O', $cond);
    $cond = str_replace('ù', 'u', $cond);
    $cond = str_replace('Ù', 'U', $cond);
    $cond = str_replace('ã', 'a', $cond);
    $cond = str_replace('Ã', 'A', $cond);
    $cond = str_replace('õ', 'o', $cond);
    $cond = str_replace('Õ', 'O', $cond);
    $cond = str_replace('â', 'a', $cond);
    $cond = str_replace('Â', 'A', $cond);
    $cond = str_replace('ê', 'e', $cond);
    $cond = str_replace('Ê', 'E', $cond);
    $cond = str_replace('î', 'i', $cond);
    $cond = str_replace('Î', 'I', $cond);
    $cond = str_replace('ô', 'o', $cond);
    $cond = str_replace('Ô', 'O', $cond);
    $cond = str_replace('û', 'u', $cond);
    $cond = str_replace('Û', 'U', $cond);
    $cond = str_replace('ç', 'c', $cond);
    $cond = str_replace('Ç', 'C', $cond);
  $sql = "INSERT INTO condominios (nome) VALUES ('".$cond."')";
  $result = $conn->query($sql);
  $sqlcriatabela = "CREATE TABLE os_".$cond." (numero_os INT(11) AUTO_INCREMENT PRIMARY KEY, data_criacao DATE, data_execucao DATE, data_finalizado DATE, zelador_abriu TEXT, zelador_finalizou TEXT, descricao TEXT, obs TEXT, resultado TEXT,foto TEXT, status INT(5), enviado INT(5) NOT NULL);";
  $criatabela = $conn->query($sqlcriatabela);
      
}
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/icone-guardiao.ico">

    <title>Sistema OS</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="js/fontawesome-all.js"></script>
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="#"><img src="img/logo-guardiao-32x32.png">Guardião</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto" id="barraNavegacao">
          <?php
            if ($status=="admin" or $status=="zelador"){
              echo "<li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"#\" data-toggle=\"modal\" data-target=\"#newOs-Modal\"><i class=\"far fa-edit\"></i> Nova OS</a>
                    </li>";
            }
          ?>
        
          <?php
            if ($status=="admin"){
              echo "<li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"admin.php?userLogado=".$userLogado."\"><i class=\"fa fa-user-plus\"></i> Cadastrar Usuário</a>
                    </li>
                    <li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"#\" data-toggle=\"modal\" data-target=\"#NewCond\"><i class=\"fa fa-home\"></i> Cadastar Condomínio</a>
                    </li>";
            }
          ?>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="pesquisar.php" method="post">
          <input class="form-control mr-sm-2" type="text" placeholder="Número da OS" aria-label="Search" name="num_os">
          <input type="hidden" name="status" value="<?php echo $status ?>">
          <input type="hidden" name="condominio" value="<?php echo $condominio ?>">
          <input type="hidden" name="userLogado" value="<?php echo $userLogado ?>">
          <button class="btn btn-outline-success my-2 my-sm-0 mr-2" type="submit">Pesquisar</button>
        </form>

        <!-- Nome do usuário logado -->
        <form class="form-inline my-2 my-lg-0">
          <a class="nav-item navbar-brand" href="#">
            <i class="fas fa-user-circle fa-w-16 fa-1x"></i><span> <?php echo $userLogado ?></span>
          </a>
        </form>
      </div>
    </nav>

    <main role="main" class="container">
        <!-- Card Pendente -->
        <div class="text-center">
	        <form method="get" action="index-aberto.php" id="form-pendentes">
	        	<a href="#" onClick="document.getElementById('form-pendentes').submit();" style="text-decoration: none;">

              <input type="hidden" name="status" value="<?php echo $status ?>">
              <input type="hidden" name="userLogado" value="<?php echo $userLogado ?>">              
              <input type="hidden" name="condominio" value="<?php echo $condominio ?>">

	        		<div class="card text-white bg-danger mb-3">
	        			<div class="card-header">Pendentes
	        				<span class="badge badge-light">

	    					<?php
	    					 
	    					mysqli_query($conn,"SELECT * FROM os_".$condominio." WHERE status!=3");
	    					$compara= mysqli_affected_rows($conn);
	    					echo $compara;
	    					?>
	    					</span> 
	        			</div>
	    				<div class="card-body">
	    					<h5 class="card-title"><i class="far fa-folder-open fa-3x"></i></h5>
	    					<p class="card-text">OS aberta e em manutenção.</p>
	    				</div>
	    			</div>
	        	</a>
	        </form>
	        <!-- ./Card Pendente-->

	        <!-- Card Finalizada -->
	        <form method="post" action="index-finalizado.php" id="form-finalizadas">
	        	<a href="#" onClick="document.getElementById('form-finalizadas').submit();" style="text-decoration: none;">

              <input type="hidden" name="status" value="<?php echo $status ?>">
              <input type="hidden" name="userLogado" value="<?php echo $userLogado ?>">              
              <input type="hidden" name="condominio" value="<?php echo $condominio ?>">

	        		<div class="card text-white bg-success mb-3"">
	        			<div class="card-header">Finalizadas
	        				<span class="badge badge-light">
	        					<?php
	        					
	        					mysqli_query($conn,"SELECT * FROM os_".$condominio." WHERE status=3");
	        					$compara= mysqli_affected_rows($conn);
	        					echo $compara;
	        					?>
	        				</span>
	        			</div>
	        			<div class="card-body">
	        				<h5 class="card-title"><i class="fas fa-check fa-3x"></i></h5>
	        				<p class="card-text">OS concluída</p>
	        			</div>
	        		</div>
	        	</a>
	        </form>
	    </div>		
    	<!-- ./Card Finalizada-->

      
      <!-- modal-new-os-->
      <div class="modal fade" id="newOs-Modal" tabindex="-1" role="dialog" aria-labelledby="newOs-ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-secondary text-white">
              <h5 class="modal-title" id="newOs-ModalLabel"><i class="far fa-edit"></i> Inserir nova OS</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              	<form name="newos" action="fotos/proc_upload.php" method="post" enctype="multipart/form-data">

	                <input type="hidden" name="status" value="<?php echo $status ?>">
                  <input type="hidden" name="userLogado" value="<?php echo $userLogado ?>">              
                  <input type="hidden" name="condominio" value="<?php echo $condominio ?>">
	                <div class="form-group">
	                  <label for="descricao"><h6><strong> Título: </strong></h6></label>
	                  <textarea type="text" class="form-control" name="nDescricao" id="descricao" placeholder="Escreva aqui..." required></textarea>
	                </div>
	                
	                <label><i class="fas fa-camera fa-2x"></i><strong> Inserir foto:</strong></label><br>
                  <input type="file" name="nArquivo" id="iArquivo" class="mb-3">
	               
	                <br>
	                <label for="comentario"><h6><strong> Descrição: </strong></h6></label>
	                <textarea type="text" class="form-control" name="nComentario" id="comentario" placeholder="Escreva aqui..." required></textarea>   

                  <h6 class="mt-3"><strong><i class="fa fa-envelope"></i> Novo e-mail: </strong></h6>


                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">E-mail</div>
                    </div>
                    <input type="text" class="form-control" id="iEmail" name="email" placeholder="E-mail do destinatário">
                  </div>

                   <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Empresa:</div>
                    </div>
                    <input type="text" class="form-control" id="iempresa" name="empresa" placeholder="Nome da empresa">
                  </div>

                  <div class="table-responsive mt-3">
                    <div id="iGrupoRadio">
                    <table class="table table-hover">
                      <thead>
                        <tr class="bg-info text-white">
                          <th scope="col" class="text-center">Selecione</th>
                          <th scope="col">Empresa</th>
                          <th scope="col">E-mail</th>
                        </tr>
                      </thead>  
                      
                      <?php
                      $sql = "SELECT * FROM empresas WHERE condominio= '".$condominio."'";
                      $result = $conn->query($sql);
                      $contador=0;

                        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
                          $contador=$contador+1;
                          echo "
                          <tr>
                          <td class=\"text-center\"><input type=\"radio\" name=\"emails\" id=\"radio".$contador."\" value='".$row['email']."'></td>
                          <td>".$row['nome']."</td>
                          <td>".$row['email']."</td>
                          </tr>";  
                        }
                    ?>
                	
                    </table>
                  </div>
                  </div><!-- ./table-responsive -->  	            
              </div>
	            
              <div class="modal-footer">
	              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
	              <button type="button" class="btn btn-primary" id="criar_os" onclick="submitform()">Salvar</button>
	          
            </form>
          </div>
          </div><!-- ./modal-content-->
        </div><!-- ./modal-dialog-->
      </div><!-- ./modal fade-->
      
<script type="text/javascript">
    function submitform() {
    	document.getElementById("criar_os").disabled="true";
        document.newos.submit();
    }
</script>

      <!-- contact modal -->
      <div class="modal fade centered-modal" id="NewCond" tabindex="-1" role="dialog" aria-labelledby="contactLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header bg-secondary text-white"">
              <h4 class="modal-title center" id="contactLabel"><i class="fa fa-home"></i> Cadastrar condomínio</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <!-- Form -->
              <form action="index2.php" method="get">
                <input type="hidden" name="status" value="<?php echo $status ?>">
                <input type="hidden" name="userLogado" value="<?php echo $userLogado ?>">              
                <input type="hidden" name="condominio" value="<?php echo $condominio ?>">
                <h5 class="modal-title mb-3 mt-3" id="newOs-ModalLabel"><i class="fa fa-plus"></i> Adicionar condomínio</h5>
                
                  <div class="form-group row">
                    <label for="iNome" class="col-sm-10 col-form-label">
                      <input type="text" class="form-control" id="iNome" name="nCond" placeholder="Digite o nome do Condomínio:" required>
                    </label>
                    <div class="col-sm-2">
                      <button type="submit" class="btn btn-primary mt-2">Salvar</button>
                    </div>
                  </div> 
              </form>       
              <h3 class="text-left">Condomínios cadastrados</h3>
              <div class="table-responsive mt-3">
                <table class="table table-hover">
                  <thead>
                    <tr class="bg-info text-white">
                      <th scope="col">#</th>
                      <th scope="col">Nome</th>
                      <th scope="col">Usuários</th>
                      <th scope="col">OS</th>
                    </tr>
                  </thead>  
                    <?php
                      $sql = "SELECT * FROM condominios";
                      $result = $conn->query($sql);

                        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
                        echo "
                        <tr>
                        <th scope=\"row\">".$row['id']."</th>
                        <th>".$row['nome']."</th>";
                          
                        mysqli_query($conn,"SELECT * FROM user WHERE condominio='".$row['nome']."'");
                        $compara= mysqli_affected_rows($conn);
                        echo "<th>".$compara."</th>";
                        
                        mysqli_query($conn,"SELECT * FROM os_".$row['nome']."");
                        $compara= mysqli_affected_rows($conn);
                        echo "<th>".$compara."</th>";
                        echo "
                        </tr>";
                      }
                    ?>
                </table>
              </div><!-- ./table-responsive -->  
            </div><!-- ./modal-body -->
          </div><!-- ./modal-content -->
        </div><!-- ./modal-dialog -->
      </div><!-- ./modal-fade -->
    </main><!-- /.container -->

    <script src="js/jquery-slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/webcam.js"></script>
    
    <script>
      $(function(){
        $("#iEmail").click(function(){
          $("#iempresa").show();
          if (<?php echo $contador;?>>0) {
            for (var i = 1; i <= <?php echo $contador;?>; i++) {
              var name="#radio";
              var id_final=name+i;
              // Desmarca os radios
              $(id_final).prop("checked", false);
            }
          }
        }); 
        
        // Habilita os radios ao clicar na div (id="iGrupoRadio") que envolve os radios
        $("#iGrupoRadio").click(function(){

          $("#iEmail").val("");
          $("#iempresa").hide(); // Limpa o valor do campo e-mail.
        });   

      });     

    </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->

  </body>
</html>
