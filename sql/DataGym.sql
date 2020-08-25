set SERVEROUTPUT ON;
--Borrado de tablas
drop table avisos;

drop table mensajes;

drop table pagos cascade constraints;

drop table tarifas cascade constraints;

drop table problemas_medicos cascade constraints;

drop table usuarios cascade constraints;

drop table reparaciones cascade constraints;

drop table tecnicos cascade constraints;

drop table maquinas cascade constraints;

drop table lineaReposicion cascade constraints;

drop table suplementos cascade constraints;

drop table reposiciones cascade constraints;

drop table proveedores cascade constraints;


--Creacion de tablas
create table mensajes
    (idMensaje smallint PRIMARY KEY,
    nombre VARCHAR2(20),
    correo VARCHAR2(30),
    mensaje VARCHAR2(500));
    
    
create table avisos
    (idAviso smallint PRIMARY KEY,
    fechaAviso DATE,
    aviso VARCHAR2(100));
    
create table usuarios
    (idUsuario smallint, 
    nombre VARCHAR2(20) not null,
    apellido VARCHAR2(20),
    dni VARCHAR2(9) not null unique,
    telefono VARCHAR2(9),
    correo VARCHAR2(30) not null unique,
    fecha_nacimiento DATE not null,
    direccion VARCHAR(50),
    codigo_postal VARCHAR2(5),
    contraseña VARCHAR2(20) not null,
    primary key(idUsuario));
    
create table problemas_medicos
    (nombre_problema_medico varchar2(250),
    idUsuario smallint,
    primary key(nombre_problema_medico,idUsuario),
    foreign key(idUsuario) references usuarios
    on delete cascade);

create table tarifas
    (nombre_Tarifa varchar2(20), 
    precio integer not null,
    duracion_meses number(2) not null,
    primary key(nombre_Tarifa));
    
create table pagos
    (idPago smallint,
    FechaInicio date not null, 
    FechaFin date not null, 
    idUsuario smallint,
    nombre_tarifa varchar2(20),
    PRIMARY key(idPago),
    foreign key(idUsuario) references usuarios on delete cascade,
    foreign key(nombre_tarifa) references tarifas);
    
create table maquinas
    (idMaquina smallint PRIMARY KEY,
    nombre_maquina VARCHAR2(30),
    categoria VARCHAR2(20),
    fechaRevision DATE not null,
    estropeada smallint DEFAULT (0),
    fechaActual DATE DEFAULT (sysdate),
    CHECK(estropeada = 1 or estropeada = 0));--CHECK((fechaRevision - sysdate) >= 0) con trigger y hacer tambien fechaInicio - fechaFin = duracion_meses
--,CHECK(fechaRevision >= fechaActual) fechaRevision DATE not null,
create table tecnicos 
    (idTecnico smallint PRIMARY KEY,
    nombre VARCHAR(20) not null,
    telefono INTEGER not null,
    correo VARCHAR2(50));

create table reparaciones
    (idReparacion smallint PRIMARY KEY,
    idTecnico smallint,
    idMaquina smallint,
    fechaReparacion DATE,
    foreign key (idTecnico) references tecnicos on delete cascade,
    foreign key (idMaquina) references maquinas);
    
create table proveedores 
    (idProveedor smallint PRIMARY KEY,
    nombre_proveedor VARCHAR(20) not null,
    telefono INTEGER not null,
    correo VARCHAR2(50));
    
create table reposiciones 
    (idReposicion smallint PRIMARY KEY,
    fechaReposicion DATE not null,
    idproveedor smallint,
    foreign key (idProveedor) references proveedores);
    
create table suplementos
    (idSuplemento smallint PRIMARY KEY,
    nombre VARCHAR(20),
    precio FLOAT not null,
    stock INTEGER not null);
    
create table lineaReposicion
    (idLineaReposicion smallint PRIMARY KEY,
    cantidad INTEGER not null,
    precio_lin FLOAT not null,
    idReposicion smallint,
    idSuplemento smallint,
    foreign key (idReposicion) references reposiciones,
    foreign key (idSuplemento) references suplementos);
  

--Condiciones
--DECLARE fechaActual DATE DEFAULT (SYSDATE);

