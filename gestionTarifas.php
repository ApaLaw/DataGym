<?php
  /*
     * #===========================================================#
     * #	Este fichero contiene las funciones de gestión
     * #	de usuarios de la capa de acceso a datos
     * #==========================================================#
     */

  function alta_tarifa($conexion,$tarifa) {
  	try {
  		$consulta = "CALL crear_tarifas(:nombre, :precio, :duracion)";
  		$stmt=$conexion->prepare($consulta);
  		$stmt->bindParam(':nombre',$tarifa['nombre_tarifa']);
  		$stmt->bindParam(':precio',$tarifa["precio"]);
  		$stmt->bindParam(':duracion',$tarifa["duracion"]);
  		
  		$stmt->execute();

  		return true;
  	} catch(PDOException $e) {
  		echo $e->getMessage();
  		return false;
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();
  	}
  }

  function quitar_tarifa($conexion,$nombre_tarifa) {
  	try {
  		$consulta = "CALL eliminar_tarifas(:nombre_tarifa)";
  		$stmt=$conexion->prepare($consulta);
  		$stmt->bindParam(':nombre_tarifa',$nombre_tarifa);
  		
  		$stmt->execute();

  		return "";
  	} catch(PDOException $e) {
  		return $e->getMessage();
		// Si queremos visualizar la excepción durante la depuración: $e->getMessage();
  	}
  }
  ?>