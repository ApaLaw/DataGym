<?php
  /*
     * #===========================================================#
     * #	Este fichero contiene las funciones de gestión
     * #	de usuarios de la capa de acceso a datos
     * #==========================================================#
     */

  function alta_tecnico($conexion,$usuario) {
  	try {
  		$consulta = "CALL crear_tecnicos(:nombre, :telefono, :correo)";
  		$stmt=$conexion->prepare($consulta);
  		$stmt->bindParam(':nombre',$usuario['nombre']);
  		$stmt->bindParam(':telefono',$usuario["telefono"]);
  		$stmt->bindParam(':correo',$usuario["correo"]);
  		
  		$stmt->execute();

  		return true;
  	} catch(PDOException $e) {
  		echo $e->getMessage();
  		return false;
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();
  	}
  }

  function quitar_tecnico($conexion,$idtecnico) {
  	try {
  		$consulta = "CALL eliminar_tecnicos(:idtecnico)";
  		$stmt=$conexion->prepare($consulta);
  		$stmt->bindParam(':idtecnico',$idtecnico);
  		
  		$stmt->execute();

  		return "";
  	} catch(PDOException $e) {
  		return $e->getMessage();
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();
  	}
  }

  function validarCorreo($conexion, $correo){
  	$errores=array();

	// Validación del email
  	if($correo==""){ 
  		$errores[] = "<p>El email no puede estar vacío</p>";
  	}else if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
  		$errores[] = "<p>El email es incorrecto: " . $correo. "</p>";
  	}
  	
  	return $errores;
  }
  ?>