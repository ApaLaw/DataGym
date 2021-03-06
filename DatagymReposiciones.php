<?php 
session_start();

require_once ("gestionDB.php");
require_once ("paginacion_consulta.php");

if (!isset($_SESSION['login']))
	Header("Location: DatagymLogin.php");
else {
	if (isset($_SESSION["reposicion"])) {
		$reposicion = $_SESSION["reposicion"];
		unset($_SESSION["reposicion"]);
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
	$query = 'SELECT idreposicion, idLineaReposicion, nombre,precio_lin,cantidad, nombre_proveedor, telefono, correo, max(fechaReposicion)'
	. ' as fechaReposicion from reposiciones natural join proveedores natural join lineaReposicion '
	. ' natural join suplementos group by idreposicion, idLineaReposicion, nombre,precio_lin,cantidad, nombre_proveedor, telefono, correo, fechaReposicion';

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
			<li><a class="active" href="DatagymReposiciones.php">Reposiciones</a></li>
			<li><a href="DatagymReparaciones.php">Reparaciones</a></li>
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

								<a href="DatagymReposiciones.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>

							<?php } ?>

						</div>



						<form method="get" action="DatagymReposiciones.php">

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

										<form method="post" action="controlador_reposicion.php">

											<div class="fila_datagym_art">

												<div class="datos_datagym_art">

													<input id="idreposicion" name="idreposicicion"

													type="hidden" value="<?php echo $fila["IDREPOSICION"]; ?>"/>

													<input id="nombre" name="nombre"

													type="hidden" value="<?php echo $fila["NOMBRE"]; ?>"/>

													<input id="precio_lin" name="precio_lin"

													type="hidden" value="<?php echo $fila["PRECIO_LIN"]; ?>"/>

													<input id="cantidad" name="cantidad"

													type="hidden" value="<?php echo $fila["CANTIDAD"]; ?>"/>

													<input id="nombre_proveedor" name="nombre_proveedor"

													type="hidden" value="<?php echo $fila["NOMBRE_PROVEEDOR"]; ?>"/>

													<input id="telefono" name="telefono"

													type="hidden" value="<?php echo $fila["TELEFONO"]; ?>"/>
													<input id="correo" name="correo"

													type="hidden" value="<?php echo $fila["CORREO"]; ?>"/>
													<input id="fecha" name="fecha"

													type="hidden" value="<?php echo $fila["FECHAREPOSICION"]; ?>"/>

													<input id="idLineaReposicion" name="idLineaReposicion"

													type="hidden" value="<?php echo $fila["IDLINEAREPOSICION"]; ?>"/>

													

													

													<input id="idLineaReposicion" name="idLineaReposicion" type="hidden" value="<?php echo $fila["IDLINEAREPOSICION"]; ?>">
													
													<div class="titulo"><b><?php echo $fila["NOMBRE"]; ?></b></div>

													<?php if (floatval($fila["PRECIO_LIN"]<1)) {
														$fila["PRECIO_LIN"] = "0" . $fila["PRECIO_LIN"];
													} ?>
													<div class="autor"><em><?php echo "Reposición: " . $fila["IDLINEAREPOSICION"] . " con precio " . $fila["PRECIO_LIN"] . "€ y cantidad " . $fila["CANTIDAD"] .  " por " . $fila["NOMBRE_PROVEEDOR"].  ".<br/><br/>Teléfono: " . $fila["TELEFONO"].  "<br/>Correo: " . $fila["CORREO"].  "<br/>Fecha: " . $fila["FECHAREPOSICION"]; ?></em></div>




												</div>
												<div id="botones_fila">


													<button id="borrar" name="borrar" onclick="return confirmar()" type="submit" class="editar_fila">

														<img src="images/remove_menuito.bmp" class="editar_fila" alt="Borrar reposicion">

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