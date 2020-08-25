<?php
session_start();

include_once("gestionDB.php");
include_once("gestionUsuarios.php");

if (isset($_REQUEST['submit'])){
	$nombre = $_REQUEST['nombre'];
	$correo= $_REQUEST['correo'];
	$mensaje = $_REQUEST['mensaje'];

	$conexion = crearConexionBD();
	$errores = validarContact($conexion,$correo,$mensaje);
	if (count($errores)==0) {
		$mensaje_insertado = generar_mensaje($conexion,$nombre,$correo,$mensaje);

		if ($mensaje_insertado == false)
			$login = "error";	
		else {
			cerrarConexionBD($conexion);
		}	
	}
	cerrarConexionBD($conexion);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Datagym</title>
	<link rel="shortcut icon" href="../logodatagym.ico" type="image/ico"/>
	<link rel="stylesheet" type="text/css" href="css/DatagymRegister.css">
	<script src="js/ValidacionContact.js"></script>
	<link rel="stylesheet" type="text/css" href="css/desplegable.css">
	<script src="js/desplegable.js"></script>	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="js/resaltarCajas.js"></script>
</head>

<body>

	<main>
		<?php 
		if(isset($_SESSION['login'])) {
			?>
			<ul class="topnav" id="myTopnav">
				<li><a href="DatagymLogged.php">Home</a></li>
				<li><a href="DatagymTarifas.php">Tarifas</a></li>
				<li><a href="DatagymMaquinas.php">Maquinas</a></li>
				<li><a href="DatagymProductos.php">Productos</a></li>
				<li><a class="active" href="DatagymContact.php">Contact</a></li>
				<li><a href="DatagymAbout.php">About</a></li>
				<li style="float: right;"><a href="DatagymLogout.php">Logout</a></li>
				<li style="float: right;"><a href="DatagymPerfil.php">Perfil</a></li>
				<li class="icon">
					<a href="javascript:void(0);" style="font-size:15px;" onclick="myFunction()">☰</a>
				</ul>
				<a class="logoCentral" href="DatagymLogged.php"><img class="logoCentral" src="images/logodatagym.png" alt="logoCentral"/></a>
				<br><br><br>
			<?php } else { ?>

				<ul class="topnav" id="myTopnav">
					<li><a href="Datagym.php">Home</a></li>
					<li><a class="active" href="DatagymContact.php">Contact</a></li>
					<li><a href="DatagymAbout.php">About</a></li>
					<li style="float: right;"><a href="DatagymRegister.php">Register</a></li>
					<li style="float: right;"><a href="DatagymLogin.php">Login</a></li>
					<li class="icon">
						<a href="javascript:void(0);" style="font-size:15px;" onclick="myFunction()">☰</a>
					</ul>
					<a class="logoCentral" href="Datagym.php"><img class="logoCentral" src="images/logodatagym.png" alt="logoCentral"/></a>
					<br><br><br>
				<?php } ?>

				

				

				<?php 
		// Mostrar los erroes de validación (Si los hay)
				if (isset($errores) && count($errores)>0) { 
					echo "<div id=\"div_errores\" class=\"error\">";
					echo "<h4> Errores en el formulario:</h4>";
					foreach($errores as $error) echo $error; 
					echo "</div>";
				}
				if(isset($errores) && count($errores)==0){
					?>
					<p style="text-align: center;">El comentario se ha insertado correctamente </p>
				<?php }
				?>
				<div id="registro">
					<br>
					<form id="registroContent" action="DatagymContact.php" method="get" onsubmit="return validaContact(this)">
						<div>
							
							<div class="textoEncima">Nombre</div>
							<input type="text" id="nombre" class="inputbox" name="nombre" placeholder="Nombre">
							<br>
							<div class="textoEncima">Correo</div>
							<input type="mail" id="correo" class="inputbox" name="correo" placeholder="Correo" pattern= "^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$"name="correo" placeholder="Correo" required>	
							<br>
							<div class="textoEncima">Mensaje</div>
							<textarea id="mensaje" class="inputbox" name="mensaje" placeholder="Escribir aqui..." required></textarea>
							<br><br><br>
							<input type="submit" id="Enviar" name="submit" value="Enviar"/>
							<br><br>

						</form>
						<br>
					</div>	
					

				</main>

				<footer> 
					"VEN A SEVENGYM, Y PONTE FUERTOTE" 
				</footer>

			</body>


			</html>
