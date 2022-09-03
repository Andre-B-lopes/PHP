<?php
require_once('conn/conn.php');

$nome=$_POST['nNome'];
$cpf=$_POST['nCpf'];
$email=$_POST['nEmail'];
$senha=$_POST['nSenha'];
$tipo=$_POST['nPerfil'];
$cond=$_POST['condominio'];
if($_POST['editar']){$editar = $_POST['editar'];}else{$editar = '0';}

?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/icone-guardiao.ico">

    <title>Cadastro de Usuários</title>

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
        <ul class="navbar-nav mr-auto">
          <li class="nav-item"></li>
          <li class="nav-item"></li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Número da OS" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
        </form>
      </div>
    </nav>

    <main role="main" class="container">
    	<div class="card">
  			<div class="card-header">
    			<h4><i class="fas fa-edit fa-1x"></i> Cadastro de usuários</h4>
    		</div>
    			<form action="admin.php">
    				<?php
    					if ($editar!='0') {
                $sql = "UPDATE user SET usuario='".$nome."', pass='".$senha."', email='".$email."', cpf='".$cpf."', condominio='".$cond."', tipo='".$tipo."' WHERE codigo='".$editar."'";
                $result = $conn->query($sql);
                echo "<div class=\"alert alert-success text-center\" role=\"alert\">
                    <h4 class=\"alert-heading\">Usuário alterado com sucesso!</h4>
                      <p></p>
                   </div>";
              }else{
                $sql = "SELECT * FROM user";
  						  $result = $conn->query($sql);
                while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
 							    if($row['usuario']==$nome){
					    		 $flag=0; 
        					 break;
    						  }else{
    							 $flag=1;
    						  }
  						  }
  						  if($flag==0){
  							//Alterado a exibição da mensagem de falha -->
  							echo "<div class=\"alert alert-danger text-center\" role=\"alert\">
  								  	<h4 class=\"alert-heading\">Falha na cadastro do Usuário!</h4>
  								  	<p> Já existe usuário com esse nome.</p>
  								  </div>";
  						  }else{
  						    $sql = "INSERT INTO user (usuario,pass,email,cpf,condominio,tipo) VALUES ('".$nome."','".$senha."','".$email."','".$cpf."','".$cond."','".$tipo."')";
  						    $result = $conn->query($sql);
  						 	  //Alterado a exibição da mensagem de sucesso -->
  						 	  echo "<div class=\"alert alert-success text-center\" role=\"alert\">
  						 			<h4 class=\"alert-heading\">Usuário cadastrado com sucesso!</h4>
  								  	<p></p>
  						 		 </div>";
  						    }
                } 
    				?>
    					    			
					<div align="center">
						<button type="submit"  class="btn btn-primary" data-dismiss="modal">Cadastrar Novo Usuário</button><br><br>
					</form>
					<form action="index.php" method="post">
						<input type="hidden" name="nUser" value="admin">
						<input type="hidden" name="nPass" value="gu@rdiao2013">
						<button type="submit"  class="btn btn-secondary" data-dismiss="modal">Voltar</button>
					</div>
    			</form>
    			
				<div class="table-responsive mt-5">
					<table class="table table-hover">
						<thead>
							<tr class="bg-info text-white">
								<th scope="col">#</th>
								<th scope="col">Nome</th>
								<th scope="col">Perfil</th>
								<th scope="col">E-mail</th>
								<th scope="col">Ações</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$sql = "SELECT * FROM user";
  							$result = $conn->query($sql);
                 	    	while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
                 	    		echo "<tr>
									  <th scope=\"row\">".$row['codigo']."</th>
									  <td>".$row['usuario']."</td>
									  <td>".$row['tipo']."</td>
									  <td>".$row['email']."</td>
									  <td>
									  <div class=\"input-group-prepend\">
									  <div class=\"input-group-text mr-3\"><a href=\"editar-user.php?editar=".$row['codigo']."&userLogado=".$userLogado."\"><i class=\"fas fa-edit fa-1x\"></i></a></div>
									  <div class=\"input-group-text\"><a href=\"admin.php?status=".$status."&condominio=".$condominio."&userLogado=".$userLogado."&excluir=".$row['codigo']."\"><i class=\"fas fa-trash-alt\"></i></a></div>
									  </div>
									  </td>
								  	  </tr>";
                 	    	}
						?>
						</tbody>
					</table>
				</div>	
				
			</div><!-- /.card -->	    



    </main><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="js/jquery-slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
