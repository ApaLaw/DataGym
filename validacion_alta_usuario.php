<?php
session_start();

require_once("gestionDB.php");
require_once("gestionUsuarios.php");

	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
if (isset($_SESSION["formulario"])) {
		// Recogemos los datos del formulario
	$nuevoUsuario['nombre'] = $_POST["nombre"];
	$nuevoUsuario['apellido'] = $_POST["apellido"];
	$nuevoUsuario['dni'] = $_POST["dni"];
	$nuevoUsuario['telefono'] = $_POST["telefono"];
	$nuevoUsuario['fechaNacimiento'] = $_POST["fechaNacimiento"];
	$nuevoUsuario['correo'] = $_POST["correo"];
	$nuevoUsuario['direccion'] = $_POST["direccion"];
	$nuevoUsuario['codigo_postal'] = $_POST["codigo_postal"];
	$nuevoUsuario['contraseña'] = $_POST["contraseña"];
	$nuevoUsuario['contraseña_repe'] = $_POST["contraseña_repe"];
	$nuevoUsuario['cod_access'] = $_POST["cod_access"];

		// Guardar la variable local con los datos del formulario en la sesión.
	$_SESSION["formulario"] = $nuevoUsuario;
}
	else // En caso contrario, vamos al formulario
	Header("Location: DatagymRegister.php");

	// Validamos el formulario en servidor 
	$conexion = crearConexionBD(); 
	$errores = validarDatosUsuario($conexion, $nuevoUsuario);
	cerrarConexionBD($conexion);
	
	// Si se han detectado errores
	if (count($errores)>0) {
		// Guardo en la sesión los mensajes de error y volvemos al formulario
		$_SESSION["errores"] = $errores;
		Header('Location: DatagymRegister.php');
	} else
		// Si todo va bien, vamos a la página de éxito (inserción del usuario en la base de datos)
	Header('Location: accion_alta_usuario.php');

	///////////////////////////////////////////////////////////
	// Validación en servidor del formulario de alta de usuario
	///////////////////////////////////////////////////////////
	function validarDatosUsuario($conexion, $nuevoUsuario){
		$errores=array();
		// Validación del DNI
		$letra = substr($nuevoUsuario["dni"], -1);
		$numeros = substr($nuevoUsuario["dni"], 0,-1);
		if($nuevoUsuario["dni"]=="") 
			$errores[] = "<p>El DNI no puede estar vacío</p>";
		else if(!preg_match("/^[0-9]{8}[A-Z]$/", $nuevoUsuario["dni"])){
			$errores[] = "<p>El DNI debe contener 8 números y una letra mayúscula: " . $nuevoUsuario["dni"]. "</p>";
		}else if(substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros%23, 1) != $letra){
			$errores[] = "<p>Dni erroneo, la letra del DNI no se corresponde</p>";
		}

		// Validación del Nombre			
		if($nuevoUsuario["nombre"]=="") 
			$errores[] = "<p>El nombre no puede estar vacío</p>";
		
		// Validación del email
		if($nuevoUsuario["correo"]==""){ 
			$errores[] = "<p>El email no puede estar vacío</p>";
		}else if(!filter_var($nuevoUsuario["correo"], FILTER_VALIDATE_EMAIL)){
			$errores[] = $error . "<p>El email es incorrecto: " . $nuevoUsuario["correo"]. "</p>";
		}
		
		// Validación de la contraseña
		if(!isset($nuevoUsuario["contraseña"]) || strlen($nuevoUsuario["contraseña"])<8){
			$errores [] = "<p>Contraseña no válida: debe tener al menos 8 caracteres</p>";
		}else if(!preg_match("/[a-z]+/", $nuevoUsuario["contraseña"]) || 
			!preg_match("/[A-Z]+/", $nuevoUsuario["contraseña"]) || !preg_match("/[0-9]+/", $nuevoUsuario["contraseña"])){
			$errores[] = "<p>Contraseña no válida: debe contener letras mayúsculas y minúsculas y dígitos</p>";
		}else if($nuevoUsuario["contraseña"] != $nuevoUsuario["contraseña_repe"]){
			$errores[] = "<p>La confirmación de contraseña no coincide con la contraseña</p>";
		}
		

		//Validación del código
		if ($nuevoUsuario['cod_access']=="") {
			$errores[] = "<p>El código de aceso no puede estar vacío</p>";
		} else if (!preg_match("/^DG7G/", $nuevoUsuario['cod_access'])) {
			$errores[] = "<p>El código de aceso no es válido</p>";
		}

		return $errores;
	}

	?>