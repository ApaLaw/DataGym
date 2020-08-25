<?php
  /*
     * #===========================================================#
     * #	Este fichero contiene las funciones de gestión     			 
     * #	de usuarios de la capa de acceso a datos 		
     * #==========================================================#
     */
  function consultarTodosUsuarios($conexion) {
  	$consulta = 'SELECT idusuario, nombre, dni, nombre_tarifa, nombre_problema_medico, max(FechaInicio)'
  	. ' as fechapago from usuarios natural join pagos natural join tarifas'
  	. ' natural join problemas_medicos group by idusuario, nombre, dni, nombre_tarifa, nombre_problema_medico';
  	return $conexion->query($consulta);
  }

  function quitar_usuario($conexion,$dni) {
  	try {
  		$stmt=$conexion->prepare('CALL eliminar_usuario(:dni)');
  		$stmt->bindParam(':dni',$dni);
  		$stmt->execute();
  		return "";
  	} catch(PDOException $e) {
  		return $e->getMessage();
  	}
  }

  function modificar_usuario($conexion,$dni,$nombre_problema_medico,$fechainicio,$fechafin,$nombre_tarifa) {
  	try {

  		$consulta1 = "SELECT idusuario from usuarios where dni = ?";
  		$qs = $conexion->prepare($consulta1);
  		
  		$qs->execute(array($dni));
  		$arrayusuario=$qs->fetchAll();
  		$idusuario=$arrayusuario[0][0];

  		if ($fechafin != "" && $fechainicio != "") {
  			$newFechaPago = date('d/m/Y', strtotime($fechainicio));
  			$newFechaFin = date('d/m/Y', strtotime($fechafin));

  			$stmt1=$conexion->prepare("CALL CREAR_PAGOS(:fechainicio, :fechafin, :idusuario, :nombre_tarifa)");
  			$stmt1->bindParam(':idusuario',$idusuario);
  			$stmt1->bindParam(':fechainicio',$newFechaPago);
  			$stmt1->bindParam(':fechafin',$newFechaFin);
  			$stmt1->bindParam(':nombre_tarifa',$nombre_tarifa);
  			$stmt1->execute();
  		}

  		$stmt2=$conexion->prepare('CALL MODIFICAR_PROBLEMAS_MEDICOS(:idusuario , :problemasmedicos)');
  		$stmt2->bindParam(':idusuario',$idusuario);
  		$stmt2->bindParam(':problemasmedicos',$nombre_problema_medico);
  		$stmt2->execute();

  		return "";

  	} catch(PDOException $e) {
  		return $e->getMessage();
  	}
  }

//funcion para modificar el perfil de un usuario
  function modificar_perfil($conexion,$dni,$telefono,$direccion,$cp,$problemasmedicos) {
  	try {

  		$consulta1 = "SELECT idusuario from usuarios where dni = ?";
  		$qs = $conexion->prepare($consulta1);
  		
  		$qs->execute(array($dni));
  		$arrayusuario=$qs->fetchAll();
  		$idusuario=$arrayusuario[0][0];

  		$stmt=$conexion->prepare('CALL MODIFICAR_PERFIL(:dni , :telefono,:direccion,:cp)');
  		$stmt->bindParam(':dni',$dni);
  		$stmt->bindParam(':telefono',$telefono);
  		$stmt->bindParam(':direccion',$direccion);
  		$stmt->bindParam(':cp',$cp);
  		$stmt->execute();

  		$stmt2=$conexion->prepare('CALL MODIFICAR_PROBLEMAS_MEDICOS(:idusuario , :problemasmedicos)');
  		$stmt2->bindParam(':idusuario',$idusuario);
  		$stmt2->bindParam(':problemasmedicos',$problemasmedicos);
  		$stmt2->execute();

  		return "";

  	} catch(PDOException $e) {
  		return $e->getMessage();
  	}
  }

  ?>