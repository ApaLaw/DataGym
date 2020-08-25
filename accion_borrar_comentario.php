<?php	
session_start();	

if (isset($_SESSION["comentario"])) {
	$comentario = $_SESSION["comentario"];
	unset($_SESSION["comentario"]);
	
	require_once("gestionDB.php");
	require_once("gestionarComentario.php");
	
	$conexion = crearConexionBD();		
	$excepcion = quitar_comentario($conexion,$comentario["idMensaje"]);
	cerrarConexionBD($conexion);
	
	if ($excepcion<>"") {
		$_SESSION["excepcion"] = $excepcion;
		$_SESSION["destino"] = "DatagymComentarios.php";
		Header("Location: excepcion.php");
	}
	else Header("Location: DatagymComentarios.php");
}
	else Header("Location: DatagymComentarios.php"); // Se ha tratado de acceder directamente a este PHP
	?>
