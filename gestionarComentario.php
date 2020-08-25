<?php
  /*
     * #===========================================================#
     * #	Este fichero contiene las funciones de gestión     			 
     * #	de comentarios de la capa de acceso a datos 		
     * #==========================================================#
     */
  function consultarTodosComentarios($conexion) {
  	$consulta ='SELECT idMensaje , nombre , correo , mensaje'
  	. ' from mensajes group by idMensaje , nombre , correo , mensaje';
  	return $conexion->query($consulta);
  }

  function quitar_comentario($conexion,$idMensaje) {
  	try {
  		$stmt=$conexion->prepare('CALL eliminar_mensaje(:idMensaje)');
  		$stmt->bindParam(':idMensaje',$idMensaje);
  		$stmt->execute();
  		return "";
  	} catch(PDOException $e) {
  		return $e->getMessage();
  	}
  }

  ?>