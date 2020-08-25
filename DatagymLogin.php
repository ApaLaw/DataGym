<?php
session_start();

include_once("gestionDB.php");
include_once("gestionUsuarios.php");

if (isset($_POST['submit'])){
	$email= $_POST['email'];
	$pass = $_POST['pass'];

	$conexion = crearConexionBD();
	$num_usuarios = consultarUsuario($conexion,$email,$pass);
	cerrarConexionBD($conexion);	
	
	if ($num_usuarios == 0)
		$login = "error";	
	else {
		$_SESSION['login'] = $email;
		Header("Location: DatagymLogged.php");
	}	
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Datagym</title>
	<link rel="shortcut icon" href="../logodatagym.ico" type="image/ico"/>
	<link rel="stylesheet" type="text/css" href="css/DatagymRegister.css">
	<link rel="stylesheet" type="text/css" href="css/desplegable.css">
	<script src="js/desplegable.js"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="js/resaltarCajas.js"></script>
</head>

<body>

	<main>
		<ul class="topnav" id="myTopnav">
			<li><a href="Datagym.php">Home</a></li>
			<li><a href="DatagymContact.php">Contact</a></li>
			<li><a href="DatagymAbout.php">About</a></li>
			<li style="float: right;"><a href="DatagymRegister.php">Register</a></li>
			<li style="float: right;"><a class="active" href="DatagymLogin.php">Login</a></li>
			<li class="icon">
				<a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
			</ul>
			

			<a class="logoCentral" href="Datagym.php"><img class="logoCentral" src="images/logodatagym.png" alt="logoCentral"/></a>
			<br><br><br>


			<?php if (isset($login)) {
				echo "<p style='text-align: center;'>";
				echo "Error en la contraseña o no existe el usuario.";
				echo "</p><br>";
			}	
			?>


			<div id="registro">
				<form action="DatagymLogin.php" method="post">
					<div class="cabecera1">Correo</div><div class="cabecera1">Contraseña</div>

					<div class="input1">
						<input type="text" name="email" id="email" class="inputbox" placeholder="Correo"/>
					</div>

					<div style="padding-bottom: 50px;" class="input1">
						<input type="password" name="pass" id="pass" class="inputbox" placeholder="Contraseña"/>
					</div>

					<div class="input2">
						<input id="Enviar" type="submit" name="submit" value="Enviar" />
					</div>
				</form>
				<br>
			</div>
			<br><br><br><br><br><br><br><br><br><br><br>	

			<p align="center">"VEN A SEVENGYM, Y PONTE FUERTOTE"</p>
			

		</main>


	</body>
	</html>

