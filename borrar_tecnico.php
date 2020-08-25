<?php	
session_start();


require_once("gestionDB.php");
require_once("gestionTecnicos.php");

if (isset($_REQUEST["correo"])){
	$tecnico["correo"] = $_REQUEST["correo"];
	
	$conexion = crearConexionBD();

	$consulta1 = "SELECT idtecnico from tecnicos where correo = ?";
	$qs = $conexion->prepare($consulta1);
	
	$qs->execute(array($tecnico["correo"]));
	$arrayusuario=$qs->fetchAll();
	$idtecnico=$arrayusuario[0][0];
	
	$excepcion = quitar_tecnico($conexion,$idtecnico);
	cerrarConexionBD($conexion);
	
	if ($excepcion<>"") {
		$_SESSION["excepcion"] = $excepcion;
		$_SESSION["destino"] = "DatagymTecnicos.php";
		Header("Location: excepcion.php");
	}
	else Header("Location: DatagymTecnicos.php");
}
else 
	Header("Location: DatagymTecnicos.php");

?>