ALTER TABLE maquinas ADD CONSTRAINT CK_Categoria_Maquinas CHECK (categoria IN ('Cardio', 'Tren Superior', 'Tren Inferior'));
ALTER TABLE usuarios ADD CONSTRAINT CK_Dni_Usuarios CHECK (length(dni) = 9);
ALTER TABLE usuarios ADD CONSTRAINT CK_Telefono_Usuarios CHECK (length(telefono) = 9);
ALTER TABLE tarifas ADD CONSTRAINT CK_Precio_Tarifas CHECK (precio >= 0);
ALTER TABLE tarifas ADD CONSTRAINT CK_Duraciones_Tarifas CHECK (duracion_meses > 0);
ALTER TABLE pagos ADD CONSTRAINT CK_Fechas_Pagos CHECK ((fechaFin - FechaInicio) >= 0);
ALTER TABLE tecnicos ADD CONSTRAINT CK_Telefono_Tecnicos CHECK (length(telefono) = 9);
ALTER TABLE proveedores ADD CONSTRAINT CK_Telefono_Proveedores CHECK (length(telefono) = 9);
ALTER TABLE suplementos ADD CONSTRAINT CK_Stock_Suplementos CHECK (stock >= 0);
ALTER TABLE suplementos ADD CONSTRAINT CK_Precio_Suplementos CHECK (precio > 0);
ALTER TABLE lineaReposicion ADD CONSTRAINT CK_Cantidad_LineaReposicion CHECK (cantidad > 0);
ALTER TABLE lineaReposicion ADD CONSTRAINT CK_Precio_LineaReposicion CHECK (precio_lin > 0);


--Secuencias
drop sequence sec_avisos;
drop sequence sec_mensajes;
drop sequence sec_usuarios;
drop sequence sec_pagos;
drop sequence sec_maquinas;
drop sequence sec_tecnicos;
drop sequence sec_proveedores;
drop sequence sec_reparaciones;
drop sequence sec_reposiciones;
drop sequence sec_lineaReposicion;
drop sequence sec_suplementos;


create sequence sec_mensajes
INCREMENT BY 1
start with 1;

create sequence sec_avisos
INCREMENT BY 1
start with 1;

create sequence sec_usuarios
INCREMENT BY 1
start with 1;

create sequence sec_pagos
INCREMENT BY 1
start with 1;

create sequence sec_maquinas
INCREMENT BY 1
start with 1;

create sequence sec_tecnicos
INCREMENT BY 1
start with 1
maxvalue 100;

create sequence sec_proveedores
INCREMENT BY 1
start with 1
maxvalue 250;

create sequence sec_reparaciones
INCREMENT BY 1
start with 1;

create sequence sec_reposiciones
INCREMENT BY 1
start with 1;

create sequence sec_lineaReposicion
INCREMENT BY 1
start with 1;

create sequence sec_suplementos
INCREMENT BY 1
start with 1;


--triggers id
create or replace trigger crear_id_mensajes
before insert on mensajes
for each row
DECLARE
    valorSec10 NUMBER := 0;
BEGIN
SELECT sec_avisos.NEXTVAL INTO valorSec10 FROM DUAL;
    :NEW.idMensaje := valorSec10;
END;
/

create or replace trigger crear_id_avisos
before insert on avisos
for each row
DECLARE
    valorSec0 NUMBER := 0;
BEGIN
SELECT sec_avisos.NEXTVAL INTO valorSec0 FROM DUAL;
    :NEW.idAviso := valorSec0;
END;
/

create or replace trigger crear_id_usuario
before insert on usuarios
for each row
DECLARE
    valorSec NUMBER := 0;
BEGIN
SELECT sec_usuarios.NEXTVAL INTO valorSec FROM DUAL;
    :NEW.idUsuario := valorSec;
END;
/

create or replace trigger crear_id_pagos
before insert on pagos
for each row
DECLARE
    valorSec1 NUMBER := 0;
BEGIN
SELECT sec_pagos.NEXTVAL INTO valorSec1 FROM DUAL;
    :NEW.idPago := valorSec1;
END;
/

create or replace trigger crear_id_maquina
before insert on maquinas
for each row
DECLARE
    valorSec2 NUMBER := 0;
