<?php	
session_start();	

if (isset($_SESSION["usuario"])) {
	$usuario = $_SESSION["usuario"];
	unset($_SESSION["usuario"]);
	
	require_once("gestionDB.php");
	require_once("gestionarUsuarios.php");
	
	$conexion = crearConexionBD();		
	$excepcion = modificar_usuario($conexion,$usuario["dni"],$usuario["nombre_problema_medico"],$usuario["fechapago"],$usuario["fechafin"],$usuario["nombre_tarifa"]);
	cerrarConexionBD($conexion);
	
	if ($excepcion<>"") {
		$_SESSION["excepcion"] = $excepcion;
		$_SESSION["destino"] = "DatagymUsuarios.php";
		Header("Location: excepcion.php");
	}
	else
		Header("Location: DatagymUsuarios.php");
} 
	else Header("Location: DatagymUsuarios.php"); // Se ha tratado de acceder directamente a este PHP
	?>
