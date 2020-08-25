<?php
session_start();

require_once("gestionDB.php");
require_once("gestionTarifas.php");

	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
if (isset($_SESSION["formularioT"])) {
	$nuevaTarifa = $_SESSION["formularioT"];
	$_SESSION["formularioT"] = null;
	$_SESSION["errores"] = null;
}
else 
	Header("Location: DatagymTarifas.php");	

$conexion = crearConexionBD(); 

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Datagym: Tarifa registrada con éxito</title>
</head>

<body>
	<main>
		<?php if (alta_tarifa($conexion, $nuevaTarifa)) { 
			?>
			<h1>Tarifa: <?php echo $nuevaTarifa["nombre_tarifa"]; ?> bien registrado</h1>
			<div >	
				Pulsa para <a href="DatagymTarifas.php">volver</a>
			</div>
		<?php } else { ?>
			<h1>La tarifa ya existe en la base de datos.</h1>
			<div >	
				Pulsa para <a href="DatagymTarifas.php">volver</a>
			</div>
		<?php } ?>

	</main>
</body>
</html>
<?php
cerrarConexionBD($conexion);
?>

