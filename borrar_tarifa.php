<?php	
session_start();


require_once("gestionDB.php");
require_once("gestionTarifas.php");

if (isset($_REQUEST["nombre_tarifa"])){
	$tarifa["nombre_tarifa"] = $_REQUEST["nombre_tarifa"];
	
	$conexion = crearConexionBD();
	
	$excepcion = quitar_tarifa($conexion,$tarifa["nombre_tarifa"]);
	cerrarConexionBD($conexion);
	
	if ($excepcion<>"") {
		$_SESSION["excepcion"] = $excepcion;
		$_SESSION["destino"] = "DatagymTarifas.php";
		Header("Location: excepcion.php");
	}
	else Header("Location: DatagymTarifas.php");
}
else 
	Header("Location: DatagymTarifas.php");

?>


