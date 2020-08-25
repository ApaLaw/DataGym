<?php 
session_start();

require_once ("gestionDB.php");


	// Si no existen datos del formulario en la sesión, se crea una entrada con valores por defecto
if (!isset($_SESSION['formularioTe'])) {
	$formularioTe['nombre'] = "";
	$formularioTe['telefono'] = "";
	$formularioTe['correo'] = "";
	
	$_SESSION['formularioTe'] = $formularioTe;
}
	// Si ya existían valores, los cogemos para inicializar el formulario
else
	$formularioTe = $_SESSION['formularioTe'];

	// Si hay errores de validación, hay que mostrarlos y marcar los campos (El estilo viene dado y ya se explicará)
if (isset($_SESSION["errores"])) {
	$errores = $_SESSION["errores"];
	unset($_SESSION["errores"]);
}

$conexion = crearConexionBD();

$query = "SELECT * from tecnicos";

$qs = $conexion->prepare($query);
$qs->execute();
$arrayusuario=$qs->fetchAll();
$tecnicos=$arrayusuario;


cerrarConexionBD($conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Datagym</title>
	<link rel="shortcut icon" href="../logodatagym.ico" type="image/ico"/>
	<link rel="stylesheet" type="text/css" href="css/Datagym.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/DatagymRegister.css">
	<link rel="stylesheet" type="text/css" href="css/consultasTablas.css">
	<link rel="stylesheet" type="text/css" href="css/desplegable.css">
	<script src="js/desplegable.js"></script>
	<script src="js/confirmDelete.js"></script>
</head>
<body>





	<?php
	if($_SESSION['login']=="admin@admin.sevengym") {
		?>

		<ul class="topnav" id="myTopnav">
			<li><a href="DatagymLogged.php">Home</a></li>
			<li><a href="DatagymTarifas.php">Tarifas</a></li>
			<li><a href="DatagymMaquinas.php">Maquinas</a></li>
			<li><a href="DatagymProductos.php">Productos</a></li>
			<li><a href="DatagymUsuarios.php">Usuarios</a></li>
			<li><a class="active" href="DatagymTecnicos.php">Técnicos</a></li>
			<li><a href="DatagymReposiciones.php">Reposiciones</a></li>
			<li><a href="DatagymReparaciones.php">Reparaciones</a></li>
			<li><a href="DatagymComentarios.php">Comentarios</a></li>
			<li style="float: right;"><a href="DatagymLogout.php">Logout</a></li>
			<li class="icon">
				<a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
			</ul>



		<?php } else { if (!isset($_SESSION['login']))
		Header("Location: DatagymLogin.php");
		else { ?>

			<ul class="topnav" id="myTopnav">
				<li><a href="DatagymLogged.php">Home</a></li>
				<li><a class="active" href="DatagymTarifas.php">Tarifas</a></li>
				<li><a href="DatagymMaquinas.php">Maquinas</a></li>
				<li><a href="DatagymProductos.php">Productos</a></li>
				<li><a href="DatagymContact.php">Contact</a></li>
				<li><a href="DatagymAbout.php">About</a></li>
				<li style="float: right;"><a href="DatagymLogout.php">Logout</a></li>
				<li style="float: right;"><a href="DatagymPerfil.php">Perfil</a></li>
				<li class="icon">
					<a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
				</ul>

			<?php } } ?>








			<a class="logoCentral" href="DatagymLogged.php"><img class="logoCentral" src="images/logodatagym.png" alt="logoCentral"/></a>

			<?php 
		// Mostrar los erroes de validación (Si los hay)
			if (isset($errores) && count($errores)>0) { 
				echo "<div id=\"div_errores\" class=\"error\">";
				echo "<h4> Errores en el formulario:</h4>";
				foreach($errores as $error) echo $error; 
				echo "</div>";
			}
			?>
			<table id="tTabla">

				<tr>

					<th>Nombre</th>

					<th>Teléfono</th>

					<th>Correo</th>
				</tr>
				<?php

				foreach($tecnicos as $tecnico) {

					?>
					<form action="borrar_tecnico.php">
						<tr>

							<td><?php echo $tecnico[1];?></td>

							<td><?php echo $tecnico[2];?></td>

							<input id="correo" name="correo" type="hidden" value="<?php echo $tecnico[3]; ?>"/>
							<td><?php echo $tecnico[3];?><button type="submit" onclick="return confirmar()" class="botbor"><img src="images/remove_menuito.bmp" class="editar_fila" alt="Borrar usuario"></button></td>

						</tr>
					</form>
					<?php

				}

				?>

			</table>
			
			<p style="padding-top: 150px;" id="insertTec">Insertar Nuevo Técnico:</p>

			<?php if(isset($tecnico['correo'])) { 
				print_r($tecnico["correo"]);
			} ?>


			<div id="registro">
				<form id="altaUsuario" method="get" action="validacion_alta_tecnico.php" onsubmit="return validaTecnico(this)">
					
					<div style="text-align: center; padding-top: 20px; color: white;">Nombre</div>
					<div style="text-align: center; padding-top: 20px; color: white;">
						<input type="text" id="nombre" name="nombre" placeholder="Ej: David" value="<?php echo $formularioTe['nombre'];?>" required>
					</div>

					<div style="text-align: center; padding-top: 20px; color: white;">Telefono</div>
					<div style="text-align: center; padding-top: 20px; color: white;">
						<input type="text" id="telefono" name="telefono" placeholder="Ej: 635123456" value="<?php echo $formularioTe['telefono'];?>" pattern="[0-9]{9}" minlenght="9" maxlenght="9" required>
					</div>
					
					<div style="text-align: center; padding-top: 20px; color: white;">Correo</div>
					<div style="text-align: center; padding-top: 20px; color: white; padding-bottom: 30px;">
						<input type="text" id="correo" name="correo" placeholder="Ej: correo@cor.com" value="<?php echo $formularioTe['correo'];?>" required>
					</div>
					
					
					<button type="submit" id="Enviar" value="Enviar">Registrar</button>
					<br><br>
					
				</form>
			</div>
			<br><br><br><br><br><br><br><br><br><br><br>

			<p align="center">"VEN A SEVENGYM, Y PONTE FUERTOTE"</p>



		</body>
		</html>