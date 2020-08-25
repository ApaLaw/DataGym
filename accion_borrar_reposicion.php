<?php	
session_start();	

if (isset($_SESSION["reposicion"])) {
	$reposicion = $_SESSION["reposicion"];
	unset($_SESSION["reposicion"]);
	
	require_once("gestionDB.php");
	require_once("gestionarReposicion.php");
	
	$conexion = crearConexionBD();		
	$excepcion = quitar_reposicion($conexion,$reposicion["idLineaReposicion"]);
	cerrarConexionBD($conexion);
	
	if ($excepcion<>"") {
		$_SESSION["excepcion"] = $excepcion;
		$_SESSION["destino"] = "DatagymReposiciones.php";
		Header("Location: excepcion.php");
	}
	else Header("Location: DatagymReposiciones.php");
}
	else Header("Location: DatagymReposiciones.php"); // Se ha tratado de acceder directamente a este PHP
	?>
