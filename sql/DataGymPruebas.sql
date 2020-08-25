SET serveroutput on;

--Función Assert_Equals
CREATE OR REPLACE FUNCTION Assert_Equals (
    salida BOOLEAN,
    salida_esperada BOOLEAN)
    RETURN VARCHAR2 AS
    BEGIN
        IF (salida = salida_esperada) THEN
            RETURN 'EXITO';
        ELSE
            RETURN 'FALLO';
        END IF;
END;
/



--Cabeceras
CREATE OR REPLACE PACKAGE Pruebas_Usuarios IS

	PROCEDURE Inicializar;
	PROCEDURE Insertar (nombrePrueba VARCHAR2,n_nombre IN Usuarios.Nombre%TYPE, n_Apellido IN Usuarios.Apellido%TYPE, n_dni IN
	Usuarios.dni%TYPE, n_telefono IN Usuarios.telefono%TYPE, salidaEsperada BOOLEAN);
	PROCEDURE Actualizar (nombrePrueba VARCHAR2, n_nombre IN Usuarios.Nombre%TYPE, n_Apellido IN 
    Usuarios.Apellido%TYPE, n_dni IN Usuarios.dni%TYPE, n_telefono IN Usuarios.telefono%TYPE, salidaEsperada BOOLEAN);
	PROCEDURE Eliminar (nombrePrueba VARCHAR2,n_dni IN Usuarios.dni%TYPE, salidaEsperada BOOLEAN);
END;
/


CREATE OR REPLACE PACKAGE Pruebas_Problemas_Medicos IS

	PROCEDURE Inicializar;
	PROCEDURE Insertar (nombrePrueba VARCHAR2,n_nombre_problema_medico IN Problemas_Medicos.nombre_problema_medico%TYPE, n_idUsuario IN Problemas_Medicos.idUsuario%TYPE,
    salidaEsperada BOOLEAN);
    PROCEDURE Eliminar (nombrePrueba VARCHAR2,n_nombre_problema_medico IN Problemas_Medicos.nombre_problema_medico%TYPE, n_idUsuario IN Problemas_Medicos.idUsuario%TYPE,
    salidaEsperada BOOLEAN);
END;
/


CREATE OR REPLACE PACKAGE Pruebas_tarifas IS

	PROCEDURE Inicializar;
	PROCEDURE Insertar (nombrePrueba VARCHAR2, n_nombre_tarifa IN tarifas.Nombre_tarifa%TYPE, n_precio IN tarifas.precio%TYPE, n_duracion_meses IN
	tarifas.duracion_meses%TYPE, salidaEsperada BOOLEAN);
	PROCEDURE Actualizar (nombrePrueba VARCHAR2, n_nombre_tarifa IN tarifas.Nombre_tarifa%TYPE, n_precio IN tarifas.precio%TYPE,
    salidaEsperada BOOLEAN);
	PROCEDURE Eliminar (nombrePrueba VARCHAR2,n_nombre_tarifa IN tarifas.Nombre_tarifa%TYPE, salidaEsperada BOOLEAN);
END;
/

CREATE OR REPLACE PACKAGE Pruebas_Pagos IS

	PROCEDURE Inicializar;
	PROCEDURE Insertar (nombrePrueba VARCHAR2,n_FechaInicio in pagos.FechaInicio%TYPE,n_FechaFin in pagos.FechaFin%TYPE,
		n_idUsuario in pagos.idUsuario%TYPE,n_nombre_tarifa in pagos.nombre_tarifa%TYPE, salidaEsperada BOOLEAN);
	PROCEDURE Eliminar (nombrePrueba VARCHAR2,n_idpago in pagos.idPago%TYPE, salidaEsperada BOOLEAN);
END;
/



CREATE OR REPLACE PACKAGE Pruebas_Maquinas IS

	PROCEDURE Inicializar;
	PROCEDURE Insertar (nombrePrueba VARCHAR2,n_nombre_maquina in maquinas.nombre_maquina%TYPE,
    n_categoria in maquinas.categoria%TYPE,n_fechaRevision in maquinas.fechaRevision%TYPE, n_estropeada IN maquinas.estropeada%TYPE,
    n_fechaActual IN maquinas.fechaActual%TYPE, salidaEsperada BOOLEAN);
	PROCEDURE Actualizar (nombrePrueba VARCHAR2, n_idMaquina IN maquinas.idMaquina%TYPE,n_fechaRevision in maquinas.fechaRevision%TYPE,
     n_estropeada IN maquinas.estropeada%TYPE, n_fechaActual IN maquinas.fechaActual%TYPE, salidaEsperada BOOLEAN);
	PROCEDURE Eliminar (nombrePrueba VARCHAR2,n_idMaquina IN maquinas.idMaquina%TYPE, salidaEsperada BOOLEAN);
END;
/

CREATE OR REPLACE PACKAGE Pruebas_Tecnicos IS

	PROCEDURE Inicializar;
	PROCEDURE Insertar (nombrePrueba VARCHAR2, n_nombre IN tecnicos.nombre%TYPE, n_telefono IN tecnicos.telefono%TYPE, n_correo IN tecnicos.correo%TYPE, salidaEsperada BOOLEAN);
	PROCEDURE Actualizar (nombrePrueba VARCHAR2, n_nombre IN tecnicos.nombre%TYPE, n_telefono IN tecnicos.telefono%TYPE, n_correo IN tecnicos.correo%TYPE,n_idtecnico IN tecnicos.idtecnico%TYPE, salidaEsperada BOOLEAN);
	PROCEDURE Eliminar (nombrePrueba VARCHAR2,n_idtecnico IN tecnicos.idtecnico%TYPE, salidaEsperada BOOLEAN);
END;
/

CREATE OR REPLACE PACKAGE Pruebas_Reparaciones IS
	PROCEDURE Inicializar;
	PROCEDURE Insertar (nombrePrueba VARCHAR2, n_idTecnico IN Reparaciones.idTecnico%TYPE,
    n_idMaquina IN Reparaciones.idMaquina%TYPE,salidaEsperada BOOLEAN);
    PROCEDURE Actualizar (nombrePrueba VARCHAR2,n_idTecnico IN Reparaciones.idTecnico%TYPE,
    n_idMaquina IN Reparaciones.idMaquina%TYPE,n_idReparacion IN Reparaciones.idReparacion%TYPE,salidaEsperada BOOLEAN);
    PROCEDURE Eliminar (nombrePrueba VARCHAR2,n_idReparacion IN Reparaciones.idReparacion%TYPE,
    salidaEsperada BOOLEAN);
END;
/

CREATE OR REPLACE PACKAGE Pruebas_Proveedores IS
	PROCEDURE Inicializar;
	PROCEDURE Insertar (nombrePrueba VARCHAR2, n_nombre_proveedor IN Proveedores.nombre_proveedor%TYPE,
    n_telefono IN Proveedores.telefono%TYPE,n_correo IN Proveedores.correo%TYPE,salidaEsperada BOOLEAN);
    PROCEDURE Actualizar (nombrePrueba VARCHAR2, n_nombre_proveedor IN Proveedores.nombre_proveedor%TYPE,
    n_telefono IN Proveedores.telefono%TYPE,n_correo IN Proveedores.correo%TYPE, n_idProveedor IN Proveedores.idProveedor%TYPE,salidaEsperada BOOLEAN);
    PROCEDURE Eliminar (nombrePrueba VARCHAR2, n_idProveedor IN Proveedores.idProveedor%TYPE,
    salidaEsperada BOOLEAN);
