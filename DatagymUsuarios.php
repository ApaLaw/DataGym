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

	
	// ¿Venimos simplemente de cambiar página o de haber seleccionado un registro ?
	// ¿Hay una sesión activa?
	if (isset($_SESSION["paginacion"]))
		$paginacion = $_SESSION["paginacion"];
	
	$pagina_seleccionada = isset($_GET["PAG_NUM"]) ? (int)$_GET["PAG_NUM"] : (isset($paginacion) ? (int)$paginacion["PAG_NUM"] : 1);
	$pag_tam = isset($_GET["PAG_TAM"]) ? (int)$_GET["PAG_TAM"] : (isset($paginacion) ? (int)$paginacion["PAG_TAM"] : 5);

	if ($pagina_seleccionada < 1) 		$pagina_seleccionada = 1;
	if ($pag_tam < 1) 		$pag_tam = 5;

	// Antes de seguir, borramos las variables de sección para no confundirnos más adelante
	unset($_SESSION["paginacion"]);

	$conexion = crearConexionBD();


	if (!isset($_SESSION['enferFilt'])) {
		// La consulta que ha de paginarse
		$query = 'SELECT idusuario, nombre, dni, nombre_problema_medico, max(FechaInicio)'
		. ' as fechapago from usuarios natural join pagos natural join tarifas'
		. ' natural join problemas_medicos group by idusuario, nombre, dni, nombre_problema_medico';
	} else {
		// La consulta que ha de paginarse
		$query = "SELECT idusuario, nombre, dni, nombre_problema_medico, max(FechaInicio)"
		. " as fechapago from usuarios natural join pagos natural join tarifas"
		. " natural join problemas_medicos "
		. " where nombre_problema_medico like '%". strval($_SESSION['enferFilt']) . "%'"
		. " group by idusuario, nombre, dni, nombre_problema_medico";
	}
	

	// Se comprueba que el tamaño de página, página seleccionada y total de registros son conformes.
	// En caso de que no, se asume el tamaño de página propuesto, pero desde la página 1
	$total_registros = total_consulta($conexion, $query);
	$total_paginas = (int)($total_registros / $pag_tam);

	if ($total_registros % $pag_tam > 0)		$total_paginas++;

	if ($pagina_seleccionada > $total_paginas)		$pagina_seleccionada = $total_paginas;

	// Generamos los valores de sesión para página e intervalo para volver a ella después de una operación
	$paginacion["PAG_NUM"] = $pagina_seleccionada;
	$paginacion["PAG_TAM"] = $pag_tam;
	$_SESSION["paginacion"] = $paginacion;

	$filas = consulta_paginada($conexion, $query, $pagina_seleccionada, $pag_tam);
	
	unset($_SESSION['enferFilt']);
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
	<link rel="stylesheet" type="text/css" href="css/datagymPaginada.css" />
	<link rel="stylesheet" type="text/css" href="css/Datagym.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="stylesheet" type="text/css" href="css/desplegable.css">
	<script src="js/Validaciones.js"></script>
	<script src="js/desplegable.js"></script>
	<script src="js/confirmDelete.js"></script>
	<script src="js/suggestions.js"></script>
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
			<li><a class="active" href="DatagymUsuarios.php">Usuarios</a></li>
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


			<main id="mainBo">
				<p>Filtrar por problema médico: </p>
				<form method="post" action="filtrado.php">
					<input type="text" name="enferFilt" onkeyup="showHint(this.value)"><button style="width: 50px; height: auto;" id="filtro" name="filtro" type="submit">Filtrar</button>
					<a href="DatagymUsuarios.php">Borrar Filtro</a>
				</form>
				<p>Sugerencias: <span id="txtHint"></span></p>
				<nav>

					<div style="padding-top: 75px;" id="enlaces">

						<?php
						echo "Páginas: ";
						for( $pagina = 1; $pagina <= $total_paginas; $pagina++ )

							if ( $pagina == $pagina_seleccionada) { 	?>

								<span class="current"><?php echo $pagina; ?></span>

							<?php }	else { ?>

								<a href="DatagymUsuarios.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>

							<?php } ?>

						</div>



						<form method="get" action="DatagymUsuarios.php">

							<input id="PAG_NUM" name="PAG_NUM" type="hidden" value="<?php echo $pagina_seleccionada?>"/>

							Mostrando

							<input id="PAG_TAM" name="PAG_TAM" type="number"

							min="1" max="<?php echo $total_registros; ?>"

							value="<?php echo $pag_tam?>" autofocus="autofocus" />

							entradas de <?php echo $total_registros?>

							<input type="submit" value="Cambiar">

						</form>

					</nav>
					<br>
					
					<table>

						<tr>
							<th>
							</th>
						</tr>
						<?php

						foreach($filas as $fila) {

							$tar = "SELECT idUsuario, nombre, apellido, dni, telefono,correo, fecha_nacimiento, direccion, codigo_postal, nombre_problema_medico, nombre_Tarifa, FechaFin from usuarios natural join problemas_medicos natural join pagos WHERE dni = ? and FechaFin = (Select max(FechaFin) from pagos natural join usuarios where dni = ?)";

							$qs = $conexion->prepare($tar);
							$qs->execute(array($fila["DNI"],$fila["DNI"]));
							$arrayusuario=$qs->fetchAll();
							$nomTarifa=$arrayusuario[0][10];

							?>


							
							<tr>
								<td class="filasRec">
									<article class="datagym_art">

										<form  method="post" action="controlador_usuario.php">

											<div class="fila_datagym_art">

												<div class="datos_datagym_art">

													<input id="idusuario" name="idusuario"

													type="hidden" value="<?php echo $fila["IDUSUARIO"]; ?>"/>

													<input id="nombre" name="nombre"

													type="hidden" value="<?php echo $fila["NOMBRE"]; ?>"/>

													<input id="dni" name="dni"

													type="hidden" value="<?php echo $fila["DNI"]; ?>"/>

													<input id="nombre_tarifa" name="nombre_tarifa"

													type="hidden" value="<?php echo $fila["NOMBRE_TARIFA"]; ?>"/>

													<input id="nombre_problema_medico" name="nombre_problema_medico"

													type="hidden" value="<?php echo $fila["NOMBRE_PROBLEMA_MEDICO"]; ?>"/>

													<input id="fechapago" name="fechapago"

													type="hidden" value="<?php echo $fila["FECHAPAGO"]; ?>"/>



													<?php

													if (isset($usuario) and ($usuario["dni"] == $fila["DNI"])) { ?>

														<!-- Editando título -->

														<h3>
															<input id="nombre_problema_medico" name="nombre_problema_medico" type="text" value="<?php echo $fila["NOMBRE_PROBLEMA_MEDICO"]; ?>"/>

															<input id="nombre_tarifa" name="nombre_tarifa" type="text" value="<?php echo $nomTarifa; ?>"/>

															<input id="fechapago" name="fechapago" type="date" value="<?php echo $fila["FECHAPAGO"]; ?>"/>

															<input id="fechafin" name="fechafin" type="date"/>
														</h3>

														<h4><?php echo $fila["NOMBRE"] . " " . $fila["DNI"]; ?></h4>

													<?php }	else { ?>

														<!-- mostrando título -->

														<input id="dni" name="dni" type="hidden" value="<?php echo $fila["DNI"]; ?>"/>
														
														<div class="titulo"><b><?php echo $fila["DNI"]; ?></b></div>

														<div class="autor">
															<em>
																<?php echo "Nombre: " . $fila["NOMBRE"] . "<br/>Problemas Médicos: " . $fila["NOMBRE_PROBLEMA_MEDICO"] . "<br/>Tarifa actual / Última tarifa: " . $nomTarifa .  " con fecha de " . $fila["FECHAPAGO"]; ?>
																	
															</em>

															<!-- TABLA CON TODOS LOS PAGOS EN AJAX -->

														</div>

													<?php } ?>

												</div>



												<div id="botones_fila">

													<?php if (isset($usuario) and ($usuario["dni"] == $fila["DNI"])) { ?>

														<button id="grabar" name="grabar" type="submit" class="editar_fila">

															<img src="images/bag_menuito.bmp" class="editar_fila" alt="Guardar modificación">

														</button>

													<?php } else { ?>

														<button id="editar" name="editar" type="submit" class="editar_fila">

															<img src="images/pencil_menuito.bmp" class="editar_fila" alt="Editar usuario">

														</button>

													<?php } ?>

													<button id="borrar" name="borrar" onclick="return confirmar()" type="submit" class="editar_fila">

														<img src="images/remove_menuito.bmp" class="editar_fila" alt="Borrar usuario">

													</button>

												</div>

											</div>

										</form>

									</article>
								</td>
							</tr>


						<?php } ?>
					</table>

				</main>




				<br><br><br><br><br><br><br><br><br><br><br>	

				<p align="center">"VEN A SEVENGYM, Y PONTE FUERTOTE"</p>

			<?php } else { Header("Location: DatagymLogin.php"); }?>

		</body>
		</html>