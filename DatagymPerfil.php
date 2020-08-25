<?php 
session_start();

require_once ("gestionDB.php");
require_once ("paginacion_consulta.php");

if (!isset($_SESSION['login']))
	Header("Location: DatagymLogin.php");
else {
	if (isset($_SESSION["usuario"])) {
		$usuario = $_SESSION["usuario"];
		unset($_SESSION["usuario"]);
	}


	$conexion = crearConexionBD();

	$query = "SELECT idUsuario, nombre, apellido, dni, telefono,correo, fecha_nacimiento, direccion, codigo_postal, nombre_problema_medico, nombre_Tarifa, FechaFin from usuarios natural join problemas_medicos natural join pagos WHERE correo = ? and FechaFin = (Select max(FechaFin) from pagos natural join usuarios where correo = ?)";

	$qs = $conexion->prepare($query);
	$qs->execute(array($_SESSION['login'],$_SESSION['login']));
	$arrayusuario=$qs->fetchAll();
	$perfil=$arrayusuario[0];

	cerrarConexionBD($conexion);
}


if (isset($_SESSION["errores"])) {
	$errores = $_SESSION["errores"];
	unset($_SESSION["errores"]);
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Datagym</title>
	<link rel="shortcut icon" href="../logodatagym.ico" type="image/ico"/>
	<link rel="stylesheet" type="text/css" href="css/Datagym.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/DatagymRegister.css">
	<script src="js/desplegable.js"></script>
	<link rel="stylesheet" type="text/css" href="css/desplegable.css">

	
</head>
<body>
	
	<ul class="topnav" id="myTopnav">
		<li><a href="DatagymLogged.php">Home</a></li>
		<li><a href="DatagymTarifas.php">Tarifas</a></li>
		<li><a href="DatagymMaquinas.php">Maquinas</a></li>
		<li><a href="DatagymProductos.php">Productos</a></li>
		<li><a href="DatagymContact.php">Contact</a></li>
		<li><a href="DatagymAbout.php">About</a></li>
		<li style="float: right;"><a href="DatagymLogout.php">Logout</a></li>
		<li style="float: right;"><a class="active" href="DatagymPerfil.php">Perfil</a></li>
		<li class="icon">
			<a href="javascript:void(0);" style="font-size:15px;" onclick="desplegar()">☰</a>
		</ul>


		<a class="logoCentral" href="Datagym.php"><img class="logoCentral" src="images/logodatagym.png" alt="logoCentral"/></a>
			<?php 
				// Mostrar los erroes de validación (Si los hay)
				if (isset($errores) && count($errores)>0) { 
					echo "<div id=\"div_errores\" class=\"error\">";
					echo "<h4> Errores en el perfil:</h4>";
					foreach($errores as $error) echo $error; 
					echo "</div>";
				}
			?>



		<main>

			<article class="usuario">

				<form method="post" action="controlador_perfil.php">

					<input id="nombre" name="nombre"

					type="hidden" value="<?php echo $perfil[1]; ?>"/>

					<input id="apellido" name="apellido"

					type="hidden" value="<?php echo $perfil[2]; ?>"/>

					<input id="dni" name="dni"

					type="hidden" value="<?php echo $perfil[3]; ?>"/>

					<input id="correo" name="correo"

					type="hidden" value="<?php echo $perfil[5]; ?>"/>

					<input id="telefono" name="telefono"

					type="hidden" value="<?php echo $perfil[4]; ?>"/>

					<input id="fechanacimiento" name="fechanacimiento"

					type="hidden" value="<?php echo $perfil[6]; ?>"/>

					<input id="direccion" name="direccion"

					type="hidden" value="<?php echo $perfil[7]; ?>"/>

					<input id="cp" name="cp"

					type="hidden" value="<?php echo $perfil[8]; ?>"/>

					<input id="problemasmedicos" name="problemasmedicos"

					type="hidden" value="<?php echo $perfil[10]; ?>"/>
					
					<input id="nombre_tarifa" name="nombre_tarifa"

					type="hidden" value="<?php echo $perfil[10]; ?>"/>
					
					<input id="fechaValida" name="fechaValida"

					type="hidden" value="<?php echo $perfil[11]; ?>"/>

					<?php

					if (isset($usuario) and ($usuario["dni"] == $perfil[3])) { ?>

						<!-- Editando título -->

						<div id="registroP">
							<br>
							<p><?php echo "Nombre: " . $perfil[1]; ?></p>
							<p><?php echo "Apellido: " . $perfil[2]; ?></p>
							<p><?php echo "DNI: " . $perfil[3]; ?></p>
							<p><?php echo "Correo: " . $perfil[5]; ?></p>
							<p><?php echo "Teléfono: "; ?><input id="telefono" name="telefono" type="text" value="<?php echo $perfil[4]; ?>"/></p>
							<p><?php echo "Fecha de Nacimiento: " . $perfil[6]; ?></p>
							<p><?php echo "Dirección: "; ?><input id="direccion" name="direccion" type="text" value="<?php echo $perfil[7]; ?>"/></p>
							<p><?php echo "C.P.: "; ?><input id="cp" name="cp" type="text" value="<?php echo $perfil[8]; ?>"/></p>
							<p><?php echo "Problemas Médicos: "; ?><input id="problemasmedicos" name="problemasmedicos" type="text" value="<?php echo $perfil[9]; ?>"/></p>
							<p><?php echo "Tarifa actual: " . $perfil[10]; ?></p>
							<p><?php echo "Fecha final del pago actual: " . $perfil[11]; ?></p>

							
							<div id="botones_fila">

								<?php if (isset($usuario) and ($usuario["dni"] == $perfil[3])) { ?>

									<button id="grabar" name="grabar" type="submit" class="editar_fila">

										<img src="images/bag_menuito.bmp" class="editar_fila" alt="Guardar modificación">

									</button>

								<?php } else { ?>

									<button id="editar" name="editar" type="submit" class="editar_fila">

										<img src="images/pencil_menuito.bmp" class="editar_fila" alt="Editar usuario">

									</button>

								<?php } ?>

							</div>


							<br><br>
						</div>
					<?php }	else { ?>

						<div id="registroP">
							<br>
							<p><?php echo "Nombre: " . $perfil[1]; ?></p>
							<p><?php echo "Apellido: " . $perfil[2]; ?></p>
							<p><?php echo "DNI: " . $perfil[3]; ?></p>
							<p><?php echo "Correo: " . $perfil[5]; ?></p>
							<p><?php echo "Teléfono: " . $perfil[4]; ?></p>
							<p><?php echo "Fecha de Nacimiento: " . $perfil[6]; ?></p>
							<p><?php echo "Dirección: " . $perfil[7]; ?></p>
							<p><?php echo "C.P.: " . $perfil[8]; ?></p>
							<p><?php echo "Problemas Médicos: " . $perfil[9]; ?></p>
							<p><?php echo "Tarifa actual: " . $perfil[10]; ?></p>
							<p><?php echo "Fecha final del pago actual: " . $perfil[11]; ?></p>

							
							<div id="botones_fila">

								<?php if (isset($usuario) and ($usuario["dni"] == $perfil[3])) { ?>

									<button id="grabar" name="grabar" type="submit" class="editar_fila">

										<img src="images/bag_menuito.bmp" class="editar_fila" alt="Guardar modificación">

									</button>

								<?php } else { ?>

									<button id="editar" name="editar" type="submit" class="editar_fila">

										<img src="images/pencil_menuito.bmp" class="editar_fila" alt="Editar usuario">

									</button>

								<?php } ?>

							</div>


							<br><br>
						</div>
					<?php } ?>

				</form>

			</article>
		</main>




		<br><br><br><br><br><br><br><br><br><br><br>	

		<p align="center">"VEN A SEVENGYM, Y PONTE FUERTOTE"</p>

		
	</body>
	</html>