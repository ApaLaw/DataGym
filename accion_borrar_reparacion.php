<?php	
session_start();	

if (isset($_SESSION["reparacion"])) {
	$reparacion = $_SESSION["reparacion"];
	unset($_SESSION["reparacion"]);
	
	require_once("gestionDB.php");
	require_once("gestionarReparacion.php");
	
	$conexion = crearConexionBD();		
	$excepcion = quitar_reparacion($conexion,$reparacion["idreparacion"]);
	cerrarConexionBD($conexion);
	
	if ($excepcion<>"") {
		$_SESSION["excepcion"] = $excepcion;
		$_SESSION["destino"] = "DatagymReparaciones.php";
		Header("Location: excepcion.php");
	}
	else Header("Location: DatagymReparaciones.php");
}
	else Header("Location: DatagymReparaciones.php"); // Se ha tratado de acceder directamente a este PHP
	?>