BEGIN
SELECT sec_maquinas.NEXTVAL INTO valorSec2 FROM DUAL;
    :NEW.idMaquina := valorSec2;
END;
/

create or replace trigger crear_id_tecnico
before insert on tecnicos
for each row
DECLARE
    valorSec3 NUMBER := 0;
BEGIN
SELECT sec_tecnicos.NEXTVAL INTO valorSec3 FROM DUAL;
    :NEW.idTecnico := valorSec3;
END;
/

create or replace trigger crear_id_reparaciones
before insert on reparaciones
for each row
DECLARE
    valorSec4 NUMBER := 0;
BEGIN
SELECT sec_reparaciones.NEXTVAL INTO valorSec4 FROM DUAL;
    :NEW.idReparacion := valorSec4;
END;
/

create or replace trigger crear_id_proveedores
before insert on proveedores
for each row
DECLARE
    valorSec5 NUMBER := 0;
BEGIN
SELECT sec_proveedores.NEXTVAL INTO valorSec5 FROM DUAL;
    :NEW.idProveedor := valorSec5;
END;
/

create or replace trigger crear_id_reposiciones
before insert on reposiciones
for each row
DECLARE
    valorSec6 NUMBER := 0;
BEGIN
SELECT sec_reposiciones.NEXTVAL INTO valorSec6 FROM DUAL;
    :NEW.idReposicion := valorSec6;
END;
/

create or replace trigger crear_id_lineareposicion
before insert on lineaReposicion
for each row
DECLARE
    valorSec7 NUMBER := 0;
BEGIN
SELECT sec_lineaReposicion.NEXTVAL INTO valorSec7 FROM DUAL;
    :NEW.idLineaReposicion := valorSec7;
END;
/

create or replace trigger crear_id_suplementos
before insert on suplementos
for each row
DECLARE
    valorSec8 NUMBER := 0;
BEGIN
SELECT sec_suplementos.NEXTVAL INTO valorSec8 FROM DUAL;
    :NEW.idSuplemento := valorSec8;
END;
/


--triggers de inserción
create or replace trigger tr_reponer_stock
after update on suplementos
FOR EACH ROW
BEGIN
   if (:NEW.stock < 5)
        THEN 
        insert into avisos (fechaAviso, aviso) values (sysdate, 'El producto '||:NEW.nombre||' se está acabando');
    END IF;
END;
/

create or replace trigger tr_arreglar_maquina
after update on maquinas
FOR EACH ROW
BEGIN
   if (:NEW.estropeada > 0)
        THEN 
        insert into avisos (fechaAviso, aviso) values (sysdate, 'La máquina '||:NEW.idMaquina||' está estropeada');
    END IF;
END;
/

create or replace trigger tr_revision_maquina
before update on maquinas
FOR EACH ROW
BEGIN
    if ((:NEW.fechaRevision - :OLD.fechaRevision)/365.25 < 1)
        THEN
        raise_application_error(-20600, 'Fecha de revisión incorrecta');
    END IF;
END;
/

create or replace trigger tr_sumar_stock
after insert on LineaReposicion
FOR EACH ROW
    DECLARE stockproducto NUMBER;
BEGIN
    select stock into stockproducto from suplementos where idSuplemento = :NEW.idSuplemento;
    stockproducto := stockproducto + :NEW.cantidad;
    UPDATE suplementos SET stock = stockproducto where idsuplemento = :NEW.idSuplemento;
END;
/

CREATE OR REPLACE TRIGGER TR_Email_Tecnico
AFTER INSERT OR UPDATE OF correo ON tecnicos
FOR EACH ROW
DECLARE
n_correo VARCHAR2(50) := :NEW.correo;
    BEGIN
    IF n_correo NOT LIKE '%@%' 
    THEN
        RAISE_APPLICATION_ERROR(-20001, 'El correo no tiene un formato correcto');
    END IF;
END;
/

CREATE OR REPLACE TRIGGER TR_Email_proveedores
AFTER INSERT OR UPDATE OF correo ON proveedores
FOR EACH ROW
DECLARE
n_correo VARCHAR2(50) := :NEW.correo;
    BEGIN
    IF n_correo NOT LIKE '%@%' 
    THEN
        RAISE_APPLICATION_ERROR(-20001, 'El correo no tiene un formato correcto');
    END IF;