END;
/

CREATE OR REPLACE PACKAGE Pruebas_Reposiciones IS

	PROCEDURE Inicializar;
	PROCEDURE Insertar (nombrePrueba VARCHAR2, n_fechaReposicion IN Reposiciones.fechaReposicion%TYPE, n_idProveedor IN Reposiciones.idproveedor%TYPE, salidaEsperada BOOLEAN);
	PROCEDURE Actualizar (nombrePrueba VARCHAR2,n_fechaReposicion IN Reposiciones.fechaReposicion%TYPE, n_idProveedor IN Reposiciones.idproveedor%TYPE,n_idReposicion IN Reposiciones.idReposicion%TYPE, salidaEsperada BOOLEAN);
	PROCEDURE Eliminar (nombrePrueba VARCHAR2,n_idReposicion IN Reposiciones.idReposicion%TYPE, salidaEsperada BOOLEAN);
END;
/

CREATE OR REPLACE PACKAGE Pruebas_Suplementos IS

	PROCEDURE Inicializar;
	PROCEDURE Insertar (nombrePrueba VARCHAR2, n_nombre IN suplementos.nombre%TYPE, n_precio IN suplementos.precio%TYPE, n_stock IN suplementos.stock%TYPE, salidaEsperada BOOLEAN);
	PROCEDURE Actualizar (nombrePrueba VARCHAR2, n_precio IN suplementos.precio%TYPE, n_stock IN suplementos.stock%TYPE,n_idSuplemento IN suplementos.idsuplemento%TYPE, salidaEsperada BOOLEAN);
	PROCEDURE Eliminar (nombrePrueba VARCHAR2,n_idSuplemento IN suplementos.idsuplemento%TYPE, salidaEsperada BOOLEAN);
END;
/

CREATE OR REPLACE PACKAGE Pruebas_LineasReposicion IS

	PROCEDURE Inicializar;
	PROCEDURE Insertar (nombrePrueba VARCHAR2, n_cantidad IN lineaReposicion.cantidad%TYPE, n_precio_lin IN lineaReposicion.precio_lin%TYPE, n_idreposicion IN lineaReposicion.idreposicion%TYPE, n_idsuplemento IN lineaReposicion.idsuplemento%TYPE, salidaEsperada BOOLEAN);
	PROCEDURE Actualizar (nombrePrueba VARCHAR2, n_cantidad IN lineaReposicion.cantidad%TYPE, n_precio_lin IN lineaReposicion.precio_lin%TYPE, n_idreposicion IN lineaReposicion.idreposicion%TYPE, n_idsuplemento IN lineaReposicion.idsuplemento%TYPE,n_idlineaReposicion IN lineaReposicion.idLineaReposicion%TYPE, salidaEsperada BOOLEAN);
	PROCEDURE Eliminar (nombrePrueba VARCHAR2,n_idlineaReposicion IN lineaReposicion.idlineaReposicion%TYPE, salidaEsperada BOOLEAN);
END;
/





--Cuerpos
Create or replace PACKAGE BODY Pruebas_Usuarios IS 
	salida BOOLEAN := TRUE;
	usuario Usuarios%ROWTYPE;

	PROCEDURE Inicializar IS
		BEGIN
			DELETE FROM Usuarios;
		END Inicializar;

	PROCEDURE Insertar (nombrePrueba VARCHAR2,n_nombre IN Usuarios.Nombre%TYPE, n_Apellido IN Usuarios.Apellido%TYPE, n_dni IN
	Usuarios.dni%TYPE, n_telefono IN Usuarios.telefono%TYPE, salidaEsperada BOOLEAN) IS
        n_idUsuario usuarios.idUsuario%TYPE;
		BEGIN 
			insert into usuarios (nombre, apellido, dni, telefono) values (n_nombre, n_apellido, n_dni, n_telefono);
			n_idUsuario := sec_usuarios.CURRVAL;
			select * into usuario from usuarios where idusuario=n_idUsuario;
			if(usuario.nombre != n_nombre OR usuario.apellido != n_apellido OR usuario.dni != n_dni OR usuario.telefono != n_telefono)
				THEN
				salida:=FALSE;
			END IF;
			COMMIT WORK;
			DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));

			EXCEPTION
				WHEN OTHERS THEN 
					DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(FALSE, salidaEsperada));
					ROLLBACK;
	END Insertar;

	PROCEDURE Actualizar (nombrePrueba VARCHAR2, n_nombre IN Usuarios.Nombre%TYPE, n_Apellido IN 
    Usuarios.Apellido%TYPE, n_dni IN Usuarios.dni%TYPE, n_telefono IN Usuarios.telefono%TYPE, salidaEsperada BOOLEAN) IS
		BEGIN 
			UPDATE usuarios SET nombre = n_nombre,apellido = n_apellido,dni= n_dni,telefono=  n_telefono where n_dni=dni;
			select * into usuario from usuarios where n_dni=dni;
			if(usuario.nombre != n_nombre OR usuario.apellido != n_apellido OR usuario.dni != n_dni OR usuario.telefono != n_telefono)
				THEN
				salida:=FALSE;
			END IF;
			COMMIT WORK;
			DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));

			EXCEPTION
				WHEN OTHERS THEN 
					DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(FALSE, salidaEsperada));
					ROLLBACK;
	END Actualizar;

	PROCEDURE Eliminar (nombrePrueba VARCHAR2,n_dni IN Usuarios.dni%TYPE, salidaEsperada BOOLEAN) IS
		num_usuarios NUMBER :=0;
        num_usuarios_in_tablas NUMBER :=0;
		BEGIN 
			select Count(*) into num_usuarios_in_tablas from usuarios where n_dni=dni;
			DELETE FROM usuarios WHERE n_dni=dni;
			select Count(*) into num_usuarios from usuarios where n_dni=dni;
			if(num_usuarios!= 0 and num_usuarios_in_tablas = 1)
				THEN
				salida:=FALSE;
            elsif (num_usuarios_in_tablas = 0)
                THEN
				salida:=FALSE;
			END IF;
			COMMIT WORK;
			DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));

			EXCEPTION
				WHEN OTHERS THEN 
					DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(FALSE, salidaEsperada));
					ROLLBACK;
	END Eliminar;
END Pruebas_Usuarios;
/


