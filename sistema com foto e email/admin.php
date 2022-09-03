<?php
require_once('conn/conn.php');

$userLogado=$_GET['userLogado'];

if($_GET['excluir']){$excluir = $_GET['excluir'];}else{$excluir = '0';}

if($excluir!='0'){
  $sql = "DELETE FROM user WHERE codigo = ".$excluir."";
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
    	<div class="card">
  			<div class="card-header">
    			<h3><i class="fas fa-edit fa-1x"></i> Cadastro de usuários</h3>
    		</div>
    		<div class="card-body">
		    	<form action="admin-concluido.php" method="post">
		    		<fieldset>
			    		<div class="form-group row">
			    			<label for="iNome" class="col-sm-2 col-form-label">Nome:</label>
			    			<div class="col-sm-10">
			    				<input type="text" class="form-control text-uppercase" id="iNome" name="nNome" autofocus requerid>
			    			</div>
			    		</div>
			    		<div class="form-group row">
			    			<label for="iCpf" class="col-sm-2 col-form-label">CPF:</label>
			    			<div class="col-sm-10">
			    				<input type="text" class="form-control" id="iCpf" name="nCpf" requerid>
			    			</div>
			    		</div>
			    		<div class="form-group row">
			    			<label for="iEmail" class="col-sm-2 col-form-label">E-mail:</label>
			    			<div class="col-sm-10">
			    				<input type="email" class="form-control" id="iEmail" name="nEmail" required>
			    			</div>
			    		</div>
			    		<div class="form-group row">
			    			<label for="iSenha" class="col-sm-2 col-form-label">Senha:</label>
			    			<div class="col-sm-10">
			    				<input type="password" class="form-control" id="iSenha" name="nSenha" required>
			    			</div>
			    		</div>
			    		<fieldset>
			    				<legend><h3><!-- <i class="fas fa-user-circle fa-w-16 fa-2x"></i>--> <i class="fas fa-user-circle"></i> Perfil</h3></legend>
					    		<div class="form-check mb-2">
					    			<input class="form-check-input" type="radio" name="nPerfil" id="iZelador" value="zelador" checked>
					    			<label class="form-check-label" for="perfil1">
					    				Zelador
					    			</label>
					    		</div>
					    		<div class="form-check mb-4">
					    			<input class="form-check-input" type="radio" name="nPerfil" id="iCondominio" value="condominio">
					    			<label class="form-check-label" for="perfil3">
					    				Condomínio
					    			</label>
					    		</div>
					    		<legend><h3><!-- <i class="fas fa-user-circle fa-w-16 fa-2x"></i>--> <i class="fa fa-home fa-1x"></i> Condomínio</h3></legend><br>
					    		<?php
            						$sql = "SELECT * FROM condominios";
            						$result = $conn->query($sql);
						            while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
						            	echo "
						            	<div class=\"form-check mb-2\">
						            	<input class=\"form-check-input\" type=\"radio\" name=\"condominio\" value=".$row['nome'].">".$row['nome']."
						            	</div>
						            	";
						            }
					    		?>
					    		
					    		<div class="modal-footer">
							      	<button type="submit" class="btn btn-primary">Salvar</button></form>
							    	<form action="index.php" method="post" class="text-center">
										<input type="hidden" name="nUser" value="admin">
										<input type="hidden" name="nPass" value="gu@rdiao2013">
										<button type="submit"  class="btn btn-secondary" data-dismiss="modal">Voltar</button>
									</form>	
								</div>	
								
						    </fieldset>	
				  	</fieldset>
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
