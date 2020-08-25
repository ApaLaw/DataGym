<?php
  /*
     * #===========================================================#
     * #	Este fichero contiene las funciones de gestión     			 
     * #	de reposiciones de la capa de acceso a datos 		
     * #==========================================================#
     */
  function consultarTodasReposiciones($conexion) {
  	$consulta = 'SELECT idreposicion, idLineaReposicion, nombre,precio_lin,cantidad, nombre_proveedor, telefono, correo, max(fechaReposicion)'
  	. ' as fechaReposicion from reposiciones natural join proveedores natural join lineaReposicion '
  	. ' natural join suplementos group by idreposicion, idLineaReposicion, nombre,precio_lin,cantidad, nombre_proveedor, telefono, correo, fechaReposicion';
  	return $conexion->query($consulta);
  }

  function quitar_reposicion($conexion,$idLineaReposicion) {
  	try {
  		$stmt=$conexion->prepare('CALL eliminar_lineaReposicion(:idLineaReposicion)');
  		$stmt->bindParam(':idLineaReposicion',$idLineaReposicion);
  		$stmt->execute();
  		return "";
  	} catch(PDOException $e) {
  		return $e->getMessage();
  	}
  }

  ?>