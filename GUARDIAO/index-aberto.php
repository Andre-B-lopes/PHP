<?php
require_once('conn/conn.php');

$status=$_GET['status'];
$condominio=$_GET['condominio'];
$userLogado=$_GET['userLogado'];

if($_GET['manutencao']){$manu = $_GET['manutencao'];}else{$manu = '0';}
if($_GET['fim']){$resultado = $_GET['fim'];}else{$resultado = '0';}
if($_GET['reEmail']){$reEmail = $_GET['reEmail'];}else{$reEmail = '0';}
if($_GET['reabrir']){$re = $_GET['reabrir'];}else{$re = '0';}
if($_GET['nDesfecho']){$desc = $_GET['nDesfecho'];}else{$desc = '0';}

if($manu!='0'){
  $sql = "UPDATE os_".$condominio." SET status='2', data_execucao=now() WHERE numero_os=".$manu."";
  $result = $conn->query($sql);
}
if($resultado!='0'){
  $sql = "UPDATE os_".$condominio." SET status='3', zelador_finalizou='".$userLogado."', data_finalizado=now(), resultado='".$desc."' WHERE numero_os=".$resultado."";
  $result = $conn->query($sql);

  $sql = "SELECT * FROM os_".$condominio." WHERE numero_os=".$resultado."";
  $result = $conn->query($sql);

  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $os=$row['numero_os'];
    $descricao=$row['obs'];
    $foto=$row['foto'];
    $desfecho=$row['resultado'];
    $zelador_abriu=$row['zelador_abriu'];
    $data1=$row['data_criacao'];
    $data2=$row['data_execucao'];
    $data3=$row['data_finalizado'];
  }

  $empresa = $_GET['empresa'];
  $emails = $_GET['emails'];
  $email = $_GET['email'];

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
          window.location.replace(\"enviaEmail2.php?status1=".$status."&zelador_abriu=".$zelador_abriu."&userLogado=".$userLogado."&data1=".$data1."&data2=".$data2."&data3=".$data3."&cond=".$condominio."&nComentario=".$coment."&nDescricao=".$descricao."&desfecho=".$desc."&os=".$os."&foto=".$foto."&destinatario=".$destinatario."&email1=".$email1."&destinatario2=".$destinatario2."&email2=".$email2."&destinatario3=".$destinatario3."&email3=".$email3."\");
        </script>
      ";  
}