END;
/


--creacion procedimientos
create or replace procedure crear_mensaje
    (n_nombre in mensajes.nombre%TYPE,
    n_correo in mensajes.correo%TYPE,
    n_mensaje in mensajes.mensaje%TYPE
    ) IS
    BEGIN
    insert into mensajes (nombre, correo, mensaje)
    values (n_nombre, n_correo, n_mensaje);
    COMMIT;
    END crear_mensaje;
/

create or replace procedure crear_usuario 
    (n_nombre in usuarios.nombre%TYPE,
    n_apellido in usuarios.apellido%TYPE,
    n_dni in usuarios.dni%TYPE,
    n_telefono in usuarios.telefono%TYPE,
    n_correo in usuarios.correo%TYPE,
    n_fecha_nacimiento in usuarios.fecha_nacimiento%TYPE,
    n_direccion in usuarios.direccion%TYPE,
    n_codigo_postal in usuarios.codigo_postal%TYPE,
    n_contraseña in usuarios.contraseña%TYPE
    ) IS
    BEGIN
    insert into usuarios (nombre, apellido, dni, telefono, correo, fecha_nacimiento, direccion, codigo_postal, contraseña)
    values (n_nombre, n_apellido, n_dni, n_telefono, n_correo, n_fecha_nacimiento, n_direccion, n_codigo_postal, n_contraseña);
    COMMIT;
    END crear_usuario;
/

create or replace procedure crear_problemas_medicos
    (n_nombre_problema_medico in problemas_medicos.nombre_problema_medico%TYPE,
    n_idUsuario in problemas_medicos.idUsuario%TYPE
    ) IS
    BEGIN
    insert into problemas_medicos (nombre_problema_medico, idUsuario)
    values (n_nombre_problema_medico, n_idUsuario);
    COMMIT;
    END crear_problemas_medicos;
/

create or replace procedure crear_tarifas 
    (n_nombre_Tarifa in tarifas.nombre_Tarifa%TYPE,
    n_precio in tarifas.precio%TYPE,
    n_duracion_meses in tarifas.duracion_meses%TYPE
    ) IS
    BEGIN
    insert into tarifas (nombre_Tarifa, precio, duracion_meses)
    values (n_nombre_Tarifa, n_precio, n_duracion_meses);
    COMMIT;
    END crear_tarifas;
/

create or replace procedure crear_pagos 
    (n_FechaInicio in pagos.FechaInicio%TYPE,
    n_FechaFin in pagos.FechaFin%TYPE,
    n_idUsuario in pagos.idUsuario%TYPE,
    n_nombre_tarifa in pagos.nombre_tarifa%TYPE
    ) IS
    BEGIN
    insert into pagos (FechaInicio, FechaFin, idUsuario, nombre_tarifa)
    values (n_FechaInicio, n_FechaFin, n_idUsuario, n_nombre_tarifa);
    COMMIT;
    END crear_pagos;
/

create or replace procedure crear_maquinas 
    (n_nombre_maquina in maquinas.nombre_maquina%TYPE,
    n_categoria in maquinas.categoria%TYPE,
    n_fechaRevision in maquinas.fechaRevision%TYPE,
    n_estropeada in maquinas.estropeada%TYPE,
    n_fechaActual in maquinas.fechaActual%TYPE
    ) IS
    BEGIN
    insert into maquinas (nombre_maquina, categoria, fechaRevision, estropeada, fechaActual)
    values (n_nombre_maquina, n_categoria, n_fechaRevision, 0, n_fechaActual);
    COMMIT;
    END crear_maquinas;
/

create or replace procedure crear_tecnicos 
    (n_nombre in tecnicos.nombre%TYPE,
    n_telefono in tecnicos.telefono%TYPE,
    n_correo in tecnicos.correo%TYPE
    ) IS
    BEGIN
    insert into tecnicos (nombre, telefono, correo)
    values (n_nombre, n_telefono, n_correo);
    COMMIT;
    END crear_tecnicos;
/

