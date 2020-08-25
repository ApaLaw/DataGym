<?php
  /*
     * #===========================================================#
     * #	Este fichero contiene las funciones de gestión
     * #	de usuarios de la capa de acceso a datos
     * #==========================================================#
     */

  function alta_usuario($conexion,$usuario) {
  	$fechaNacimiento = date('d/m/Y', strtotime($usuario["fechaNacimiento"]));

  	try {
  		$consulta = "CALL crear_usuario(:nombre, :apellido, :dni, :telefono, :correo, :fechaNacimiento, :direccion, :codigo_postal, :contraseña)";
  		$stmt=$conexion->prepare($consulta);
  		$stmt->bindParam(':nombre',$usuario['nombre']);
  		$stmt->bindParam(':apellido',$usuario["apellido"]);
  		$stmt->bindParam(':dni',$usuario["dni"]);
  		$stmt->bindParam(':telefono',$usuario["telefono"]);
  		$stmt->bindParam(':correo',$usuario["correo"]);
  		$stmt->bindParam(':fechaNacimiento',$fechaNacimiento);
  		$stmt->bindParam(':direccion',$usuario["direccion"]);
  		$stmt->bindParam(':codigo_postal',$usuario["codigo_postal"]);
  		$stmt->bindParam(':contraseña',$usuario["contraseña"]);
  		
  		$stmt->execute();


  		$consulta1 = "SELECT idusuario from usuarios where dni = ?";
  		$qs = $conexion->prepare($consulta1);
  		

		//$qs->execute();
		//$idusuario=$qs->fetchAll(); ESTO DEVUELVE UN ARRAY (el execute no devuelve nada)
  		$qs->execute(array($usuario["dni"]));
  		$arrayusuario=$qs->fetchAll();
  		$idusuario=$arrayusuario[0][0];
  		
  		alta_problema_medico($conexion,$idusuario);
  		alta_pago($conexion,$idusuario,$usuario);
  		return true;
  	} catch(PDOException $e) {
  		echo $e->getMessage();
  		return false;
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();
  	}
  }

  function alta_problema_medico($conexion,$idusuario) {
  	try {
  		$mensaje = 'ninguno';
  		$consulta = "CALL crear_problemas_medicos(:nombre_problema_medico, :idusuario)";
  		$stmt=$conexion->prepare($consulta);
  		$stmt->bindParam(':nombre_problema_medico',$mensaje);
  		$stmt->bindParam(':idusuario',$idusuario);

  		$stmt->execute();		
  		return true;
  	} catch(PDOException $e) {
  		echo $e->getMessage();
  		return false;
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();
  	}
  }

  function alta_pago($conexion,$idusuario,$usuario) {
  	$mensaje = 'Basico';
  	$fechaInicio = date('d/m/Y', strtotime($usuario["fechaNacimiento"]));
  	$fechaFin = date('d/m/Y', time());
  	try {
  		$consulta = "CALL crear_pagos(:fechainicio, :fechafin, :idusuario, :nombre_tarifa)";
  		
  		$stmt=$conexion->prepare($consulta);
  		$stmt->bindParam(':fechainicio',$fechaInicio);
  		$stmt->bindParam(':fechafin',$fechaFin);
  		$stmt->bindParam(':idusuario',$idusuario);
  		$stmt->bindParam(':nombre_tarifa',$mensaje);


  		$stmt->execute();
  		return true;
  	} catch(PDOException $e) {
  		echo $e->getMessage();
  		return false;
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();
  	}
  }

  function consultarUsuario($conexion,$email,$pass) {
  	$consulta = "SELECT COUNT(*) AS TOTAL FROM USUARIOS WHERE CORREO=:correo AND CONTRASEÑA=:contraseña";
  	$stmt = $conexion->prepare($consulta);
  	$stmt->bindParam(':correo',$email);
  	$stmt->bindParam(':contraseña',$pass);
  	$stmt->execute();
  	return $stmt->fetchColumn();
  }

  function generar_mensaje($conexion,$nombre,$correo,$mensaje) {	
  	try {
  		$consulta = "CALL crear_mensaje(:nombre, :correo, :mensaje)";
  		$stmt=$conexion->prepare($consulta);
  		$stmt->bindParam(':nombre',$nombre);
  		$stmt->bindParam(':correo',$correo);
  		$stmt->bindParam(':mensaje',$mensaje);
  		
  		$stmt->execute();
  		
  		return true;
  	} catch(PDOException $e) {
  		echo $e->getMessage();
  		return false;
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();
  	}
  }


  function validarContact($conexion, $correo, $mensaje){
  	$errores=array();

	// Validación del email
  	if($correo==""){ 
  		$errores[] = "<p>El email no puede estar vacío</p>";
  	}else if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
  		$errores[] = "<p>El email es incorrecto: " . $correo. "</p>";
  	}

  	if($mensaje==""){ 
  		$errores[] = "<p>El mensaje no puede estar vacío</p>";
  	}
  	
  	return $errores;
  }
  ?>