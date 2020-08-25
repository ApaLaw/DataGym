<?php
session_start();

require_once("gestionDB.php");
require_once("gestionTecnicos.php");

	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
if (isset($_SESSION["formularioTe"])) {
	$nuevoTecnico = $_SESSION["formularioTe"];
	$_SESSION["formularioTe"] = null;
	$_SESSION["errores"] = null;
}
else 
	Header("Location: DatagymTecnicos.php");	

$conexion = crearConexionBD(); 

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Datagym: Técnico registrado con éxito</title>
</head>

<body>
	<main>
		<?php if (alta_tecnico($conexion, $nuevoTecnico)) { 
			?>
			<h1>Técnico: <?php echo $nuevoTecnico["nombre"]; ?> bien registrado</h1>
			<div >	
				Pulsa para <a href="DatagymTecnicos.php">volver</a>
			</div>
		<?php } else { ?>
			<h1>El técnico ya existe en la base de datos.</h1>
			<div >	
				Pulsa para <a href="DatagymTecnicos.php">volver</a>
			</div>
		<?php } ?>

	</main>
</body>
</html>
<?php
cerrarConexionBD($conexion);
?>

