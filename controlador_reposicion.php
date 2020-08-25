<?php	
session_start();

if (isset($_REQUEST["idLineaReposicion"])){
	$reposicion["idreposicion"] = $_REQUEST["idreposicion"];
	$reposicion["nombre"] = $_REQUEST["nombre"];
	$reposicion["precio_lin"] = $_REQUEST["precio_lin"];
	$reposicion["cantidad"] = $_REQUEST["cantidad"];
	$reposicion["nombre_proveedor"] = $_REQUEST["nombre_proveedor"];
	$reposicion["telefono"] = $_REQUEST["telefono"];
	$reposicion["correo"] = $_REQUEST["correo"];
	$reposicion["fechaReposicion"] = $_REQUEST["fechaReposicion"];
	$reposicion["idLineaReposicion"] = $_REQUEST["idLineaReposicion"];

	
	$_SESSION["reposicion"] = $reposicion;
	

	if (isset($_REQUEST["borrar"]))  Header("Location: accion_borrar_reposicion.php"); 
}
else 
	Header("Location: DatagymReposiciones.php");

?>