create or replace procedure crear_reparaciones 
    (n_idTecnico in reparaciones.idTecnico%TYPE,
    n_idMaquina in reparaciones.idMaquina%TYPE,
    n_fechaReparacion in reparaciones.fechaReparacion%TYPE
    ) IS
    BEGIN
    insert into reparaciones (idTecnico, idMaquina, fechaReparacion)
    values (n_idTecnico, n_idMaquina, n_fechaReparacion);
    COMMIT;
    END crear_reparaciones;
/

create or replace procedure crear_proveedores 
    (n_nombre_proveedor in proveedores.nombre_proveedor%TYPE,
    n_telefono in proveedores.telefono%TYPE,
    n_correo in proveedores.correo%TYPE
    ) IS
    BEGIN
    insert into proveedores (nombre_proveedor, telefono, correo)
    values (n_nombre_proveedor, n_telefono, n_correo);
    COMMIT;
    END crear_proveedores;
/

create or replace procedure crear_reposiciones 
    (n_fechaReposicion in reposiciones.fechaReposicion%TYPE,
    n_idproveedor in reposiciones.idproveedor%TYPE
    ) IS
    BEGIN
    insert into reposiciones (fechaReposicion, idproveedor)
    values (n_fechaReposicion, n_idproveedor);
    COMMIT;
    END crear_reposiciones;
/

create or replace procedure crear_suplementos 
    (n_nombre in suplementos.nombre%TYPE,
    n_precio in suplementos.precio%TYPE,
    n_stock in suplementos.stock%TYPE
    ) IS
    BEGIN
    insert into suplementos (nombre, precio, stock)
    values (n_nombre, n_precio, n_stock);
    COMMIT;
    END crear_suplementos;
/

create or replace procedure crear_lineaReposicion 
    (n_cantidad in lineaReposicion.cantidad%TYPE,
    n_precio in lineaReposicion.precio_lin%TYPE,
    n_idReposicion in lineaReposicion.idReposicion%TYPE,
    n_idSuplemento in lineaReposicion.idSuplemento%TYPE
    ) IS
    BEGIN
    insert into lineaReposicion (cantidad, precio_lin, idReposicion,idSuplemento)
    values (n_cantidad, n_precio, n_idReposicion,n_idSuplemento);
    COMMIT;
    END crear_lineaReposicion;
/


--Eliminacion procedimientos
CREATE OR REPLACE PROCEDURE eliminar_usuario
    (o_dni IN usuarios.dni%TYPE
    ) IS
    BEGIN
    DELETE FROM usuarios WHERE dni = o_dni;
    COMMIT;
    END eliminar_usuario;
/

CREATE OR REPLACE PROCEDURE eliminar_problemas_medicos
    (o_idUsuario IN usuarios.idUsuario%TYPE,
    o_nombre_problema_medico IN problemas_medicos.nombre_problema_medico%TYPE
    ) IS
    BEGIN
    DELETE FROM problemas_medicos WHERE idUsuario = o_idUsuario AND nombre_problema_medico = o_nombre_problema_medico;
    COMMIT;
    END eliminar_problemas_medicos;
/

CREATE OR REPLACE PROCEDURE eliminar_tarifas
    (o_nombre_tarifa IN tarifas.nombre_tarifa%TYPE
    ) IS
    BEGIN
    DELETE FROM tarifas WHERE nombre_tarifa = o_nombre_tarifa;
    COMMIT;
    END eliminar_tarifas;
/

CREATE OR REPLACE PROCEDURE eliminar_pagos
    (o_idPago IN pagos.idPago%TYPE
    ) IS
    BEGIN
    DELETE FROM pagos WHERE idPago = o_idPago;
    COMMIT;
    END eliminar_pagos;
/

CREATE OR REPLACE PROCEDURE eliminar_maquinas
    (o_idMaquina IN maquinas.idMaquina%TYPE
    ) IS
    BEGIN
    DELETE FROM maquinas WHERE idMaquina = o_idMaquina;
    COMMIT;
    END eliminar_maquinas;
/

CREATE OR REPLACE PROCEDURE eliminar_tecnicos
    (o_idTecnico IN tecnicos.idTecnico%TYPE
    ) IS
    BEGIN
    DELETE FROM tecnicos WHERE idTecnico = o_idTecnico;
    COMMIT;
    END eliminar_tecnicos;
/

