<?php
session_start();

require_once("gestionDB.php");
require_once("gestionUsuarios.php");

	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
if (isset($_SESSION["formularioTe"])) {
		// Recogemos los datos del formulario
	$nuevoTecnico['nombre'] = $_REQUEST["nombre"];
	$nuevoTecnico['telefono'] = $_REQUEST["telefono"];
	$nuevoTecnico['correo'] = $_REQUEST["correo"];

		// Guardar la variable local con los datos del formulario en la sesión.
	$_SESSION["formularioTe"] = $nuevoTecnico;
}
	else // En caso contrario, vamos al formulario
	Header("Location: DatagymTecnicos.php");

	// Validamos el formulario en servidor 
	$conexion = crearConexionBD(); 
	$errores = validarDatosTecnico($conexion, $nuevoTecnico);
	cerrarConexionBD($conexion);
	
	// Si se han detectado errores
	if (count($errores)>0) {
		// Guardo en la sesión los mensajes de error y volvemos al formulario
		$_SESSION["errores"] = $errores;
		Header('Location: DatagymTecnicos.php');
	} else
		// Si todo va bien, vamos a la página de éxito (inserción del usuario en la base de datos)
	Header('Location: accion_alta_tecnico.php');

	///////////////////////////////////////////////////////////
	// Validación en servidor del formulario de alta de tecnico
	///////////////////////////////////////////////////////////
	function validarDatosTecnico($conexion, $nuevoTecnico){
		$errores=array();

		// Validación del nombre
		if($nuevoTecnico["nombre"]==""){ 
			$errores[] = "<p>El nombre no puede estar vacío</p>";
		}

		// Validación del email
		if($nuevoTecnico["correo"]==""){ 
			$errores[] = "<p>El email no puede estar vacío</p>";
		}else if(!filter_var($nuevoTecnico["correo"], FILTER_VALIDATE_EMAIL)){
			$errores[] = $error . "<p>El email es incorrecto: " . $nuevoTecnico["correo"]. "</p>";
		}

		// Validación del telefono
		if($nuevoTecnico["telefono"]==""){ 
			$errores[] = "<p>El telefono no puede estar vacío</p>";
		} else if (strlen($nuevoTecnico["telefono"]) != 9) {
			$errores[] = "<p>El telefono debe tener 9 dígitos</p>";
		}

		return $errores;
	}

	?>