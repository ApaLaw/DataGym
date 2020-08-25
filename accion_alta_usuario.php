<?php
session_start();

require_once("gestionDB.php");
require_once("gestionUsuarios.php");

	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
if (isset($_SESSION["formulario"])) {
	$nuevoUsuario = $_SESSION["formulario"];
	$_SESSION["formulario"] = null;
	$_SESSION["errores"] = null;
}
else 
	Header("Location: DatagymRegister.php");	

$conexion = crearConexionBD(); 

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Datagym: Alta de Usuario realizada con éxito</title>
</head>

<body>
	<main>
		<?php if (alta_usuario($conexion, $nuevoUsuario)) { 
			$_SESSION['login'] = $nuevoUsuario['dni'];
			?>
			<h1>Hola <?php echo $nuevoUsuario["nombre"]; ?>, gracias por registrarte</h1>
			<div >	
				Pulsa <a href="DatagymLogin.php">aquí</a> para iniciar sesión.
			</div>
		<?php } else { ?>
			<h1>El usuario ya existe en la base de datos.</h1>
			<div >	
				Pulsa <a href="DatagymLogin.php">aquí</a> para iniciar sesión.
			</div>
		<?php } ?>

	</main>
</body>
</html>
<?php
cerrarConexionBD($conexion);
?>