Create or replace PACKAGE BODY Pruebas_Problemas_Medicos IS 
	salida BOOLEAN := TRUE;
	problema_medico Problemas_Medicos%ROWTYPE;

	PROCEDURE Inicializar IS
		BEGIN
			DELETE FROM Problemas_Medicos;
		END Inicializar;

	PROCEDURE Insertar (nombrePrueba VARCHAR2,n_nombre_problema_medico IN problemas_medicos.nombre_problema_medico%TYPE, n_idUsuario IN Problemas_Medicos.idUsuario%TYPE,
    salidaEsperada BOOLEAN) IS
		BEGIN 
			insert into problemas_medicos (nombre_problema_medico, idUsuario) values (n_nombre_problema_medico,n_idUsuario);
			select * into problema_medico from problemas_medicos where nombre_problema_medico=n_nombre_problema_medico and idUsuario=n_idUsuario;
			if(problema_medico.nombre_problema_medico != n_nombre_problema_medico OR problema_medico.idUsuario != n_idUsuario)
				THEN
				salida:=FALSE;
			END IF;
			COMMIT WORK;
			DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));

			EXCEPTION
				WHEN OTHERS THEN 
					DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(FALSE, salidaEsperada));
					ROLLBACK;
	END Insertar;

	PROCEDURE Eliminar (nombrePrueba VARCHAR2,n_nombre_problema_medico IN Problemas_Medicos.nombre_problema_medico%TYPE, n_idUsuario IN Problemas_Medicos.idUsuario%TYPE,
    salidaEsperada BOOLEAN) IS
		num_problemas_medicos NUMBER :=0;
		num_prob_in_problemas NUMBER :=0;
		BEGIN 
            select Count(*) into num_prob_in_problemas from problemas_medicos where nombre_problema_medico=n_nombre_problema_medico and idUsuario=n_idUsuario;
			DELETE FROM problemas_medicos WHERE nombre_problema_medico=n_nombre_problema_medico and idUsuario=n_idUsuario;
			select Count(*) into num_problemas_medicos from problemas_medicos where nombre_problema_medico=n_nombre_problema_medico and idUsuario=n_idUsuario;
			if(num_problemas_medicos!= 0 and num_prob_in_problemas = 1)
				THEN
				salida:=FALSE;
            elsif (num_prob_in_problemas = 0)
                THEN
                salida:=FALSE;
			END IF;
			COMMIT WORK;
			DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));

			EXCEPTION
				WHEN OTHERS THEN 
					DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(FALSE, salidaEsperada));
					ROLLBACK;
	END Eliminar;
END Pruebas_Problemas_Medicos;
/


Create or replace PACKAGE BODY Pruebas_tarifas IS 
	salida BOOLEAN := TRUE;
	tarifa tarifas%ROWTYPE;

	PROCEDURE Inicializar IS
		BEGIN
			DELETE FROM Tarifas;
		END Inicializar;

	PROCEDURE Insertar (nombrePrueba VARCHAR2, n_nombre_tarifa IN tarifas.Nombre_tarifa%TYPE, n_precio IN tarifas.precio%TYPE, n_duracion_meses IN
	tarifas.duracion_meses%TYPE, salidaEsperada BOOLEAN) IS
		BEGIN 
			insert into tarifas (nombre_tarifa, precio, duracion_meses) values (n_nombre_tarifa, n_precio, n_duracion_meses);
			select * into tarifa from tarifas where nombre_tarifa=n_nombre_tarifa;
			if(tarifa.nombre_tarifa != n_nombre_tarifa OR tarifa.precio != n_precio OR tarifa.duracion_meses != n_duracion_meses)
				THEN
				salida:=FALSE;
			END IF;
			COMMIT WORK;
			DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));

			EXCEPTION
				WHEN OTHERS THEN 
					DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(FALSE, salidaEsperada));
					ROLLBACK;
	END Insertar;

	PROCEDURE Actualizar (nombrePrueba VARCHAR2, n_nombre_tarifa IN tarifas.Nombre_tarifa%TYPE, n_precio IN tarifas.precio%TYPE,
    salidaEsperada BOOLEAN) IS
		BEGIN 
			UPDATE tarifas SET nombre_tarifa = n_nombre_tarifa, precio= n_precio where n_nombre_tarifa=nombre_tarifa;
			select * into tarifa from tarifas where n_nombre_tarifa=nombre_tarifa;
			if(tarifa.nombre_tarifa != n_nombre_tarifa OR tarifa.precio != n_precio)
				THEN
				salida:=FALSE;
			END IF;
			COMMIT WORK;
			DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));

			EXCEPTION
				WHEN OTHERS THEN 
					DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(FALSE, salidaEsperada));
					ROLLBACK;
	END Actualizar;

	PROCEDURE Eliminar (nombrePrueba VARCHAR2, n_nombre_tarifa IN tarifas.nombre_tarifa%TYPE, salidaEsperada BOOLEAN) IS
		num_tarifas NUMBER :=0;
        num_tarifas_in_tarifas NUMBER :=0;
		BEGIN 
			select Count(*) into num_tarifas_in_tarifas from tarifas where n_nombre_tarifa=nombre_tarifa;
			DELETE FROM tarifas WHERE n_nombre_tarifa=nombre_tarifa;
			select Count(*) into num_tarifas from tarifas where n_nombre_tarifa=nombre_tarifa;
			if(num_tarifas != 0 and num_tarifas_in_tarifas = 1)
				THEN
				salida:=FALSE;
             elsif (num_tarifas_in_tarifas = 0)
                THEN
                salida:=FALSE;
			END IF;
			COMMIT WORK;
			DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));

			EXCEPTION
				WHEN OTHERS THEN 
					DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(FALSE, salidaEsperada));
					ROLLBACK;
	END Eliminar;
END Pruebas_tarifas;
/


Create or replace PACKAGE BODY Pruebas_Pagos IS 
	salida BOOLEAN := TRUE;
	pago pagos%ROWTYPE;

	PROCEDURE Inicializar IS
		BEGIN
			DELETE FROM pagos;
		END Inicializar;

	PROCEDURE Insertar (nombrePrueba VARCHAR2,n_FechaInicio in pagos.FechaInicio%TYPE,n_FechaFin in pagos.FechaFin%TYPE,
		n_idUsuario in pagos.idUsuario%TYPE,n_nombre_tarifa in pagos.nombre_tarifa%TYPE, salidaEsperada BOOLEAN) IS
    	n_idPago pagos.idPago%TYPE;
        BEGIN
    		insert into pagos (FechaInicio, FechaFin, idUsuario,nombre_tarifa) values (n_FechaInicio, n_FechaFin, n_idUsuario,n_nombre_tarifa);
			n_idpago := sec_pagos.CURRVAL;
			select * into pago from pagos where idpago=n_idpago;
			if(pago.FechaInicio != n_FechaInicio OR pago.fechaFin != n_FechaFin OR pago.idUsuario != n_idUsuario OR pago.nombre_tarifa != n_nombre_tarifa)
				THEN
				salida:=FALSE;
			END IF;
			COMMIT WORK;
			DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));

			EXCEPTION
				WHEN OTHERS THEN 
					DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(FALSE, salidaEsperada));
					ROLLBACK;
	END Insertar;

	PROCEDURE Eliminar (nombrePrueba VARCHAR2,n_idpago in pagos.idPago%TYPE, salidaEsperada BOOLEAN) IS
		num_pagos NUMBER :=0;
        num_pagos_in_tabla NUMBER :=0;
		BEGIN 
            select Count(*) into num_pagos_in_tabla from pagos where n_idpago=idPago;
			DELETE FROM pagos WHERE n_idpago=idpago;
			select Count(*) into num_pagos from pagos where n_idpago=idPago;
			if(num_pagos!= 0 and num_pagos_in_tabla = 1)
				THEN
				salida:=FALSE;
            elsif (num_pagos_in_tabla = 0)
                THEN
                salida:=FALSE;
			END IF;
			COMMIT WORK;
			DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));

			EXCEPTION
				WHEN OTHERS THEN 
					DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(FALSE, salidaEsperada));
					ROLLBACK;
	END Eliminar;