CREATE OR REPLACE PROCEDURE eliminar_reparaciones
    (o_idReparacion IN reparaciones.idReparacion%TYPE
    ) IS
    BEGIN
    DELETE FROM reparaciones WHERE idReparacion = o_idReparacion;
    COMMIT;
    END eliminar_reparaciones;
/

CREATE OR REPLACE PROCEDURE eliminar_reposiciones
    (o_idReposicion IN reposiciones.idReposicion%TYPE
    ) IS
    BEGIN
    DELETE FROM reposiciones WHERE idReposicion = o_idReposicion;
    COMMIT;
    END eliminar_reposiciones;
/

CREATE OR REPLACE PROCEDURE eliminar_suplementos
    (o_idSuplemento IN suplementos.idSuplemento%TYPE
    ) IS
    BEGIN
    DELETE FROM suplementos WHERE idSuplemento = o_idSuplemento;
    COMMIT;
    END eliminar_suplementos;
/

CREATE OR REPLACE PROCEDURE eliminar_proveedores
    (o_idProveedor IN proveedores.idProveedor%TYPE
    ) IS
    BEGIN
    DELETE FROM proveedores WHERE idProveedor = o_idProveedor;
    COMMIT;
    END eliminar_proveedores;
/

CREATE OR REPLACE PROCEDURE eliminar_lineaReposicion
    (o_idLineaReposicion IN lineaReposicion.idLineaReposicion%TYPE
    ) IS
    BEGIN
    DELETE FROM lineaReposicion WHERE idLineaReposicion = o_idLineaReposicion;
    COMMIT;
    END eliminar_lineaReposicion;
/
CREATE OR REPLACE PROCEDURE eliminar_mensaje
    (o_idMensaje IN mensajes.idMensaje%TYPE
    ) IS
    BEGIN
    DELETE FROM mensajes WHERE idMensaje = o_idMensaje;
    COMMIT;
    END eliminar_mensaje;
/

--Procesos consultar
create or replace procedure consultar_usuarios
    IS BEGIN
    DECLARE CURSOR c IS
        select * from usuarios;
    BEGIN 
    FOR fila IN c LOOP
            DBMS_OUTPUT.PUT_LINE(fila.idUsuario||' '||fila.nombre||' '||fila.apellido||' '||fila.dni||' '||fila.telefono);
    END LOOP;
END;
END consultar_usuarios;
/

create or replace procedure consultar_problemas_medicos
    IS BEGIN
    DECLARE CURSOR c IS
        select * from problemas_medicos;
    BEGIN 
    FOR fila IN c LOOP
            DBMS_OUTPUT.PUT_LINE(fila.nombre_problema_medico||' '||fila.idUsuario);
    END LOOP;
END;
END consultar_problemas_medicos;
/

create or replace procedure consultar_pagos
    IS BEGIN
    DECLARE CURSOR c IS
        select * from pagos;
    BEGIN 
    FOR fila IN c LOOP
            DBMS_OUTPUT.PUT_LINE(fila.idPago||' '||fila.FechaInicio||' '||fila.idUsuario||' '||fila.nombre_tarifa);
    END LOOP;
END;
END consultar_pagos;
/

create or replace procedure consultar_tarifas
    IS BEGIN
    DECLARE CURSOR c IS
        select * from tarifas;
    BEGIN 
    FOR fila IN c LOOP
            DBMS_OUTPUT.PUT_LINE(fila.nombre_tarifa||' '||fila.precio||' '||fila.duracion_meses);
    END LOOP;
END;
END consultar_tarifas;
/

create or replace procedure consultar_maquinas
    IS BEGIN
    DECLARE CURSOR c IS
        select * from maquinas;
    BEGIN 
    FOR fila IN c LOOP
            DBMS_OUTPUT.PUT_LINE(fila.idMaquina||' '||fila.nombre_maquina||' '||fila.categoria||' '||fila.fechaRevision||' Estropeada: '||fila.estropeada);
    END LOOP;
END;
END consultar_maquinas;
/

create or replace procedure consultar_tecnicos
    IS BEGIN
    DECLARE CURSOR c IS
        select * from tecnicos;
    BEGIN 
    FOR fila IN c LOOP
            DBMS_OUTPUT.PUT_LINE(fila.idTecnico||' '||fila.nombre||' '||fila.telefono||' '||fila.correo);
    END LOOP;