if($reEmail!='0'){
  
  $sql = "SELECT * FROM os_".$condominio." WHERE numero_os=".$reEmail."";
  $result = $conn->query($sql);

  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $os=$row['numero_os'];
    $descricao=$row['obs'];
    $comentario=$row['descricao'];
    $foto=$row['foto'];
    $desfecho=$row['resultado'];
    $zelador_abriu=$row['zelador_abriu'];
    $data=$row['data_criacao'];
  }

  $empresa = $_GET['empresa'];
  $emails = $_GET['emails'];
  $email = $_GET['email'];

  if ($email!="" and $empresa!="") {
    $destinatario=$empresa;
    $email1=$email;
    $sql = "SELECT * FROM empresas WHERE condominio='".$condominio."'";
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
          window.location.replace(\"enviaEmail3.php?status1=".$status."&zelador_abriu=".$zelador_abriu."&userLogado=".$userLogado."&data=".$data."&cond=".$condominio."&nDescricao=".$descricao."&nComentario=".$comentario."&desfecho=".$desc."&os=".$os."&foto=".$foto."&destinatario=".$destinatario."&email1=".$email1."&destinatario2=".$destinatario2."&email2=".$email2."&destinatario3=".$destinatario3."&email3=".$email3."\");
        </script>
      ";  
}

if($re!='0'){
  $sql = "UPDATE os_".$condominio." SET status='1', data_execucao=null, data_criacao=now() WHERE numero_os=".$re."";
  $result = $conn->query($sql);
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
    <script src="js/jquery-slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/webcam.js"></script>
    <script src="js/fontawesome-all.js"></script>
    <?php
      if($_GET['finalizado']){$fim = $_GET['finalizado'];}else{$fim = '0';}
      if($fim!='0'){
        echo "<script type=\"text/javascript\">
              $(function(){
              $('#Finalizar-OS').modal('show');
              });
              </script>";
      }
      if($_GET['reenviar']){$reenviarEmail = $_GET['reenviar'];}else{$reenviarEmail = '0';}
      if($reenviarEmail!='0'){
        echo "<script type=\"text/javascript\">
              $(function(){
              $('#Reenviar-Email').modal('show');
              });
              </script>";
      }
    ?>
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

        <form class="form-inline my-2 my-lg-0">
          <a class="nav-item navbar-brand" href="#">
            <i class="fas fa-user-circle fa-w-16 fa-1x"></i><span> <?php echo $userLogado ?></span>
          </a>
        </form>

      </div>
    </nav>


    <main role="main" class="container">
      <!--nav-tabs-->

        <div class="row">
          <form method="get" action="index-aberto.php">
              <input type="hidden" name="status" value="<?php echo $status ?>">
              <input type="hidden" name="userLogado" value="<?php echo $userLogado ?>">              
              <input type="hidden" name="condominio" value="<?php echo $condominio ?>">
            <a class="nav-link active" id="abertas-tab">
              <button type="submit" class="btn btn-danger text-tab">
                <i class="far fa-folder-open"></i> Pendentes 
                <span class="badge badge-light">
                <?php
                  
                  mysqli_query($conn,"SELECT * FROM os_".$condominio." WHERE status!=3");
                  $compara= mysqli_affected_rows($conn);
                  echo $compara;
                ?> 
                </span>
                <span class="sr-only">unread messages</span>
              </button>
            </a>
          </form>

          <form method="post" action="index-finalizado.php">
              <input type="hidden" name="status" value="<?php echo $status ?>">
              <input type="hidden" name="userLogado" value="<?php echo $userLogado ?>">              
              <input type="hidden" name="condominio" value="<?php echo $condominio ?>">
            <a class="nav-link" id="finalizadas-tab">
              <button type="submit" class="btn btn-success text-tab">
                <i class="fas fa-check"></i> Finalizadas 
                <span class="badge badge-light">
                <?php
                  
                  mysqli_query($conn,"SELECT * FROM os_".$condominio." WHERE status=3");
                  $compara= mysqli_affected_rows($conn);
                  echo $compara;
                ?>
                </span>
                <span class="sr-only">unread messages</span>
              </button>
            </a>
          </form>
        </div>

      <div class="tab-content" id="myTabContent">
        <!--div-link-abertas-1-->
        <div class="tab-pane fade show active" id="abertas" role="tabpanel" aria-labelledby="abertas-tab">
          <?php
            $sql = "SELECT * FROM os_".$condominio." WHERE status!=3";
            $result = $conn->query($sql);

            while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
              if($row['status']==1){
                echo "
                  <a href=\"#\" class=\"list-group-item list-group-item-action list-group-item-danger\"
                  data-toggle=\"collapse\" data-target=\"#".$row['numero_os']."\" aria-expanded=\"true\" aria-controls=\"".$row['numero_os']."\">
                  <i class=\"fas fa-folder-open\"></i> ".$row['numero_os']." - ".$row['descricao']."
                  </a>
                  <!--content-link-1-abertas-->
                  <div id=\"".$row['numero_os']."\" class=\"collapse\" aria-labelledby=\"headingOne\" data-parent=\"#accordion-abertas-1\">
                  <div class=\"card-body card\">
                  <table border='1' cellspacing='2' cellpadding='5'>
                  	<tr><td>
	                  	Número da OS:
	                </td><td>";
                  list ($ano, $mes, $dia) = explode("-", $row['data_criacao']);
                  echo "                  
                  ".$row['numero_os']." / ".$ano."
	                </td></tr><tr><td>
	                  	Zelador que abriu:
	                </td><td>
	                  	".$row['zelador_abriu']."";
    	              	list ($ano, $mes, $dia) = explode("-", $row['data_criacao']);
        	      	  	list($dia,$hora)=explode(" ", $dia);
            		  	echo "
            		</td></tr><tr><td>
        	 		  	Data de Abertura da OS:
        	 		</td><td>
        	 		  	".$dia."/".$mes."/".$ano." ".$hora."
    	            </td></tr><tr><td>  	
    	              	Data de Execução da OS:
	                </td><td></td></tr><tr><td>
	                  	Data de Finalização da OS:
	                </td><td></td></tr><tr><td>
	                  Descrição:
	                </td><td>  
    	              ".$row['obs']."
                  	</td></tr>
                  </table>

                  <img src=\"".$row['foto']."\" width=\"100%\" height=\"100%\">

                  <div class=\"button-link\">";
                  if ($status=="admin" or $status=="zelador"){
                    echo "<button type=\"button\" onclick=\"manutencao(".$row['numero_os'].")\" class=\"btn btn-warning\"><i class=\"far fa-clock\"></i> Em manutenção</button>
                          <button type=\"button\" onclick=\"finalizado(".$row['numero_os'].")\" class=\"btn btn-success\"><i class=\"fas fa-check\"></i> Finalizar OS</button>
                          <button type=\"button\" onclick=\"reenviar(".$row['numero_os'].")\" class=\"btn btn-primary\"><i class=\"fa fa-address-card\"></i> Reenviar E-mail</button>";
                  }
                  echo "
                  </div>
                  </div><!--./collapseOne-link-1-abertas-->
                  </div><!--./tab-pane-abertas-1-->";
            
              }else{
                echo "
                  <a href=\"#\" class=\"list-group-item list-group-item-action list-group-item-warning\"
                  data-toggle=\"collapse\" data-target=\"#".$row['numero_os']."\" aria-expanded=\"true\" aria-controls=\"".$row['numero_os']."\">
                  <i class=\"fas fa-folder-open\"></i> ".$row['numero_os']." - ".$row['descricao']."
                  </a>
                  <!--content-link-1-abertas-->
                  <div id=\"".$row['numero_os']."\" class=\"collapse\" aria-labelledby=\"headingOne\" data-parent=\"#accordion-abertas-1\">
                  <div class=\"card-body card\">
                  <table border='1' cellspacing='2' cellpadding='5'>
                  <tr><td>
                  Número da OS:
                  </td><td>";
                  list ($ano, $mes, $dia) = explode("-", $row['data_criacao']);
                  echo "                  
                  ".$row['numero_os']." / ".$ano."
                  </td></tr><tr><td>
                  Zelador que abriu:
                  </td><td>
                  ".$row['zelador_abriu']."";
                  list ($ano, $mes, $dia) = explode("-", $row['data_criacao']);
              	  list($dia,$hora)=explode(" ", $dia);
              	  echo "
                  </td></tr><tr><td>
                  Data de Abertura da OS:
                  </td><td>
                  ".$dia."/".$mes."/".$ano." ".$hora."";
                  list ($ano, $mes, $dia) = explode("-", $row['data_execucao']);
              	  list($dia,$hora)=explode(" ", $dia);
              	  echo "
              	  </td></tr><tr><td>
                  Data de Execução da OS:
                  </td><td>
                  ".$dia."/".$mes."/".$ano." ".$hora." 
                  </td></tr><tr><td>
                  Data de Finalização da OS:
                  </td><td></td></tr><tr><td>
                  Descrição: 
                  </td><td>".$row['obs']."
                  </td></tr>
                  </table>
                  <img src=\"".$row['foto']."\" width=\"100%\" height=\"100%\">

                  <div class=\"button-link\">";
                  if ($status=="admin" or $status=="zelador"){
                    echo "
                          <button type=\"button\" onclick=\"finalizado(".$row['numero_os'].")\" class=\"btn btn-success\"><i class=\"fas fa-check\"></i> Finalizar OS</button>
                          <button type=\"button\" onclick=\"reabrir(".$row['numero_os'].")\" class=\"btn btn-danger\"><i class=\"far fa-clock\"></i> Reabrir OS</button>
                          <button type=\"button\" onclick=\"reenviar(".$row['numero_os'].")\" class=\"btn btn-primary\"><i class=\"fa fa-address-card\"></i> Reenviar E-mail</button>";
                  }
                  echo "
                  </div>
                  </div><!--./collapseOne-link-1-abertas-->
                  </div><!--./tab-pane-abertas-1-->";
              }
            }
          ?>
  
          <!--link-abertas-1-->
          
          <!-- ./link-1-abertas-->
        </div><!--./div-link-abertas-->  
        
      </div><!--./div-link-finalizadas-->          
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
                  <input name="hidden_data" id='hidden_data' type="hidden">
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
                    <input type="text" class="form-control" id="inlineFormInputGroup" name="email" placeholder="E-mail do destinatário">
                  </div>

                   <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Empresa:</div>
                    </div>
                    <input type="text" class="form-control" id="inlineFormInputGroup" name="empresa" placeholder="Nome da empresa">
                  </div>

                  <div class="table-responsive mt-3">
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

                        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
                        echo "
                        <tr>
                        <td class=\"text-center\"><input type=\"radio\" name=\"emails\" id=\"radio".$contador."\" value='".$row['email']."'></td>
                        <td>".$row['nome']."</td>
                        <td>".$row['email']."</td>
                        </tr>";  
                      }
                    ?>
                  
                    </table>
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

    <!--Modal-finalizar-OS-->
    <div class="modal fade" id="Finalizar-OS" tabindex="-1" role="dialog" aria-labelledby="newOs-ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-secondary text-white">
              <h5 class="modal-title" id="newOs-ModalLabel"><i class="far fa-edit"></i> Finalizar OS</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="index-aberto.php" method="get" enctype="multipart/form-data">

                  <input type="hidden" name="status" value="<?php echo $status ?>">
                  <input type="hidden" name="userLogado" value="<?php echo $userLogado ?>">              
                  <input type="hidden" name="condominio" value="<?php echo $condominio ?>">
                  <input type="hidden" name="fim" value="<?php echo $fim; ?>">
                  <div class="form-group">
                    <label for="descricao"><h6><strong> Descreva o desfecho da solução da OS: </strong></h6></label>
                    <textarea type="text" class="form-control" name="nDesfecho" id="descricao" placeholder="Escreva aqui..." required></textarea>
                  </div>
                  <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">E-mail</div>
                    </div>
                    <input type="text" class="form-control" id="inlineFormInputGroup" name="email" placeholder="E-mail do destinatário">
                  </div>

                   <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Empresa:</div>
                    </div>
                    <input type="text" class="form-control" id="inlineFormInputGroup" name="empresa" placeholder="Nome da empresa">
                  </div>

                  <div class="table-responsive mt-3">
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

                        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
                        echo "
                        <tr>
                        <td class=\"text-center\"><input type=\"radio\" name=\"emails\" id=\"radio".$contador."\" value='".$row['email']."'></td>
                        <td>".$row['nome']."</td>
                        <td>".$row['email']."</td>
                        </tr>";  
                      }
                    ?>
                  
                    </table>
                  </div><!-- ./table-responsive -->               
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            
            </form>
          </div>
          </div><!-- ./modal-content-->
        </div><!-- ./modal-dialog-->
      </div><!-- ./modal fade-->

      <!--Modal-Reenviar-Email-->
    <div class="modal fade" id="Reenviar-Email" tabindex="-1" role="dialog" aria-labelledby="newOs-ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-secondary text-white">
              <h5 class="modal-title" id="newOs-ModalLabel"><i class="far fa-edit"></i> Reenviar E-mail</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="index-aberto.php" method="get" enctype="multipart/form-data">

                  <input type="hidden" name="status" value="<?php echo $status ?>">
                  <input type="hidden" name="userLogado" value="<?php echo $userLogado ?>">              
                  <input type="hidden" name="condominio" value="<?php echo $condominio ?>">
                  <input type="hidden" name="reEmail" value="<?php echo $reenviarEmail ?>">
                   <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Empresa:</div>
                    </div>
                    <input type="text" class="form-control" id="inlineFormInputGroup" name="empresa" placeholder="Nome da empresa">
                  </div>
                   <div class="input-group mb-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">E-mail:</div>
                    </div>
                    <input type="text" class="form-control" id="inlineFormInputGroup" name="email" placeholder="E-mail da empresa">
                  </div>

                  <div class="table-responsive mt-3">
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

                        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
                        echo "
                        <tr>
                        <td class=\"text-center\"><input type=\"radio\" name=\"emails\" id=\"radio".$contador."\" value='".$row['email']."'></td>
                        <td>".$row['nome']."</td>
                        <td>".$row['email']."</td>
                        </tr>";  
                      }
                    ?>
                  
                    </table>
                  </div><!-- ./table-responsive -->               
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Salvar</button>
            
            </form>
          </div>
          </div><!-- ./modal-content-->
        </div><!-- ./modal-dialog-->
      </div><!-- ./modal fade-->

    <script type="text/javascript">
      function loading(){
        document.getElementById("criar_os").disabled=true;
      }
      function manutencao(a){
        var link = "index-aberto.php?status=<?php echo $status ?>&condominio=<?php echo $condominio ?>&userLogado=<?php echo $userLogado ?>&manutencao=";
        var link2 = a;
        window.location.replace(link.concat(link2));
      }
      function finalizado(a){
        var link = "index-aberto.php?status=<?php echo $status ?>&condominio=<?php echo $condominio ?>&userLogado=<?php echo $userLogado ?>&finalizado=";
        var link2 = a;
        window.location.replace(link.concat(link2));
      }
      function reenviar(a){
        var link = "index-aberto.php?status=<?php echo $status ?>&condominio=<?php echo $condominio ?>&userLogado=<?php echo $userLogado ?>&reenviar=";
        var link2 = a;
        window.location.replace(link.concat(link2));
      }
      function reabrir(a){
        var link = "index-aberto.php?status=<?php echo $status ?>&condominio=<?php echo $condominio ?>&userLogado=<?php echo $userLogado ?>&reabrir=";
        var link2 = a;
        window.location.replace(link.concat(link2));
      }
    </script>
    <!-- Bootstrap core JavaScript
    ================================================== -->
  </body>

</html>