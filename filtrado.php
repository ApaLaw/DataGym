<?php	
session_start();

if (isset($_REQUEST["enferFilt"])){
	$_SESSION["enferFilt"] = $_REQUEST["enferFilt"];
	Header("Location: DatagymUsuarios.php");
}
else 
	Header("Location: DatagymUsuarios.php");

?>