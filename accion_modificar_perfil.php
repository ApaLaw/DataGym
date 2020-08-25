<?php	
session_start();	

if (isset($_SESSION["usuario"])) {
	$usuario = $_SESSION["usuario"];
	unset($_SESSION["usuario"]);
	
	require_once("gestionDB.php");
	require_once("gestionarUsuarios.php");
	
	$conexion = crearConexionBD();		
	$excepcion = modificar_perfil($conexion,$usuario["dni"],$usuario["telefono"],$usuario["direccion"],$usuario["cp"],$usuario["problemasmedicos"]);
	cerrarConexionBD($conexion);
	
	if ($excepcion<>"") {
		$_SESSION["excepcion"] = $excepcion;
		$_SESSION["destino"] = "DatagymPerfil.php";
		Header("Location: excepcion.php");
	}
	else
		Header("Location: DatagymPerfil.php");
} 
	else Header("Location: DatagymPerfil.php"); // Se ha tratado de acceder directamente a este PHP
	?>
