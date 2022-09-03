<?php
require_once('conn/conn.php');

$status=$_POST['status'];
$condominio=$_POST['condominio'];
$userLogado=$_POST['userLogado'];

if($_POST['nComentario']){$coment = $_POST['nComentario'];}else{$coment = '0';}
if($_POST['nDescricao']){$desc = $_POST['nDescricao'];}else{$desc = '0';}

if($desc!='0' and $coment!='0'){
  $sql = "INSERT INTO os (data_criacao,descricao,obs,status) VALUES (now(),'".$desc."','".$coment."','1')";
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
        </div>

      <div class="tab-content" id="myTabContent">

        <!--div-link-finalizadas-1-->
        <div class="tab-pane  active" id="finalizadas" role="tabpanel" aria-labelledby="finalizadas-tab">            
          <?php
            $sql = "SELECT * FROM os_".$condominio." WHERE status=3";
            $result = $conn->query($sql);

            while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
                echo "
                  <a href=\"#\" class=\"list-group-item list-group-item-action list-group-item-success\"
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
                  </td><td>".$dia."/".$mes."/".$ano." ".$hora."";
                  list ($ano, $mes, $dia) = explode("-", $row['data_finalizado']);
                  list($dia,$hora)=explode(" ", $dia);
                  echo "
                  </td></tr><tr><td>
                  Data de Finalização da OS:
                  </td><td>
                  ".$dia."/".$mes."/".$ano." ".$hora."
                  </td></tr><tr><td>
                  Zelador que finalizou:
                  </td><td>
                  ".$row['zelador_finalizou']."
                  </td></tr><tr><td>
                  Descrição:
                  </td><td>
                  ".$row['obs']."
                  </td></tr><tr><td>
                  Desfecho da Solução da OS:
                  </td><td>
                  ".$row['resultado']."
                  </td></tr>
                  </table>
                  <img src=\"".$row['foto']."\" width=\"100%\" height=\"100%\">

                  
 
                  <div class=\"button-link\">
                  </div>
                  </div><!--./collapseOne-link-1-abertas-->
                  </div><!--./tab-pane-abertas-1-->";
          }
          ?>
        </div>
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

    <script type="text/javascript">
      var captureButton=document.getElementById('capture');
      var stopButton=document.getElementById('closecam');

      captureButton.addEventListener('click', function() {
        document.getElementById('capture').innerHTML="Tirar Foto";
      });

      stopButton.addEventListener('click', function() {
        document.getElementById('capture').innerHTML="Ativar Câmera";
      
    </script>
    <script>
            function uploadEx() {
                var canvas = document.getElementById("snapshot");
                var dataURL = canvas.toDataURL("image/png");
                document.getElementById('hidden_data').value = dataURL;
                var fd = new FormData(document.forms["form1"]);
 
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'upload_data.php', true);
 
                xhr.upload.onprogress = function(e) {
                    if (e.lengthComputable) {
                        var percentComplete = (e.loaded / e.total) * 100;
                        console.log(percentComplete + '% uploaded');
                        //alert('Succesfully uploaded');
                    }
                };
 
                xhr.onload = function() {
 
                };
                xhr.send(fd);
            };
        </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="js/jquery-slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/webcam.js"></script>
  </body>
</html>
