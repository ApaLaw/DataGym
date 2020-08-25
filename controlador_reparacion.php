<?php	
session_start();

if (isset($_REQUEST["idreparacion"])){
	$reparacion["idreparacion"] = $_REQUEST["idreparacion"];
	$reparacion["nombre_maquina"] = $_REQUEST["nombre_maquina"];
	$reparacion["idmaquina"] = $_REQUEST["idmaquina"];
	$reparacion["nombre"] = $_REQUEST["nombre"];
	$reparacion["fechaReparacion"] = $_REQUEST["fechaReparacion"];

	
	$_SESSION["reparacion"] = $reparacion;
	

	if (isset($_REQUEST["borrar"]))  Header("Location: accion_borrar_reparacion.php"); 
}
else 
	Header("Location: DatagymReparaciones.php");

?>