END Pruebas_Pagos;
/



Create or replace PACKAGE BODY Pruebas_Maquinas IS 
	salida BOOLEAN := TRUE;
	maquina Maquinas%ROWTYPE;

	PROCEDURE Inicializar IS
		BEGIN
			DELETE FROM Maquinas;
		END Inicializar;

	PROCEDURE Insertar (nombrePrueba VARCHAR2,n_nombre_maquina in maquinas.nombre_maquina%TYPE,
    n_categoria in maquinas.categoria%TYPE,n_fechaRevision in maquinas.fechaRevision%TYPE,  n_estropeada IN maquinas.estropeada%TYPE, 
    n_fechaActual IN maquinas.fechaActual%TYPE, salidaEsperada BOOLEAN) IS
       n_idMaquina maquinas.idMaquina%TYPE;
		BEGIN 
			insert into maquinas (nombre_maquina, categoria, fechaRevision, estropeada, fechaActual) 
            values (n_nombre_maquina, n_categoria, n_fechaRevision, n_estropeada, n_fechaActual);
			n_idMaquina := sec_maquinas.CURRVAL;
			select * into maquina from maquinas where n_idMaquina=idMaquina;
			if(maquina.nombre_maquina != n_nombre_maquina OR maquina.categoria != n_categoria OR maquina.fechaRevision != n_fechaRevision 
            OR maquina.estropeada != n_estropeada)
				THEN
				salida:=FALSE;
			END IF;
			COMMIT WORK;
			DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));

			EXCEPTION
				WHEN OTHERS THEN 
					DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(FALSE, salidaEsperada));
					ROLLBACK;
	END Insertar;

	PROCEDURE Actualizar (nombrePrueba VARCHAR2, n_idMaquina IN maquinas.idMaquina%TYPE,n_fechaRevision in maquinas.fechaRevision%TYPE,
     n_estropeada IN maquinas.estropeada%TYPE, n_fechaActual IN maquinas.fechaActual%TYPE, salidaEsperada BOOLEAN) IS
     fechaNueva DATE:= to_date('24/08/2000','dd/mm/rr');
     estropeadaNueva number := 0;
		BEGIN 
        select fechaRevision into fechaNueva from maquinas where n_idMaquina=idMaquina;
        select estropeada into estropeadaNueva from maquinas where n_idMaquina=idMaquina;
        if (fechaNueva != n_fechaRevision and estropeadaNueva != n_estropeada)
            THEN
			UPDATE maquinas SET fechaRevision = n_fechaRevision, estropeada = n_estropeada where n_idMaquina=idMaquina;
        elsif (fechaNueva != n_fechaRevision)
            THEN
            UPDATE maquinas SET fechaRevision = n_fechaRevision where n_idMaquina=idMaquina;
        elsif (estropeadaNueva != n_estropeada)
            THEN
            UPDATE maquinas SET estropeada = n_estropeada where n_idMaquina=idMaquina;
        end if;
			select * into maquina from maquinas where n_idMaquina=idMaquina;
			if(n_idMaquina != maquina.idMaquina)
				THEN
				salida:=FALSE;
			END IF;
			COMMIT WORK;
			DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));

			EXCEPTION
				WHEN OTHERS THEN 
					DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(FALSE, salidaEsperada));
					ROLLBACK;
	END Actualizar;

	PROCEDURE Eliminar (nombrePrueba VARCHAR2,n_idMaquina IN maquinas.idMaquina%TYPE, salidaEsperada BOOLEAN) IS
		num_maquinas NUMBER :=0;
        num_maquina_in NUMBER := 0;
		BEGIN 
			select Count(*) into num_maquina_in from maquinas where n_idMaquina=idMaquina;
			DELETE FROM maquinas WHERE n_idMaquina=idMaquina;
			select Count(*) into num_maquinas from maquinas where n_idMaquina=idMaquina;
			if(num_maquinas!= 0 and num_maquina_in = 1)
				THEN
				salida:=FALSE;
            elsif (num_maquina_in = 0)
                THEN
                salida:=FALSE;
			END IF;
			COMMIT WORK;
			DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));

			EXCEPTION
				WHEN OTHERS THEN 
					DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(FALSE, salidaEsperada));
					ROLLBACK;
	END Eliminar;
END Pruebas_Maquinas;
/

Create or replace PACKAGE BODY Pruebas_Tecnicos IS 
	salida BOOLEAN := TRUE;
	tecnico Tecnicos%ROWTYPE;

	PROCEDURE Inicializar IS
		BEGIN
			DELETE FROM Tecnicos;
		END Inicializar;

	PROCEDURE Insertar (nombrePrueba VARCHAR2, n_nombre IN tecnicos.nombre%TYPE, n_telefono IN tecnicos.telefono%TYPE, n_correo IN tecnicos.correo%TYPE, salidaEsperada BOOLEAN) IS
        n_idTecnico Tecnicos.idTecnico%TYPE;
		BEGIN 
			insert into tecnicos (nombre, telefono, correo) values (n_nombre, n_telefono, n_correo);
			n_idTecnico := sec_tecnicos.CURRVAL;
			select * into tecnico from tecnicos where idtecnico=n_idtecnico;
			if(tecnico.nombre != n_nombre OR tecnico.telefono != n_telefono OR tecnico.correo != n_correo)
				THEN
				salida:=FALSE;
			END IF;
			COMMIT WORK;
			DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));

			EXCEPTION
				WHEN OTHERS THEN 
					DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(FALSE, salidaEsperada));
					ROLLBACK;
	END Insertar;

	PROCEDURE Actualizar (nombrePrueba VARCHAR2, n_nombre IN tecnicos.nombre%TYPE, n_telefono IN tecnicos.telefono%TYPE, n_correo IN tecnicos.correo%TYPE,n_idtecnico IN tecnicos.idtecnico%TYPE, salidaEsperada BOOLEAN) IS
		BEGIN 
			UPDATE tecnicos SET nombre = n_nombre ,telefono = n_telefono, correo = n_correo where idtecnico = n_idtecnico;
			select * into tecnico from tecnicos where idtecnico=n_idtecnico;
			if(tecnico.nombre != n_nombre OR tecnico.telefono != n_telefono OR tecnico.correo != n_correo)
				THEN
				salida:=FALSE;
			END IF;
			COMMIT WORK;
			DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));

			EXCEPTION
				WHEN OTHERS THEN 
					DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(FALSE, salidaEsperada));
					ROLLBACK;
	END Actualizar;

	PROCEDURE Eliminar (nombrePrueba VARCHAR2,n_idtecnico IN tecnicos.idtecnico%TYPE, salidaEsperada BOOLEAN) IS
		num_tecnico NUMBER :=0;
        num_tecnico_in NUMBER :=0;
		BEGIN 
			select Count(*) into num_tecnico_in from tecnicos where  idtecnico = n_idTecnico;
			DELETE FROM tecnicos WHERE idtecnico = n_idtecnico;
			select Count(*) into num_tecnico from tecnicos where  idtecnico = n_idTecnico;
			if(num_tecnico != 0 and num_tecnico_in = 1)
				THEN
				salida:=FALSE;
            elsif (num_tecnico_in = 0)
                THEN
                salida:=FALSE;
			END IF;
			COMMIT WORK;
			DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));

			EXCEPTION
				WHEN OTHERS THEN 
					DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(FALSE, salidaEsperada));
					ROLLBACK;
	END Eliminar;
