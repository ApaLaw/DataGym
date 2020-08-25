<?php
session_start();

require_once("gestionDB.php");
require_once("gestionUsuarios.php");

	// Si no existen datos del formulario en la sesión, se crea una entrada con valores por defecto
if (!isset($_SESSION['formulario'])) {
	$formulario['nombre'] = "";
	$formulario['apellido'] = "";
	$formulario['dni'] = "";
	$formulario['telefono'] = "";
	$formulario['fechaNacimiento'] = "";
	$formulario['correo'] = "";
	$formulario['direccion'] = "";
	$formulario['codigo_postal'] = "";
	$formulario['contraseña'] = "";
	$formulario['contraseña_repe'] = "";
	$formulario['cod_access'] = "";
	
	$_SESSION['formulario'] = $formulario;
}
	// Si ya existían valores, los cogemos para inicializar el formulario
else
	$formulario = $_SESSION['formulario'];

	// Si hay errores de validación, hay que mostrarlos y marcar los campos (El estilo viene dado y ya se explicará)
if (isset($_SESSION["errores"])) {
	$errores = $_SESSION["errores"];
	unset($_SESSION["errores"]);
}

	// Creamos una conexión con la BD
$conexion = crearConexionBD();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Datagym</title>
	<link rel="shortcut icon" href="../logodatagym.ico" type="image/ico"/>
	<link rel="stylesheet" type="text/css" href="css/DatagymRegister.css">
	<script src="js/Validaciones.js"></script> 
	<link rel="stylesheet" type="text/css" href="css/desplegable.css">
	<script src="js/desplegable.js"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="js/fadeRegister.js"></script>
	<script src="js/resaltarCajas.js"></script>
</head>
<body>	
	
	<ul class="topnav" id="myTopnav">
		<li><a href="Datagym.php">Home</a></li>
		<li><a href="DatagymContact.php">Contact</a></li>
		<li><a href="DatagymAbout.php">About</a></li>
		<li style="float: right;"><a class="active"  href="DatagymRegister.php">Register</a></li>
		<li style="float: right;"><a href="DatagymLogin.php">Login</a></li>
		<li class="icon">
			<a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
		</ul>

		<a class="logoCentral" href="Datagym.php"><img class="logoCentral" src="images/logodatagym.png" alt="logoCentral"/></a>
		<br><br><br>


		<?php 
		// Mostrar los erroes de validación (Si los hay)
		if (isset($errores) && count($errores)>0) { 
			echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h4> Errores en el formulario:</h4>";
			foreach($errores as $error) echo $error; 
			echo "</div>";
		}
		?>
		<div style="text-align: center; width: 100%;">
			<button id="buttonfade">Registrate aquí</button>
		</div>
		<div style="display: none" id="registro">
			<form id="altaUsuario" method="post" action="validacion_alta_usuario.php" onsubmit="return validaUsuario(this)">

				<div class="cabecera1">Nombre</div>                      <div class="cabecera1">Apellido</div>

				<div class="input1">
					<input type="text" id="nombre" class="inputbox" name="nombre" placeholder="Ej: David" value="<?php echo $formulario['nombre'];?>" required>
				</div>

				<div class="input1">
					<input type="text" id="apellido" class="inputbox" name="apellido" placeholder="Ej: Brincau" value="<?php echo $formulario['apellido'];?>" required>
				</div>



				<div class="cabecera1">DNI</div>                      <div class="cabecera1">Telefono</div>

				<div class="input1">
					<input type="text" id="dni" class="inputbox" name="dni" placeholder="Ej: 12345678X" pattern="^[0-9]{8}[A-Z]" value="<?php echo $formulario['dni'];?>"  minlength="9" maxlength="9" title="El DNI debe contener 8 números y una letra mayúscula acorde al DNI" required>
				</div>

				<div class="input1">
					<input type="phone" id="telefono" class="inputbox" name="telefono" placeholder="Ej: 613123456" value="<?php echo $formulario['telefono'];?>" pattern="^[0-9]{9}" title="El teléfono debe tener 9 dígitos">
				</div>



				<div class="cabecera1">Correo</div>                      <div class="cabecera1">F. Nacimiento</div>

				<div class="input1">
					<input type="mail" id="correo" class="inputbox" name="correo" placeholder="Ej: usuario@dominio.extension" value="<?php echo $formulario['correo'];?>" required>
				</div>

				<div class="input1">
					<input type="date" id="fechaNacimiento" class="inputbox" name="fechaNacimiento" placeholder="Fecha de Nacimiento" value="<?php echo $formulario['fechaNacimiento'];?>" required>
				</div>



				<div class="cabecera1">Direccion</div>                      <div class="cabecera1">C.Postal</div>

				<div class="input1">
					<input type="text" id="direccion" class="inputbox" name="direccion" placeholder="Ej: C/Cuna 32" value="<?php echo $formulario['direccion'];?>">
				</div>

				<div class="input1">
					<input type="number" id="codigo_postal" class="inputbox" name="codigo_postal" placeholder="Ej: 41020" value="<?php echo $formulario['number'];?>" pattern=".[0-9]{5}" title="El código postal debe tener 5 dígitos">
				</div>



				<div class="cabecera1">Contraseña</div>                      <div class="cabecera1">Repita Contraseña</div>

				<div class="input1">
					<input type="password" id="contraseña" class="inputbox" name="contraseña" placeholder="Mínimo 8 caracteres entre letras y dígitos" value="<?php echo $formulario['contraseña'];?>" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="La contraseña debe contener 8 dígitos y letras, mayúsculas y minúsculas" required>
				</div>

				<div class="input1">
					<input type="password" id="contraseña_repe" class="inputbox" name="contraseña_repe" placeholder="Repetir Contraseña" value="<?php echo $formulario['contraseña_repe'];?>" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="La contraseña debe contener 8 dígitos y letras, mayúsculas y minúsculas" required>
				</div>



				<div class="cabecera2">Codigo de Acceso</div>

				<div class="input2">
					<input type="text" id="cod_access" class="inputbox" name="cod_access" placeholder="Codigo de Acceso" value="<?php echo $formulario['cod_access'];?>" required>
				</div>



				<button type="submit" id="Enviar" value="Enviar">Registrarse</button>
				<br><br>

			</form>
		</div>
		<br><br><br><br><br><br><br><br><br><br><br>	

		<p align="center">"VEN A SEVENGYM, Y PONTE FUERTOTE"</p>

		<?php
		cerrarConexionBD($conexion);
		?>

	</body>
	</html>