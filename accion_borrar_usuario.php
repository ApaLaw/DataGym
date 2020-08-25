<?php	
session_start();	

if (isset($_SESSION["usuario"])) {
	$usuario = $_SESSION["usuario"];
	unset($_SESSION["usuario"]);
	
	require_once("gestionDB.php");
	require_once("gestionarUsuarios.php");
	
	$conexion = crearConexionBD();		
	$excepcion = quitar_usuario($conexion,$usuario["dni"]);
	cerrarConexionBD($conexion);
	
	if ($excepcion<>"") {
		$_SESSION["excepcion"] = $excepcion;
		$_SESSION["destino"] = "DatagymUsuarios.php";
		Header("Location: excepcion.php");
	}
	else Header("Location: DatagymUsuarios.php");
}
	else Header("Location: DatagymUsuarios.php"); // Se ha tratado de acceder directamente a este PHP
	?>