END Pruebas_Tecnicos;
/

Create or replace PACKAGE BODY Pruebas_Reparaciones IS 
	salida BOOLEAN := TRUE;
	reparacion Reparaciones%ROWTYPE;
    PROCEDURE Inicializar IS
		BEGIN
			DELETE FROM Reparaciones;
		END Inicializar;
        
 
    PROCEDURE Insertar (nombrePrueba VARCHAR2, n_idTecnico IN Reparaciones.idTecnico%TYPE,
    n_idMaquina IN Reparaciones.idMaquina%TYPE,salidaEsperada BOOLEAN) IS
        n_idReparacion Reparaciones.idReparacion%TYPE;
		BEGIN 
			insert into reparaciones (idTecnico, idMaquina) values (n_idTecnico, n_idMaquina);
			n_idReparacion := sec_reparaciones.CURRVAL;
			select * into reparacion from reparaciones where idReparacion=n_idReparacion;
			if(reparacion.idTecnico != n_idTecnico OR reparacion.idMaquina != n_idMaquina)
				THEN
				salida:=FALSE;
			END IF;
			COMMIT WORK;
			DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));

			EXCEPTION
				WHEN OTHERS THEN 
					DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(FALSE, salidaEsperada));
					ROLLBACK;
	END Insertar;
    
    PROCEDURE  Actualizar (nombrePrueba VARCHAR2,n_idTecnico IN Reparaciones.idTecnico%TYPE,
    n_idMaquina IN Reparaciones.idMaquina%TYPE,n_idReparacion In Reparaciones.idReparacion%TYPE,salidaEsperada BOOLEAN) IS
		BEGIN 
			UPDATE reparaciones SET idTecnico = n_idTecnico,idMaquina = n_idMaquina where n_idReparacion=idReparacion;
			select * into reparacion from reparaciones where idReparacion=n_idReparacion;
			if(reparacion.idTecnico != n_idTecnico OR reparacion.idMaquina != n_idMaquina)
				THEN
				salida:=FALSE;
			END IF;
			COMMIT WORK;
			DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));

			EXCEPTION
				WHEN OTHERS THEN 
					DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(FALSE, salidaEsperada));
					ROLLBACK;
     END Actualizar;
        
        PROCEDURE Eliminar (nombrePrueba VARCHAR2,n_idReparacion IN Reparaciones.idReparacion%TYPE,
        salidaEsperada BOOLEAN) IS
		num_reparaciones NUMBER :=0;
		num_reparaciones_in NUMBER :=0;
		BEGIN 
			select Count(*) into num_reparaciones_in from reparaciones where idReparacion=n_idReparacion;
			DELETE FROM reparaciones WHERE idReparacion=n_idReparacion;
			select Count(*) into num_reparaciones from reparaciones where idReparacion=n_idReparacion;
			if(num_reparaciones!= 0 and num_reparaciones_in = 1)
				THEN
				salida:=FALSE;
            elsif (num_reparaciones_in = 0)
                THEN 
                salida:=FALSE;
			END IF;
			COMMIT WORK;
			DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));

			EXCEPTION
				WHEN OTHERS THEN 
					DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(FALSE, salidaEsperada));
					ROLLBACK;
	END Eliminar; 
END Pruebas_Reparaciones;
/


Create or replace PACKAGE BODY Pruebas_Proveedores IS 
	salida BOOLEAN := TRUE;
	proveedor Proveedores%ROWTYPE;
    PROCEDURE Inicializar IS
		BEGIN
			DELETE FROM Proveedores;
		END Inicializar;
        
 
    PROCEDURE Insertar (nombrePrueba VARCHAR2, n_nombre_proveedor IN Proveedores.nombre_proveedor%TYPE,
    n_telefono IN Proveedores.telefono%TYPE,n_correo IN Proveedores.correo%TYPE,salidaEsperada BOOLEAN) IS
       n_idProveedor Proveedores.idProveedor%TYPE;
		BEGIN 
			insert into proveedores (nombre_proveedor, telefono,correo) values (n_nombre_proveedor, n_telefono,n_correo);
			n_idProveedor := sec_proveedores.CURRVAL;
			select * into proveedor from proveedores where idProveedor=n_idProveedor;
			if(proveedor.nombre_proveedor != n_nombre_proveedor OR proveedor.telefono != n_telefono OR proveedor.correo !=n_correo)
				THEN
				salida:=FALSE;
			END IF;
			COMMIT WORK;
			DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));

			EXCEPTION
				WHEN OTHERS THEN 
					DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(FALSE, salidaEsperada));
					ROLLBACK;
	END Insertar;
    
    PROCEDURE  Actualizar (nombrePrueba VARCHAR2, n_nombre_proveedor IN Proveedores.nombre_proveedor%TYPE,
    n_telefono IN Proveedores.telefono%TYPE,n_correo IN Proveedores.correo%TYPE, n_idProveedor IN Proveedores.idProveedor%TYPE,salidaEsperada BOOLEAN) IS
		BEGIN 
			UPDATE proveedores SET nombre_proveedor = n_nombre_proveedor, telefono = n_telefono, correo=n_correo where idProveedor=n_idProveedor;
			select * into proveedor from proveedores where idProveedor=n_idProveedor;
			if(proveedor.nombre_proveedor != n_nombre_proveedor OR proveedor.telefono != n_telefono OR proveedor.correo!=n_correo)
				THEN
				salida:=FALSE;
			END IF;
			COMMIT WORK;
			DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));

			EXCEPTION
				WHEN OTHERS THEN 
					DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(FALSE, salidaEsperada));
					ROLLBACK;
     END Actualizar;
        
        PROCEDURE Eliminar (nombrePrueba VARCHAR2, n_idProveedor IN Proveedores.idProveedor%TYPE,
        salidaEsperada BOOLEAN) IS
		num_proveedores NUMBER :=0;
		num_proveedores_in NUMBER :=0;
		BEGIN 
			select Count(*) into num_proveedores_in from proveedores where idProveedor=n_idProveedor;
			DELETE FROM proveedores WHERE idProveedor=n_idProveedor;
			select Count(*) into num_proveedores from proveedores where idProveedor=n_idProveedor;
			if(num_proveedores!= 0 and num_proveedores_in = 1)
				THEN
				salida:=FALSE;
            elsif (num_proveedores_in = 0)
                THEN
                salida:=FALSE;
			END IF;
			COMMIT WORK;
			DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));

			EXCEPTION
				WHEN OTHERS THEN 
					DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(FALSE, salidaEsperada));
					ROLLBACK;
	END Eliminar; 
