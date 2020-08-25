<?php
session_start();

require_once("gestionDB.php");
require_once("gestionTarifas.php");

	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
if (isset($_SESSION["formularioT"])) {
		// Recogemos los datos del formulario
	$nuevaTarifa['nombre_tarifa'] = $_REQUEST["nombre_tarifa"];
	$nuevaTarifa['precio'] = $_REQUEST["precio"];
	$nuevaTarifa['duracion'] = $_REQUEST["duracion"];

		// Guardar la variable local con los datos del formulario en la sesión.
	$_SESSION["formularioT"] = $nuevaTarifa;
}
	else // En caso contrario, vamos al formulario
	Header("Location: DatagymTarifas.php");
	
		//FALTA USAR EL VALIDAR DATOS
	// Validamos el formulario en servidor 
	$conexion = crearConexionBD(); 
	$errores = validarDatosTarifa($conexion, $nuevaTarifa);
	cerrarConexionBD($conexion);
	
	// Si se han detectado errores
	if (count($errores)>0) {
		// Guardo en la sesión los mensajes de error y volvemos al formulario
		$_SESSION["errores"] = $errores;
		Header('Location: DatagymTarifas.php');
	} else
		// Si todo va bien, vamos a la página de éxito (inserción del usuario en la base de datos)
	Header('Location: accion_alta_tarifa.php');
	///////////////////////////////////////////////////////////
	// Validación en servidor del formulario de alta de tarifa
	///////////////////////////////////////////////////////////
	function validarDatosTarifa($conexion, $nuevaTarifa){
		$errores=array();

		// Validación del nombre
		if($nuevaTarifa["nombre_tarifa"]==""){ 
			$errores[] = "<p>El nombre no puede estar vacío</p>";
		}

		// Validación del email
		if($nuevaTarifa["precio"]==""){ 
			$errores[] = "<p>El precio no puede estar vacío</p>";
		}

		// Validación del telefono
		if($nuevaTarifa["duracion"]==""){ 
			$errores[] = "<p>La duracion no puede estar vacío</p>";
		} else if ($nuevaTarifa["duracion"] < 1) {
			$errores[] = "<p>La duracion debe ser de al menos 1 mes</p>";
		}

		return $errores;
	}
	?>