END;
END consultar_tecnicos;
/

create or replace procedure consultar_reparaciones
    IS BEGIN
    DECLARE CURSOR c IS
        select * from reparaciones;
    BEGIN 
    FOR fila IN c LOOP
            DBMS_OUTPUT.PUT_LINE(fila.idReparacion||' '||fila.idTecnico||' '||fila.idMaquina||' '||fila.fechaReparacion);
    END LOOP;
END;
END consultar_reparaciones;
/

create or replace procedure consultar_suplementos
    IS BEGIN
    DECLARE CURSOR c IS
        select * from suplementos;
    BEGIN 
    FOR fila IN c LOOP
            DBMS_OUTPUT.PUT_LINE(fila.idSuplemento||' '||fila.nombre||' '||fila.precio||' '||fila.stock);
    END LOOP;
END;
END consultar_suplementos;
/

create or replace procedure consultar_lineaReposicion
    IS BEGIN
    DECLARE CURSOR c IS
        select * from lineaReposicion;
    BEGIN 
    FOR fila IN c LOOP
            DBMS_OUTPUT.PUT_LINE(fila.idLineaReposicion||' '||fila.cantidad||' '||fila.precio_lin||' '||fila.idReposicion ||' '||fila.idSuplemento||' '||fila.idReposicion||' '||fila.idSuplemento);
    END LOOP;
END;
END consultar_lineaReposicion;
/

create or replace procedure consultar_proveedores
    IS BEGIN
    DECLARE CURSOR c IS
        select * from proveedores;
    BEGIN 
    FOR fila IN c LOOP
            DBMS_OUTPUT.PUT_LINE(fila.idProveedor||' '||fila.nombre_proveedor||' '||fila.telefono||' '||fila.correo);
    END LOOP;
END;
END consultar_proveedores;
/

create or replace procedure consultar_reposiciones
    IS BEGIN
    DECLARE CURSOR c IS
        select * from reposiciones;
    BEGIN 
    FOR fila IN c LOOP
            DBMS_OUTPUT.PUT_LINE(fila.idReposicion||' '||fila.fechaReposicion||' '||fila.idproveedor||' '||fila.idProveedor);
    END LOOP;
END;
END consultar_reposiciones;
/


--Otros Procesos
CREATE OR REPLACE PROCEDURE listado_de_usuarios
    IS BEGIN
    DECLARE CURSOR c IS
        select nombre, dni, nombre_tarifa, nombre_problema_medico, max(FechaInicio) as fechaPago from usuarios natural join pagos natural join tarifas
        natural join problemas_medicos group by nombre, dni, nombre_tarifa, nombre_problema_medico;
    BEGIN 
    FOR fila IN c LOOP
            DBMS_OUTPUT.PUT_LINE(fila.dni||' '||fila.nombre||' '||fila.fechaPago||' '||fila.nombre_tarifa||' '||fila.nombre_problema_medico);
    END LOOP;
END;
END listado_de_usuarios;
/

CREATE OR REPLACE PROCEDURE listado_de_suplementos
    IS BEGIN
    DECLARE CURSOR c IS
        select nombre, precio from suplementos;
    BEGIN 
    FOR fila IN c LOOP
            DBMS_OUTPUT.PUT_LINE(fila.nombre||' '||fila.precio);
    END LOOP;
END;
END listado_de_suplementos;
/
   
CREATE OR REPLACE PROCEDURE listado_de_maquinas
    IS BEGIN
    DECLARE CURSOR c IS
        select idMaquina,nombre_maquina,fechaRevision from maquinas;
    BEGIN 
    FOR fila IN c LOOP
            DBMS_OUTPUT.PUT_LINE(fila.idMaquina||' '||fila.nombre_maquina||' '||fila.fechaRevision);
    END LOOP;
END;
END listado_de_maquinas;
/

CREATE OR REPLACE PROCEDURE listado_de_proveedores
    IS BEGIN
    DECLARE CURSOR c IS
        select nombre_proveedor,idReposicion from proveedores natural join reposiciones;
    BEGIN 
    FOR fila IN c LOOP
            DBMS_OUTPUT.PUT_LINE('El preoveedor '||fila.nombre_proveedor||' ha hecho la siguiente reposicion: '||fila.idReposicion);
    END LOOP;