END Pruebas_Proveedores;
/

Create or replace PACKAGE BODY Pruebas_Reposiciones IS 
	salida BOOLEAN := TRUE;
	reposicion Reposiciones%ROWTYPE;

	PROCEDURE Inicializar IS
		BEGIN
			DELETE FROM Reposiciones;
		END Inicializar;

	PROCEDURE Insertar (nombrePrueba VARCHAR2,n_fechaReposicion IN Reposiciones.fechaReposicion%TYPE, n_idProveedor IN Reposiciones.idproveedor%TYPE, salidaEsperada BOOLEAN) IS
        n_idReposicion reposiciones.idreposicion%TYPE;
		BEGIN 
			insert into reposiciones (fechareposicion, idproveedor) values (n_fechaReposicion , n_idProveedor);
			n_idReposicion := sec_reposiciones.CURRVAL;
			select * into reposicion from reposiciones where idreposicion=n_idreposicion;
			if(reposicion.fechareposicion != n_fechareposicion OR reposicion.idproveedor != n_idproveedor)
				THEN
				salida:=FALSE;
			END IF;
			COMMIT WORK;
			DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));

			EXCEPTION
				WHEN OTHERS THEN 
					DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(FALSE, salidaEsperada));
					ROLLBACK;
	END Insertar;

	PROCEDURE Actualizar (nombrePrueba VARCHAR2,n_fechaReposicion IN Reposiciones.fechaReposicion%TYPE, n_idProveedor IN Reposiciones.idproveedor%TYPE,n_idReposicion IN Reposiciones.idReposicion%TYPE, salidaEsperada BOOLEAN) IS
		BEGIN 
			UPDATE reposiciones SET fechareposicion = n_fechareposicion ,idproveedor= n_idproveedor where idreposicion = n_idreposicion;
			select * into reposicion from reposiciones where idreposicion=n_idreposicion;
			if(reposicion.fechareposicion != n_fechareposicion OR reposicion.idproveedor != n_idproveedor)
				THEN
				salida:=FALSE;
			END IF;
			COMMIT WORK;
			DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));

			EXCEPTION
				WHEN OTHERS THEN 
					DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(FALSE, salidaEsperada));
					ROLLBACK;
	END Actualizar;

	PROCEDURE Eliminar (nombrePrueba VARCHAR2,n_idReposicion IN Reposiciones.idReposicion%TYPE, salidaEsperada BOOLEAN) IS
		num_reposicion NUMBER :=0;
        num_reposicion_in NUMBER :=0;
		BEGIN 
			select Count(*) into num_reposicion_in from reposiciones where  idreposicion = n_idreposicion;
			DELETE FROM reposiciones WHERE idreposicion = n_idreposicion;
			select Count(*) into num_reposicion from reposiciones where  idreposicion = n_idreposicion;
			if(num_reposicion!= 0 and num_reposicion_in = 1)
				THEN
				salida:=FALSE;
            elsif (num_reposicion_in = 0)
                THEN
                salida:=FALSE;
			END IF;
			COMMIT WORK;
			DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));

			EXCEPTION
				WHEN OTHERS THEN 
					DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(FALSE, salidaEsperada));
					ROLLBACK;
	END Eliminar;
END Pruebas_Reposiciones;
/

Create or replace PACKAGE BODY Pruebas_Suplementos IS 
	salida BOOLEAN := TRUE;
	suplemento suplementos%ROWTYPE;

	PROCEDURE Inicializar IS
		BEGIN
			DELETE FROM suplementos;
		END Inicializar;

	PROCEDURE Insertar (nombrePrueba VARCHAR2, n_nombre IN suplementos.nombre%TYPE, n_precio IN suplementos.precio%TYPE, n_stock IN suplementos.stock%TYPE, salidaEsperada BOOLEAN) IS
        n_idsuplemento Suplementos.idsuplemento%TYPE;
		BEGIN 
			insert into suplementos (nombre, precio, stock) values (n_nombre, n_precio, n_stock);
			n_idsuplemento := sec_suplementos.CURRVAL;
			select * into suplemento from suplementos where idsuplemento=n_idsuplemento;
			if(suplemento.nombre != n_nombre OR suplemento.precio != n_precio OR suplemento.stock != n_stock)
				THEN
				salida:=FALSE;
			END IF;
			COMMIT WORK;
			DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));

			EXCEPTION
				WHEN OTHERS THEN 
					DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(FALSE, salidaEsperada));
					ROLLBACK;
	END Insertar;

	PROCEDURE Actualizar (nombrePrueba VARCHAR2, n_precio IN suplementos.precio%TYPE, n_stock IN suplementos.stock%TYPE,n_idSuplemento IN suplementos.idsuplemento%TYPE, salidaEsperada BOOLEAN) IS
		BEGIN 
			UPDATE suplementos SET precio = n_precio, stock = n_stock where idsuplemento = n_idsuplemento;
			select * into suplemento from suplementos where idsuplemento=n_idsuplemento;
			if(suplemento.precio != n_precio OR suplemento.stock != n_stock)
				THEN
				salida:=FALSE;
			END IF;
			COMMIT WORK;
			DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));

			EXCEPTION
				WHEN OTHERS THEN 
					DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(FALSE, salidaEsperada));
					ROLLBACK;
	END Actualizar;

	PROCEDURE Eliminar (nombrePrueba VARCHAR2,n_idSuplemento IN suplementos.idsuplemento%TYPE, salidaEsperada BOOLEAN) IS
		num_suplemento NUMBER :=0;
        num_suplemento_in NUMBER :=0;
		BEGIN 
			select Count(*) into num_suplemento_in from suplementos where  idsuplemento = n_idsuplemento;
			DELETE FROM suplementos WHERE idsuplemento = n_idsuplemento;
			select Count(*) into num_suplemento from suplementos where  idsuplemento = n_idsuplemento;
			if(num_suplemento != 0 and num_suplemento_in = 1)
				THEN
				salida:=FALSE;
            elsif (num_suplemento_in = 0)
                THEN
                salida:=FALSE;
			END IF;
			COMMIT WORK;
			DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));

			EXCEPTION
				WHEN OTHERS THEN 
					DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(FALSE, salidaEsperada));
					ROLLBACK;
	END Eliminar;
END Pruebas_Suplementos;
/

