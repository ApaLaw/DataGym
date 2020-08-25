<?php	
session_start();

if (isset($_REQUEST["idMensaje"])){
	$comentario["idMensaje"] = $_REQUEST["idMensaje"];
	$comentario["nombre"] = $_REQUEST["nombre"];
	$comentario["correo"] = $_REQUEST["correo"];
	$comentario["mensaje"] = $_REQUEST["mensaje"];

	
	$_SESSION["comentario"] = $comentario;
	

	if (isset($_REQUEST["borrar"]))  Header("Location: accion_borrar_comentario.php"); 
}
else 
	Header("Location: DatagymComentarios.php");

?>
