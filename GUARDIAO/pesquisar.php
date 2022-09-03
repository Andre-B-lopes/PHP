<?php
require_once('conn/conn.php');

$status=$_POST['status'];
$num_os=$_POST['num_os'];
$userLogado=$_POST['userLogado'];
$condominio=$_POST['condominio'];

?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/icone-guardiao.ico">

    <title>Pesquisar OS</title>

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
            if ($status=="zelador"){
              echo "<li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"#\" data-toggle=\"modal\" data-target=\"#newOs-Modal\"><i class=\"far fa-edit\"></i> Nova OS</a>
                    </li>";
            }
          ?>
        
          <?php
            if ($status=="admin"){
              echo "<li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"admin.php\"><i class=\"far fa-edit\"></i> Cadastrar Usuário</a>
                    </li>
                    <li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"#\" data-toggle=\"modal\" data-target=\"#NewCond\"><i class=\"far fa-edit\"></i> Pesquisar Condomínios</a>
                    </li>
                    <li class=\"nav-item\">
                    <a class=\"nav-link\" href=\"#\" data-toggle=\"modal\" data-target=\"#Gempresas\"><i class=\"fa fa-home\"></i> Gerenciar Empresas</a>
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
        <h4 class="mb-3 mt-3">Resultado da Pesquisa:</h4>
        <?php
          $sql = "SELECT * FROM os_".$condominio." WHERE numero_os=".$num_os."";
            $result = $conn->query($sql);

            while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
                if($row['status']==1){
                echo "
                  <a href=\"#\" class=\"list-group-item list-group-item-action list-group-item-danger\"
                  data-toggle=\"collapse\" data-target=\"#".$row['numero_os']."\" aria-expanded=\"true\" aria-controls=\"".$row['numero_os']."\">
                  <i class=\"fas fa-folder-open\"></i> ".$row['descricao']."
                  </a>
                  <!--content-link-1-abertas-->
                  <div id=\"".$row['numero_os']."\" class=\"collapse\" aria-labelledby=\"headingOne\" data-parent=\"#accordion-abertas-1\">
                  <div class=\"card-body card\">
                  Número da OS:   ".$row['numero_os']."<br><br>
                  Data de Abertura da OS:   ".$row['data_criacao']."<br>
                  Data de Execução da OS:   ".$row['data_execucao']."<br>
                  Data de Finalização da OS:   ".$row['data_finalizado']."<br><br>

                  Descrição: <br>
                  ".$row['obs']."
                  <br><br>

                  <img src=\"".$row['foto']."\" width=\"100%\" height=\"100%\">

                  <div class=\"button-link\">";

                  if ($status=="admin" or $status=="zelador"){
                    echo "<button type=\"button\" onclick=\"manutencao(".$row['numero_os'].")\" class=\"btn btn-warning\"><i class=\"far fa-clock\"></i> Em manutenção</button>
                          <button type=\"button\" onclick=\"finalizado(".$row['numero_os'].")\" class=\"btn btn-success\"><i class=\"fas fa-check\"></i> Finalizar OS</button>";
                  }
                  
                  echo "
                  </div>
                  </div><!--./collapseOne-link-1-abertas-->
                  </div><!--./tab-pane-abertas-1-->";
              }
              if($row['status']=="2"){
                echo "
                  <a href=\"#\" class=\"list-group-item list-group-item-action list-group-item-warning\"
                  data-toggle=\"collapse\" data-target=\"#".$row['numero_os']."\" aria-expanded=\"true\" aria-controls=\"".$row['numero_os']."\">
                  <i class=\"fas fa-folder-open\"></i> ".$row['descricao']."
                  </a>
                  <!--content-link-1-abertas-->
                  <div id=\"".$row['numero_os']."\" class=\"collapse\" aria-labelledby=\"headingOne\" data-parent=\"#accordion-abertas-1\">
                  <div class=\"card-body card\">
                  Número da OS:   ".$row['numero_os']."<br><br>
                  Data de Abertura da OS:   ".$row['data_criacao']."<br>
                  Data de Execução da OS:   ".$row['data_execucao']."<br>
                  Data de Finalização da OS:   ".$row['data_finalizado']."<br><br>

                  Descrição: <br>
                  ".$row['obs']."
                  <br><br>

                  <img src=\"".$row['foto']."\" width=\"100%\" height=\"100%\">

                  <div class=\"button-link\">";
                  if ($status=="admin" or $status=="zelador"){
                    echo "
                          <button type=\"button\" onclick=\"finalizado(".$row['numero_os'].")\" class=\"btn btn-success\"><i class=\"fas fa-check\"></i> Finalizar OS</button>
                          <button type=\"button\" onclick=\"reabrir(".$row['numero_os'].")\" class=\"btn btn-danger\"><i class=\"far fa-clock\"></i> Reabrir OS</button>";
                  }
                  echo "
                  </div>
                  </div><!--./collapseOne-link-1-abertas-->
                  </div><!--./tab-pane-abertas-1-->";
                  } 
                  if($row['status']=="3"){
                  echo "
                  <a href=\"#\" class=\"list-group-item list-group-item-action list-group-item-success\"
                  data-toggle=\"collapse\" data-target=\"#".$row['numero_os']."\" aria-expanded=\"true\" aria-controls=\"".$row['numero_os']."\">
                  <i class=\"fas fa-folder-open\"></i> ".$row['descricao']."
                  </a>
                  <!--content-link-1-abertas-->
                  <div id=\"".$row['numero_os']."\" class=\"collapse\" aria-labelledby=\"headingOne\" data-parent=\"#accordion-abertas-1\">
                  <div class=\"card-body card\">
                  Número da OS:   ".$row['numero_os']."<br><br>
                  Data de Abertura da OS:   ".$row['data_criacao']."<br>
                  Data de Execução da OS:   ".$row['data_execucao']."<br>
                  Data de Finalização da OS:   ".$row['data_finalizado']."<br><br>

                  Descrição: <br>
                  ".$row['obs']."
 
                  <div class=\"button-link\">
                  </div>
                  </div><!--./collapseOne-link-1-abertas-->
                  </div><!--./tab-pane-abertas-1-->";
                }
              }
        ?>
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
                    <input type="text" class="form-control" id="iEmpresa" name="empresa" placeholder="Nome da empresa">
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

      <!--modal-gerenciar-empresas-->
      <div class="modal fade centered-modal" id="Gempresas" tabindex="-1" role="dialog" aria-labelledby="contactLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header bg-secondary text-white"">
              <h4 class="modal-title center" id="contactLabel"><i class="fa fa-home"></i> Gerenciar Empresas</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
              <!-- Form -->
              <form action="index2.php" method="get">
                <input type="hidden" name="status" value="<?php echo $status ?>">
                <input type="hidden" name="userLogado" value="<?php echo $userLogado ?>">              
                <input type="hidden" name="condominio" value="<?php echo $condominio ?>">
              </form>       
              <h3 class="text-left">Empresas cadastradas</h3>
              <div class="table-responsive mt-3">
                <table class="table table-hover">
                  <thead>
                    <tr class="bg-info text-white">
                      <th scope="col">Nome</th>
                      <th scope="col">E-mail</th>
                      <th scope="col">Condominio</th>
                      <th scope="col">Ação</th>
                    </tr>
                  </thead>  
                    <?php
                      $sql = "SELECT * FROM empresas";
                      $result = $conn->query($sql);

                        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
                        echo "
                        <tr>
                        <th scope=\"row\">".$row['nome']."</th>
                        <th>".$row['email']."</th>
                        <th>".$row['condominio']."</th>
                        <td>
                        <div class=\"input-group-prepend\">
                        <div class=\"input-group-text\"><a href=\"index2.php?status=".$status."&userLogado=".$userLogado."&cond=".$condominio."&empresa=".$row['id']."\"><i class=\"fas fa-trash-alt\"></i></a></div>
                        </div>
                        </td>
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
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="js/jquery-slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/webcam.js"></script>
    <script>
      $(function(){
        $("#iEmail").click(function(){
          if (<?php echo $contador; ?>>0) {
            for (var i = 1; i <= <?php echo $contador; ?>; i++) {
              var nome="#iRadio";
              var nome_id=nome+i;
              // Desmarca os radios
              $(nome_id).prop("checked", false);
            }
          }
          
        }); 
        
        // Habilita os radios ao clicar na div (id="iGrupoRadio") que envolve os radios
        $("#iGrupoRadio").click(function(){

          $("#iEmail").val(""); // Limpa o valor do campo e-mail.
          $("#iEmpresa").val("");// Limpa o valor do campo empresa.
        });   

      });     

    </script>

  </body>
</html>