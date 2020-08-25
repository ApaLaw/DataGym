<?php 
session_start();

require_once ("gestionDB.php");
require_once ("paginacion_consulta.php");

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
$query = "SELECT * FROM TARIFAS";

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
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Datagym</title>
	<link rel="shortcut icon" href="../logodatagym.ico" type="image/ico"/>
	<link rel="stylesheet" type="text/css" href="css/Datagym.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/desplegable.css">
	<script src="js/desplegable.js"></script>
	<link rel="stylesheet" type="text/css" href="css/MaqProd.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="js/productos.js"></script>
</head>
<body>
	<?php
	if($_SESSION['login']=="admin@admin.sevengym") {
		?>

		<ul class="topnav" id="myTopnav">
			<li><a href="DatagymLogged.php">Home</a></li>
			<li><a href="DatagymTarifas.php">Tarifas</a></li>
			<li><a href="DatagymMaquinas.php">Maquinas</a></li>
			<li><a class="active" href="DatagymProductos.php">Productos</a></li>
			<li><a href="DatagymUsuarios.php">Usuarios</a></li>
			<li><a href="DatagymTecnicos.php">Técnicos</a></li>
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
				<li><a href="DatagymTarifas.php">Tarifas</a></li>
				<li><a href="DatagymMaquinas.php">Maquinas</a></li>
				<li><a class="active" href="DatagymProductos.php">Productos</a></li>
				<li><a href="DatagymContact.php">Contact</a></li>
				<li><a href="DatagymAbout.php">About</a></li>
				<li style="float: right;"><a href="DatagymLogout.php">Logout</a></li>
				<li style="float: right;"><a href="DatagymPerfil.php">Perfil</a></li>
				<li class="icon">
					<a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
				</ul>

			<?php } } ?>

			<a class="logoCentral" href="DatagymLogged.php"><img class="logoCentral" src="images/logodatagym.png" alt="logoCentral"/></a>

			<table>
				<tr>
					<th>
						<div id="imagen">
							<img style="width: 200px; height: 200px;" src="images/powerade.png" alt="Powerade 500mL">
							<div id="powera" class="imagen>div">Powerade 500mL</div>
						</div>
					</th>

					<th>
						<div id="imagen">
							<img style="width: 200px; height: 200px;" src="images/camiseta.png" alt="Camiseta Oficial Datagym">
							<div id="CamOfi" class="imagen>div">Camiseta Oficial Datagym</div>
						</div>
					</th>

					<th>
						<div id="imagen">
							<img style="width: 200px; height: 200px;" src="images/prot.png" alt="Proteinas ISO-100 2Kg">
							<div id="Prote" class="imagen>div">Proteinas ISO-100 2Kg</div>
						</div>
					</th>
				</tr>
				<tr>
					<th>
						<div id="imagen">
							<img style="width: 200px; height: 200px;" src="images/fox.png" alt="Guantes deportivos de seguridad">
							<div id="GuantDep" class="imagen>div">Guantes deportivos de seguridad</div>
						</div>
					</th>

					<th>
						<div id="imagen">
							<img style="width: 200px; height: 200px;" src="images/barrita.png" alt="Barrita energética de chocolate OVERTIMS">
							<div id="BarEnerg" class="imagen>div">Barrita energética de chocolate OVERTIMS</div>
						</div>
					</th>

					<th>
						<div id="imagen">
							<img style="width: 200px; height: 200px;" src="images/aquar.png" alt="Aquarius de Naranja 330mL">
							<div id="Aquari" class="imagen>div">Aquarius de Naranja 330mL</div>
						</div>
					</th>
				</tr>
			</table>


			<br><br><br><br><br><br><br><br><br>	

			<p align="center">"VEN A SEVENGYM, Y PONTE FUERTOTE"</p>



		</body>
		</html>