Create or replace PACKAGE BODY Pruebas_LineasReposicion IS 
	salida BOOLEAN := TRUE;
	linea LineaReposicion%ROWTYPE;

	PROCEDURE Inicializar IS
		BEGIN
			DELETE FROM LineaReposicion;
		END Inicializar;

	PROCEDURE Insertar (nombrePrueba VARCHAR2, n_cantidad IN lineaReposicion.cantidad%TYPE, n_precio_lin IN lineaReposicion.precio_lin%TYPE, n_idreposicion IN lineaReposicion.idreposicion%TYPE, n_idsuplemento IN lineaReposicion.idsuplemento%TYPE, salidaEsperada BOOLEAN) IS
        n_idlineaReposicion lineareposicion.idlineareposicion%TYPE;
		BEGIN 
			insert into lineareposicion (cantidad, precio_lin, idreposicion, idsuplemento) values (n_cantidad, n_precio_lin, n_idreposicion, n_idsuplemento);
			n_idLineaReposicion := sec_lineareposicion.CURRVAL;
			select * into linea from lineareposicion where idlineareposicion=n_idlineareposicion;
			if(linea.cantidad != n_cantidad OR linea.precio_lin != n_precio_lin OR linea.idreposicion != n_idreposicion OR linea.idsuplemento != n_idsuplemento)
				THEN
				salida:=FALSE;
			END IF;
			COMMIT WORK;
			DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));

			EXCEPTION
				WHEN OTHERS THEN 
					DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(FALSE, salidaEsperada));
					ROLLBACK;
	END Insertar;

	PROCEDURE Actualizar (nombrePrueba VARCHAR2, n_cantidad IN lineaReposicion.cantidad%TYPE, n_precio_lin IN lineaReposicion.precio_lin%TYPE, n_idreposicion IN lineaReposicion.idreposicion%TYPE, n_idsuplemento IN lineaReposicion.idsuplemento%TYPE,n_idlineaReposicion IN lineaReposicion.idLineaReposicion%TYPE, salidaEsperada BOOLEAN) IS
		BEGIN 
			UPDATE lineareposicion SET cantidad = n_cantidad ,precio_lin= n_precio_lin, idreposicion = n_idreposicion, idsuplemento = n_idsuplemento  where idlineareposicion = n_idlineareposicion;
			select * into linea from lineareposicion where idlineareposicion=n_idlineareposicion;
			if(linea.cantidad != n_cantidad OR linea.precio_lin != n_precio_lin OR linea.idreposicion != n_idreposicion OR linea.idsuplemento != n_idsuplemento)
				THEN
				salida:=FALSE;
			END IF;
			COMMIT WORK;
			DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));

			EXCEPTION
				WHEN OTHERS THEN 
					DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(FALSE, salidaEsperada));
					ROLLBACK;
	END Actualizar;

	PROCEDURE Eliminar (nombrePrueba VARCHAR2,n_idlineaReposicion IN lineaReposicion.idlineaReposicion%TYPE, salidaEsperada BOOLEAN) IS
		num_lin NUMBER :=0;
        num_lin_in NUMBER :=0;
		BEGIN 
			select Count(*) into num_lin_in from lineareposicion where  idlineareposicion = n_idlineareposicion;
			DELETE FROM lineareposicion WHERE idlineareposicion = n_idlineareposicion;
			select Count(*) into num_lin from lineareposicion where  idlineareposicion = n_idlineareposicion;
			if(num_lin != 0 and num_lin_in = 1)
				THEN
				salida:=FALSE;
            elsif (num_lin_in = 0)
                THEN
                salida:=FALSE;
			END IF;
			COMMIT WORK;
			DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(salida,salidaEsperada));

			EXCEPTION
				WHEN OTHERS THEN 
					DBMS_OUTPUT.PUT_LINE(nombrePrueba || ':' || ASSERT_EQUALS(FALSE, salidaEsperada));
					ROLLBACK;
	END Eliminar;
END Pruebas_LineasReposicion;
/




--Pruebas
BEGIN
    Pruebas_Usuarios.inicializar;
    Pruebas_Usuarios.Insertar('insertar un usuario','Juan', 'Loreto', '16874528L', 789654151, true);
    Pruebas_Usuarios.Insertar('insertar un usuario','Maria', 'Gracho', '36874528L', 789654153, true);
    Pruebas_Usuarios.Insertar('no insertar un usuario repitiendo dni','Pepe', 'Monte', '36874528L', 789654152, false);
    Pruebas_Usuarios.Insertar('insertar un usuario','Asucena', 'Cano', '46874528L', 789654154, true);
    Pruebas_Usuarios.Actualizar('actualizar un usuario','Asucena', 'Cano', '46874528L', 678623620, true);
    Pruebas_Usuarios.Eliminar('eliminar un usuario','16874528L', true);
END;
/


BEGIN
    Pruebas_Problemas_Medicos.inicializar;
    Pruebas_Problemas_Medicos.Insertar('insertar un problema','asma',1, false);
    Pruebas_Problemas_Medicos.Insertar('insertar un problema','asma',2, true);
    Pruebas_Problemas_Medicos.Insertar('no insertar un problema con id repetido','azucar',1, false);
    Pruebas_Problemas_Medicos.Insertar('insertar un problema','diabetes',4, true);
    Pruebas_Problemas_Medicos.Eliminar('eliminar un problema','diabetes', 4, true);
END;
/

BEGIN
    Pruebas_tarifas.insertar('Insertar una tarifa', 'Basico', 25, 1, true);
    Pruebas_tarifas.insertar('Insertar una tarifa', 'Familiar', 50, 1, true);
    Pruebas_tarifas.insertar('Insertar una tarifa', 'FamiliarAsociado', 0, 1, true);
    Pruebas_tarifas.insertar('Insertar una tarifa', 'FamiliarExtra', 5, 1, true);
    Pruebas_tarifas.insertar('Insertar una tarifa', 'Amigo', 20, 1, true);
    Pruebas_tarifas.insertar('Insertar una tarifa', 'Trimestral', 70, 3, true);
    Pruebas_tarifas.insertar('Insertar una tarifa', 'Anual', 240, 12, true);
    Pruebas_tarifas.insertar('Insertar una tarifa', 'Doble Anual', 450, 24, true);
    Pruebas_tarifas.insertar('Insertar una tarifa', 'Doble Anual', 480, 20, false);
    Pruebas_tarifas.actualizar('Actualizar una tarifa', 'Doble Anual', 460, true);
    Pruebas_tarifas.actualizar('Actualizar una tarifa', 'Basico', 20, true);
    Pruebas_tarifas.eliminar('Eliminar una tarifa', 'FamiliarExtra', true);
    Pruebas_tarifas.eliminar('no Eliminar una tarifa que no existe', 'Socio del Gym', false);
END;
/

BEGIN
    Pruebas_Pagos.inicializar;
    Pruebas_Pagos.Insertar('insertar un pago', to_date('17/08/2018','dd/mm/rr'), to_date('17/09/2018','dd/mm/rr'), 2, 'Basico', true);
    Pruebas_Pagos.Insertar('insertar un pago', to_date('18/09/2018','dd/mm/rr'), to_date('18/10/2018','dd/mm/rr'), 2, 'Basico', true);
    Pruebas_Pagos.Insertar('insertar un pago', to_date('22/08/2018','dd/mm/rr'), to_date('22/11/2018','dd/mm/rr'), 4, 'Trimestral', true);
    Pruebas_Pagos.Insertar('insertar un pago', to_date('01/01/2020','dd/mm/rr'), to_date('01/04/2020','dd/mm/rr'), 4, 'Trimestral', true);
    Pruebas_Pagos.Insertar('no insertar un pago en un usuario inexistente', to_date('01/01/2020','dd/mm/rr'), to_date('01/01/2021','dd/mm/rr'), 1, 'Anual', false);
    Pruebas_Pagos.Eliminar('eliminar un pago', 3, true);
    Pruebas_Pagos.Eliminar('eliminar un pago', 7, false);
