<?php
  /*
     * #===========================================================#
     * #	Este fichero contiene las funciones de gestión     			 
     * #	de reparaciones de la capa de acceso a datos 		
     * #==========================================================#
     */
  function consultarTodasReparaciones($conexion) {
  	$consulta ='SELECT idreparacion, nombre_maquina, idmaquina,nombre, max(fechareparacion)'
  	. ' as fechareparacion from reparaciones natural join tecnicos natural join maquinas '
  	. ' group by idreparacion, nombre_maquina,idmaquina,nombre, fechareparacion';
  	return $conexion->query($consulta);
  }

  function quitar_reparacion($conexion,$idreparacion) {
  	try {
  		$stmt=$conexion->prepare('CALL eliminar_reparaciones(:idreparacion)');
  		$stmt->bindParam(':idreparacion',$idreparacion);
  		$stmt->execute();
  		return "";
  	} catch(PDOException $e) {
  		return $e->getMessage();
  	}
  }

  ?>