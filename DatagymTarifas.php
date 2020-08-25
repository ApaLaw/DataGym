<?php 
session_start();

require_once ("gestionDB.php");


	// Si no existen datos del formulario en la sesión, se crea una entrada con valores por defecto
if (!isset($_SESSION['formularioT'])) {
	$formularioT['nombre_tarifa'] = "";
	$formularioT['precio'] = "";
	$formularioT['duracion'] = "";
	
	$_SESSION['formularioT'] = $formularioT;
}
	// Si ya existían valores, los cogemos para inicializar el formulario
else{
	$formularioT = $_SESSION['formularioT'];
}

	// Si hay errores de validación, hay que mostrarlos y marcar los campos (El estilo viene dado y ya se explicará)
if (isset($_SESSION["errores"])) {
	$errores = $_SESSION["errores"];
	unset($_SESSION["errores"]);
}

$conexion = crearConexionBD();

$query = "SELECT * from tarifas";

$qs = $conexion->prepare($query);
$qs->execute();
$arrayusuario=$qs->fetchAll();
$tarifas=$arrayusuario;


cerrarConexionBD($conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Datagym</title>
	<link rel="shortcut icon" href="../logodatagym.ico" type="image/ico"/>
	<link rel="stylesheet" type="text/css" href="css/Datagym.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/consultasTablas.css">
	<link rel="stylesheet" type="text/css" href="css/DatagymRegister.css">
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
			<li><a class="active" href="DatagymTarifas.php">Tarifas</a></li>
			<li><a href="DatagymMaquinas.php">Maquinas</a></li>
			<li><a href="DatagymProductos.php">Productos</a></li>
			<li><a href="DatagymUsuarios.php">Usuarios</a></li>
			<li><a href="DatagymTecnicos.php">Técnicos</a></li>
			<li><a href="DatagymReposiciones.php">Reposiciones</a></li>
			<li><a href="DatagymReparaciones.php">Reparaciones</a></li>
			<li><a href="DatagymComentarios.php">Comentarios</a></li>
			<li style="float: right;"><a href="DatagymLogout.php">Logout</a></li>
			<li class="icon">
				<a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
			</ul>


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

					<th>Tarifa</th>

					<th>Precio</th>

					<th>Duración</th>

				</tr>

				<?php

				foreach($tarifas as $tarifa) { 
					
					?>
					<form action="borrar_tarifa.php">
						<tr>

							<td><?php echo $tarifa[0];?></td>

							<td><?php echo $tarifa[1] . "€";?></td>

							<input id="nombre_tarifa" name="nombre_tarifa" type="hidden" value="<?php echo $tarifa[0]; ?>"/>
							
							<?php if ($tarifa[2] > 1) { ?>
								
								<td><?php echo $tarifa[2] ." meses";?><button type="submit" onclick="return confirmar()" class="botbor"><img src="images/remove_menuito.bmp" class="editar_fila" alt="Borrar tarifa"></button></td>	  

							<?php } else { ?>

								<td><?php echo $tarifa[2] ." mes";?><button type="submit" onclick="return confirmar()" class="botbor"><img src="images/remove_menuito.bmp" class="editar_fila" alt="Borrar tarifa"></button></td>	    	
								
							<?php } ?>
						</tr>
					</form>
					<?php

				}
				

				?>
				

			</table>


			<p style="padding-top: 150px;" id="insertTec">Insertar Nueva Tarifa:</p>

			<?php if(isset($tarifa['nombre_tarifa'])) { 
				print_r($tarifa["nombre_tarifa"]);
			} ?>


			<div id="registro">
				<form id="altaUsuario" method="get" action="validacion_alta_tarifa.php" onsubmit="return validaTarifa(this)">
					
					<div style="text-align: center; padding-top: 20px; color: white;">Nombre</div>
					<div style="text-align: center; padding-top: 20px; color: white;">
						<input type="text" id="nombre_tarifa" name="nombre_tarifa" placeholder="Ej: Basico" value="<?php echo $formularioT['nombre_tarifa'];?>" required>
					</div>

					<div style="text-align: center; padding-top: 20px; color: white;">Precio (en euros)</div>
					<div style="text-align: center; padding-top: 20px; color: white;">
						<input type="text" id="precio" name="precio" pattern="[0-9]{1,}" placeholder="Ej: 25" value="<?php echo $formularioT['precio'];?>" required>
					</div>
					
					<div style="text-align: center; padding-top: 20px; color: white;">Duración (en meses)</div>
					<div style="text-align: center; padding-top: 20px; color: white; padding-bottom: 30px;">
						<input type="text" id="duracion" name="duracion" pattern="[0-9]{1,}" placeholder="Ej: 1" value="<?php echo $formularioT['duracion'];?>" required>
					</div>
					
					
					<button type="submit" id="Enviar" value="Enviar">Agregar</button>
					<br><br>
					
				</form>
			</div>





















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

				<a class="logoCentral" href="DatagymLogged.php"><img class="logoCentral" src="images/logodatagym.png" alt="logoCentral"/></a>

				<table id="tTabla">

					<tr>

						<th>Tarifa</th>

						<th>Precio</th>

						<th>Duración</th>

					</tr>

					<?php

					foreach($tarifas as $tarifa) {
						if ($tarifa[0] != "FamiliarAsociado") {

							?>
							<form action="borrar_tecnico.php">
								<tr>

									<td><?php echo $tarifa[0];?></td>

									<td><?php echo $tarifa[1] . "€";?></td>

									<input id="nombre" name="nombre" type="hidden" value="<?php echo $tarifa[0]; ?>"/>
									<?php if ($tarifa[2] > 1) { ?>
										<td><?php echo $tarifa[2] ." meses";?></td>
									<?php } else { ?>
										<td><?php echo $tarifa[2] ." mes";?></td>	
									<?php } ?>
								</tr>
							</form>
							<?php

						}
					}

					?>
					

				</table>
			<?php } } ?>

			


			<br><br><br><br><br><br><br><br><br>	

			<p align="center">"VEN A SEVENGYM, Y PONTE FUERTOTE"</p>



		</body>
		</html>