<?php
//require_once('conn/conn.php');

if($_POST['nUser']){$user = $_POST['nUser'];}else{$user = '0';}
if($_POST['nPass']){$pass = $_POST['nPass'];}else{$pass = '0';}

//if($user!='0' and $pass!='0'){

// $sql = "SELECT * FROM user";
// $result = $conn->query($sql);

//  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
//    if($row['usuario']==$user && $row['pass']==$pass){
//     $status=$row['tipo'];
//     $userLogado = $row['usuario'];
//     $condominio=$row['condominio'];
//      echo "<script LANGUAGE=\"JavaScript\">
//            window.location.replace(\"index2.php?status=".$status."&userLogado=".$userLogado."&cond=".$condominio."\");
//            </SCRIPT>";
//      break;
//    }
//  }
//}
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/icone-guardiao.ico">

    <title>Login - Sistema OS</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
    <script src="js/fontawesome-all.js"></script>
  </head>

  <body class="text-center">
    <form class="form-signin" method="post" action="index.php">
      <img class="mb-4" src="img/logo-guardiao.png" alt="" width="100" height="100">
      <h1 class="h3 mb-3 font-weight-normal">7UP</h1>
      
        <label class="sr-only" for="inlineFormInputGroup">Login</label>
        <div class="input-group mb-2">
          <div class="input-group-prepend">
            <div class="input-group-text"><i class="fa fa-envelope"></i></div>
          </div>
          <input type="text" class="form-control" id="inlineFormInputGroup" name="nUser" placeholder="Login" required>
        </div>

        <label class="sr-only" for="inlineFormInputGroup">Senha</label>
        <div class="input-group mb-2">
          <div class="input-group-prepend">
            <div class="input-group-text mb-2"><i class="fa fa-key"></i></div>
          </div>
          <input type="password" class="form-control mb-2" id="inlineFormInputGroup" name="nPass" placeholder="Senha" required>
        </div>
    
      <!--
      <div class="checkbox mb-2">
        <label>
          <a href="#" class="text-white" data-toggle="modal" data-target="#iEsqueciSenha-Modal">Esqueci minha senha</a>
        </label>
      </div>
      -->
      
      <button class="btn btn-lg btn-dark btn-block" type="submit">Entrar</button>
      <!-- <p class="mt-5 mb-3 text-muted">&copy; 2018 - All rights reserved</p> -->
    </form>

    <!-- modal-EsqueciSenha-->
      <div class="modal fade" id="iEsqueciSenha-Modal" tabindex="-1" role="dialog" aria-labelledby="iEsqueciSenha-ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-dark text-white">
              <h5 class="modal-title" id="iEsqueciSenha-ModalLabel"><i class="far fa-envelope"></i> Recuperação de senha</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
	            <form action="login.php" method="post" id="formulario">
                <div id="mensagem"></div>
		            	<input type="email" class="form-control" name="nEmail" placeholder="E-mail" required>
			        	</div><!-- ./modal-body-->
		            <div class="modal-footer">
		              <button type="submit" class="btn btn-danger" id="btnRecuperarSenha">Enviar</button>
		      			</div><!-- ./modal-footer-->
	      			</form>
          </div><!-- ./modal-content-->
        </div><!-- ./modal-dialog-->
      </div><!-- ./modal fade-->
    
    <script src="js/jquery-slim.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>