END;
END listado_de_proveedores;
/

CREATE OR REPLACE PROCEDURE eliminar_aviso
    (o_idAviso IN avisos.idAviso%TYPE
    ) IS
    BEGIN
    DELETE FROM avisos WHERE idaviso = o_idaviso;
    COMMIT;
    END eliminar_aviso;
/

CREATE OR REPLACE PROCEDURE modificar_perfil(o_dni IN usuarios.dni%TYPE,o_telefono IN usuarios.telefono%TYPE,
    o_direccion IN usuarios.direccion%TYPE, o_codigo_postal IN usuarios.codigo_postal%TYPE)
    IS
    BEGIN
    UPDATE usuarios SET  telefono = o_telefono , direccion = o_direccion , codigo_postal = o_codigo_postal where dni = o_dni;
    COMMIT;
    END modificar_perfil;
/
 
CREATE OR REPLACE PROCEDURE modificar_problemas_medicos(o_idusuario IN problemas_medicos.idusuario%TYPE, o_nombre_problema_medico IN problemas_medicos.nombre_problema_medico%TYPE)
    IS
    BEGIN
    UPDATE problemas_medicos SET  nombre_problema_medico = o_nombre_problema_medico  where idusuario = o_idusuario;
    COMMIT;
    END modificar_problemas_medicos;
/

--Funciones
CREATE OR REPLACE FUNCTION Tarifa_usuario(n_dni in usuarios.dni%TYPE)
RETURN VARCHAR2 IS n_nombre_Tarifa tarifas.nombre_tarifa%TYPE;
BEGIN
    SELECT nombre_tarifa into n_nombre_Tarifa from tarifas natural join pagos natural join usuarios 
    where n_dni=dni and fechaInicio >= all (select max(fechaInicio) from tarifas natural join pagos natural join usuarios);
RETURN (n_nombre_Tarifa);
END;
/

CREATE OR REPLACE FUNCTION Usuario_Registrado(n_dni in usuarios.dni%TYPE)
RETURN VARCHAR2 IS reg usuarios.nombre%TYPE;
BEGIN
    select count(*) INTO reg from usuarios where n_dni=dni;
    if(reg=0)
        THEN reg := 'No registrado';
    else reg :='Registrado';
    END IF;
    RETURN (reg);
END;
/

CREATE OR REPLACE FUNCTION Categoria_maquinas(n_categoria in maquinas.categoria%TYPE)
RETURN VARCHAR2 IS reg maquinas.categoria%TYPE;
BEGIN
    select count(*) INTO reg from maquinas where n_categoria=categoria;
    return('Hay '||reg||' maquinas de '||n_categoria);
END;
/

CREATE OR REPLACE FUNCTION Datos_usuarios(n_dni in usuarios.dni%TYPE)
RETURN VARCHAR2 IS 
    usuarioNombre VARCHAR2(20);
    usuarioApellido VARCHAR2(20);
    usuarioDni VARCHAR2(9);
    usuarioTelefono INTEGER;
BEGIN
    select nombre into usuarioNombre from usuarios where n_dni=dni;
    select apellido into usuarioApellido from usuarios where n_dni=dni;
    select dni into usuarioDni from usuarios where n_dni=dni;
    select telefono into usuarioTelefono from usuarios where n_dni=dni;
    return('Nombre: '||usuarioNombre||' Apellido: '||usuarioApellido||' DNI: '||usuarioDni||' Teléfono: '||usuarioTelefono);
END;
/

insert into tarifas values ('Basico', 25, 1);
insert into tarifas values ('Familiar', 50, 1);
insert into tarifas values ('FamiliarAsociado', 0, 1);
insert into tarifas values ('FamiliarExtra', 5, 1);
insert into tarifas values ('Amigo', 20, 1);
insert into tarifas values ('Trimestral', 70, 3);
insert into tarifas values ('Anual', 240, 12);

execute crear_usuario('Admin', 'Admin', '12345678A', 617123456, 'admin@admin.sevengym', to_date('01/01/1980','DD/MM/RR'), 'Avda Parsi 7', 41016, '7Administrador');

