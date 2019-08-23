<?php
	session_start();

	include_once("../controller/AdminDAO.php");
	include_once("../model/AdminModel.php");
	
	$login = isset($_POST['login'])?$_POST['login']:"";
	$senha = isset($_POST['senha'])?$_POST['senha']:"";

	if(!empty($login) and !empty($senha) and !empty($_POST['logar'])){ 
	    $admin = new Admin();
	    $admin->setLogin($login);
	    $admin->setSenha($senha);
	    $resultado = logar_admin($admin); 
	    if(!empty($resultado)){
	      $_SESSION['login'] = $resultado['login']; 
	      $_SESSION['senha'] = $resultado['senha'];
	    }
	    
	}

  if(empty($_SESSION['login']) or empty($_SESSION['senha'])){
?>

<!DOCTYPE html>
<html>
<head>
	<title>Modesto Idiomas</title>
	<meta charset="utf-8">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/index.css">
</head>
<body>
	<div class="wrapper fadeInDown">
		<div id="formContent">
			<p></p>

		    <!-- Login Form -->
		    <form method="post">
		    	<input type="text" id="login" class="fadeIn second" name="login" placeholder="login">
		    	<input type="text" id="password" class="fadeIn third" name="senha" placeholder="senha">
		    	<input type="submit" class="fadeIn fourth" value="Entrar" name="logar">
		    </form>
		</div>
	</div>
</body>
</html>
<?php }
  else{
    header("location:inicio.php");
  } 
  

?>