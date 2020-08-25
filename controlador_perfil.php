<?php	
session_start();

require_once("gestionDB.php");

if (isset($_REQUEST["dni"])){
	$usuario["nombre"] = $_REQUEST["nombre"];
	$usuario["apellido"] = $_REQUEST["apellido"];
	$usuario["dni"] = $_REQUEST["dni"];
	$usuario["telefono"] = $_REQUEST["telefono"];
	$usuario["fechanacimiento"] = $_REQUEST["fechanacimiento"];
	$usuario["direccion"] = $_REQUEST["direccion"];
	$usuario["cp"] = $_REQUEST["cp"];
	$usuario["problemasmedicos"] = $_REQUEST["problemasmedicos"];
	$usuario["nombre_tarifa"] = $_REQUEST["nombre_tarifa"];
	$usuario["fechaValida"] = $_REQUEST["fechaValida"];
	
	$_SESSION["usuario"] = $usuario;
	
	if (isset($_REQUEST["editar"])) Header("Location: DatagymPerfil.php"); 
	else if (isset($_REQUEST["grabar"])){ 
		$conexion = crearConexionBD(); 
		$errores = validarDatosPerfil($conexion, $usuario);
		cerrarConexionBD($conexion);
	
		// Si se han detectado errores
		if (count($errores)>0) {
		// Guardo en la sesión los mensajes de error y volvemos al formulario
		$_SESSION["errores"] = $errores;
		Header('Location: DatagymPerfil.php');
		} else
		// Si todo va bien, vamos a la página de éxito (modificación del usuario en la base de datos)
		Header("Location: accion_modificar_perfil.php");

	}

}
else 
	Header("Location: DatagymPerfil.php");



function validarDatosPerfil($conexion, $perfil){
		$errores=array();
		// Validación del Telefono			
		if($perfil["telefono"]!="" && strlen($perfil["telefono"])!=9) 
			$errores[] = "<p>El telefono debe tener 9 digitos</p>";

		if($perfil["cp"]!="" && strlen($perfil["cp"])!=5) 
			$errores[] = "<p>El codigo postal debe tener 5 digitos</p>";


		return $errores;
	}
?>