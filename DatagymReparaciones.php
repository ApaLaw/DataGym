<?php 
session_start();

require_once ("gestionDB.php");
require_once ("paginacion_consulta.php");

if (!isset($_SESSION['login']))
	Header("Location: DatagymLogin.php");
else {
	if (isset($_SESSION["reparacion"])) {
		$reparacion = $_SESSION["reparacion"];
		unset($_SESSION["reparacion"]);
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

	// La consulta que ha de paginarse
	$query = 'SELECT idreparacion, nombre_maquina, idmaquina,nombre, fechareparacion'
	. ' from reparaciones natural join tecnicos natural join maquinas '
	. ' group by idreparacion, nombre_maquina,idmaquina,nombre, fechareparacion';

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
	cerrarConexionBD($conexion);
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
			<li><a href="DatagymTecnicos.php">Técnicos</a></li>
			<li><a href="DatagymReposiciones.php">Reposiciones</a></li>
			<li><a class="active" href="DatagymReparaciones.php">Reparaciones</a></li>
			<li><a href="DatagymComentarios.php">Comentarios</a></li>
			<li style="float: right;"><a href="DatagymLogout.php">Logout</a></li>
			<li class="icon">
				<a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
			</ul>


			<a class="logoCentral" href="DatagymLogged.php"><img class="logoCentral" src="images/logodatagym.png" alt="logoCentral"/></a>




			<main id="mainBo">

				<nav>

					<div id="enlaces">

						<?php
						echo "Páginas: ";
						for( $pagina = 1; $pagina <= $total_paginas; $pagina++ )

							if ( $pagina == $pagina_seleccionada) { 	?>

								<span class="current"><?php echo $pagina; ?></span>

							<?php }	else { ?>

								<a href="DatagymReparaciones.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>

							<?php } ?>

						</div>



						<form method="get" action="DatagymReparaciones.php">

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

							?>


							<tr>
								<td class="filasRec">
									<article class="datagym_art">

										<form method="post" action="controlador_reparacion.php">

											<div class="fila_datagym_art">

												<div class="datos_datagym_art">

													<input id="idreparacion" name="idreparacion"

													type="hidden" value="<?php echo $fila["IDREPARACION"]; ?>"/>

													<input id="nombre_maquina" name="nombre_maquina"

													type="hidden" value="<?php echo $fila["NOMBRE_MAQUINA"]; ?>"/>

													<input id="idmaquina" name="idmaquina"

													type="hidden" value="<?php echo $fila["IDMAQUINA"]; ?>"/>

													<input id="nombre" name="nombre"

													type="hidden" value="<?php echo $fila["NOMBRE"]; ?>"/>

													<input id="fechaReparacion" name="fechaReparacion"

													type="hidden" value="<?php echo $fila["FECHAREPARACION"]; ?>"/>


												</div>


												<input id="idreparacion" name="idreparacion" type="hidden" value="<?php echo $fila["IDREPARACION"]; ?>"/>
												
												<div class="titulo"><b><?php echo $fila["FECHAREPARACION"]; ?></b></div>

												<div class="autor"><em><?php echo "Reparación: " . $fila["IDREPARACION"] . " de " . $fila["NOMBRE_MAQUINA"] . " con id: " . $fila["IDMAQUINA"] .  " realizada por " . $fila["NOMBRE"]; ?></em></div>



												<div id="botones_fila">


													<button id="borrar" name="borrar" onclick="return confirmar()" type="submit" class="editar_fila">

														<img src="images/remove_menuito.bmp" class="editar_fila" alt="Borrar reparacion">

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