END;
/


BEGIN
    Pruebas_Maquinas.inicializar;
    Pruebas_Maquinas.insertar('insertar una maquina', 'Cinta de Correr', 'Cardio', to_date('17/02/2020','dd/mm/rr'), 0, sysdate, true);
    Pruebas_Maquinas.insertar('insertar una maquina', 'Eliptica', 'Cardio', to_date('25/02/2020','dd/mm/rr'), 0, sysdate, true);
    Pruebas_Maquinas.insertar('insertar una maquina', 'Press Militar', 'Tren Superior', to_date('08/01/2020','dd/mm/rr'), 0, sysdate, true);
    Pruebas_Maquinas.insertar('insertar una maquina', 'Extensión de Cuadriceps', 'Tren Inferior', to_date('17/02/2020','dd/mm/rr'), 0, sysdate, true);
    Pruebas_Maquinas.insertar('insertar una maquina con fecha de revisión nula', 'Extensión de Cuadriceps', 'Tren Inferior', null, 0, sysdate, false);
    Pruebas_Maquinas.actualizar('actualizar una maquina', 3, to_date('08/01/2021','dd/mm/rr'), 0, sysdate, true);
    Pruebas_Maquinas.actualizar('no actualizar una maquina por trigger', 3, to_date('08/05/2020','dd/mm/rr'), 0, sysdate, false);
    Pruebas_Maquinas.eliminar('eliminar una maquina', 4, true);
END;
/

BEGIN
    Pruebas_Tecnicos.inicializar;
    Pruebas_Tecnicos.Insertar('insertar un tecnico','PePe', 657348532, 'pepitotonel@gmail.com', true);
    Pruebas_Tecnicos.Insertar('insertar un tecnico','Juan', 677777777, 'JuaneldelBOMBO@Bombiño.esp', true);
    Pruebas_Tecnicos.Insertar('insertar un tecnico','Antonio', 657348540, 'Antonino@hotmail.org', true);
    Pruebas_Tecnicos.Insertar('no insertar un tecnico sin nombre',null, 657348532, 'Andre@gmail.com', false);
    Pruebas_Tecnicos.Insertar('no insertar un tecnico sin telefono','Maria', null, 'pepitotonel@yahoo.es', false);
    Pruebas_Tecnicos.Insertar('no insertar un tecnico con numero mal','PePe', 65734853222, 'pepitotonel@gmail.com', false);
    Pruebas_Tecnicos.Actualizar('actualizar un tecnico','Maria',675748271, 'marialaguapa@gmail.com', 1, true);
    Pruebas_Tecnicos.Eliminar('eliminar un tecnico',3, true);
END;
/

BEGIN
    Pruebas_Reparaciones.Inicializar;
    Pruebas_Reparaciones.Insertar('insertar una reparacion',1,1,true);
    Pruebas_Reparaciones.Insertar('insertar una reparacion',1,2,true);
    Pruebas_Reparaciones.Insertar('insertar una reparacion',1,3,true);
    Pruebas_Reparaciones.Insertar('no insertar una reparacion de una máquina inexistente',2,4,false);
    Pruebas_Reparaciones.Actualizar('actualizar una reparacion',2,2,2, true);
    Pruebas_Reparaciones.Eliminar('eliminar un reparacion', 3, true);
END;
/

BEGIN
    Pruebas_Proveedores.Inicializar;
    Pruebas_Proveedores.Insertar('insertar un proveedor','cocacola',954678239,'cocacola@gmail',true);
    Pruebas_Proveedores.Insertar('insertar un proveedor','pipas',959678239,'cocacoña@gmail',true);
    Pruebas_Proveedores.Insertar('no insertar un proveedor con correo inválido','kikos',950678239,'cocacilaARROBAgmail',false);
    Pruebas_Proveedores.Insertar('insertar un proveedor','agua',958678239,'cocacoka@gmail',true);
    Pruebas_Proveedores.Actualizar('actualizar un proveedor','cocacola',954638239,'cocacola@gmail.com', 1, true);
    Pruebas_Proveedores.Eliminar('eliminar un proveedor', 2, true);
END;
/

BEGIN
    Pruebas_Reposiciones.inicializar;
    Pruebas_Reposiciones.Insertar('insertar una reposicion',to_date('17/06/2018','dd/mm/rr'), 1, true);
    Pruebas_Reposiciones.Insertar('insertar una reposicion',to_date('17/07/2018','dd/mm/rr'), 1, true);
    Pruebas_Reposiciones.Insertar('insertar una reposicion',to_date('17/06/2018','dd/mm/rr'), 2, false);
    Pruebas_Reposiciones.Insertar('no insertar una reposicion con fecha nula',null, 2, false);
    Pruebas_Reposiciones.Actualizar('actualizar una repsosicion',to_date('13/06/2018','dd/mm/rr'),4, 1, true);
    Pruebas_Reposiciones.Eliminar('eliminar una reposicion',2, true);
END;
/

BEGIN
    Pruebas_Suplementos.inicializar;
    Pruebas_Suplementos.Insertar('insertar un suplemento','Barritas proteicas', '1,5', 50, true);
    Pruebas_Suplementos.Insertar('insertar un suplemento','Proteinas', '20,0', 20, true);
    Pruebas_Suplementos.Insertar('insertar un suplemento','Aquario', '1,0', 50, true);
    Pruebas_Suplementos.Insertar('no insertar un suplemento sin precio','Proteinas', null, 50, false);
    Pruebas_Suplementos.Insertar('no insertar un suplemento con stock vacio','Proteinas', '1,0', null, false);
    Pruebas_Suplementos.Actualizar('actualiza un suplemento', '15,0', 50,2, true);
    Pruebas_Suplementos.Eliminar('eliminar un suplemento',1, true);
END;
/

BEGIN
    Pruebas_LineasReposicion.inicializar;
    Pruebas_LineasReposicion.Insertar('insertar una linea de reposicion',20, '2,0', 1, 2, true);
    Pruebas_LineasReposicion.Insertar('insertar una linea de reposicion',15, '1,5', 1, 2, true);
    Pruebas_LineasReposicion.Insertar('insertar una linea de reposicion',20, '2,0', 3, 3, false);
    Pruebas_LineasReposicion.Insertar('no insertar una linea de reposicion sin cantidad',null, '2,0', 2, 1, false);
    Pruebas_LineasReposicion.Insertar('no insertar una linea de reposicion sin precio',20, null, 2, 1, false);
    Pruebas_LineasReposicion.Actualizar('actualizar una linea de repsosicion',17, '1,0', 1, 3, 2, true);
    Pruebas_LineasReposicion.Eliminar('eliminar una linea de reposicion',2, true);
END;
/