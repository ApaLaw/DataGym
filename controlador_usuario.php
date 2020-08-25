<?php	
session_start();

require_once("gestionDB.php");

if (isset($_REQUEST["dni"])){
	$usuario["idusuario"] = $_REQUEST["idusuario"];
	$usuario["dni"] = $_REQUEST["dni"];
	$usuario["nombre"] = $_REQUEST["nombre"];
	$usuario["nombre_tarifa"] = $_REQUEST["nombre_tarifa"];
	$usuario["nombre_problema_medico"] = $_REQUEST["nombre_problema_medico"];
	$usuario["fechapago"] = $_REQUEST["fechapago"];
	$usuario["fechafin"] = $_REQUEST["fechafin"];
	
	$_SESSION["usuario"] = $usuario;
	
	if (isset($_REQUEST["editar"])) Header("Location: DatagymUsuarios.php"); 
	else if (isset($_REQUEST["grabar"])){ 
		$conexion = crearConexionBD(); 
		$errores = validarDatosUsuario($conexion, $usuario);
		cerrarConexionBD($conexion);
	
		// Si se han detectado errores
		if (count($errores)>0) {
		// Guardo en la sesión los mensajes de error y volvemos al formulario
		$_SESSION["errores"] = $errores;
		Header('Location: DatagymUsuarios.php');
		} else
		// Si todo va bien, vamos a la página de éxito (modificación del usuario en la base de datos)
		Header("Location: accion_modificar_usuario.php");

	}
	else if (isset($_REQUEST["borrar"])) Header("Location: accion_borrar_usuario.php"); 
}
else 
	Header("Location: DatagymUsuarios.php");


function validarDatosUsuario($conexion, $nuevoUsuario){
		$errores=array();

		$consulta1 = "SELECT count(*) from tarifas where nombre_tarifa = ?";
  		$qs = $conexion->prepare($consulta1);
  		
  		$qs->execute(array($nuevoUsuario["nombre_tarifa"]));
  		$arrayusuario=$qs->fetchAll();
  		$ntarifa=$arrayusuario[0][0];

		$newFechaPago = strtotime($nuevoUsuario["fechapago"]);
  		$newFechaFin = strtotime($nuevoUsuario["fechafin"]);
		
		if($nuevoUsuario["nombre_tarifa"]=="") 
			$errores[] = "<p>El nombre de la tarifa no puede estar vacío</p>";

		else if($ntarifa == 0)
			$errores[] = "<p>La tarifa insertada no existe</p>";
		
		if($newFechaPago>$newFechaFin)
			$errores[] = "<p>La fecha de inicio no puede ser mayor a la fecha fin</p>";


		return $errores;
	}

?>


