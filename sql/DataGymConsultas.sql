--Valores de Prueba

--A�adir valores a tablas
--insert into tarifas values ('Basico', 25, 1);
--insert into tarifas values ('Familiar', 50, 1);
--insert into tarifas values ('FamiliarAsociado', 0, 1);
--insert into tarifas values ('FamiliarExtra', 5, 1);
--insert into tarifas values ('Amigo', 20, 1);
--insert into tarifas values ('Trimestral', 70, 3);
--insert into tarifas values ('Anual', 240, 12);

--execute crear_usuario('David', 'Brincau', '56874521L', 789654123, 'daviiprobeticoo55@gmail.com', to_date('24/08/2000','DD/MM/RR'), 'Calle Vedra 1', 41016, 'Victor3LaMamaUUUU');
--execute crear_problemas_medicos ('asma', 3);
    
execute crear_pagos (to_date('01/08/2019','DD/MM/RR'), to_date('01/09/2019','DD/MM/RR'), 2, 'Basico');
    
execute crear_pagos (to_date('12/10/2019','DD/MM/RR'), to_date('12/11/2019','DD/MM/RR'), 2, 'Basico');

execute crear_usuario('Pepe', 'Garcia', '56874528L', 789654156, 'p.gracia@alum.us.es', to_date('23/09/2001','DD/MM/RR'), null, null, 'xX_PepeGar48_Xx');
--execute crear_problemas_medicos  ('asma', 2);
execute crear_problemas_medicos  ('parkinson, asma', 3);

execute crear_pagos (to_date('01/08/2019','DD/MM/RR'), to_date('01/09/2019','DD/MM/RR'), 3, 'Basico');

execute crear_proveedores ('pao', 354268769, 'pao@gmail.com');
execute crear_reposiciones (to_date('07/07/2019','DD/MM/RR'), 1);
    
execute crear_proveedores ('juanluis', 354268759, 'juanluis@gmail.com');
execute crear_reposiciones (to_date('01/08/2019','DD/MM/RR'), 2);
execute crear_reposiciones  (to_date('29/08/2019','DD/MM/RR'), 2);

execute crear_suplementos ('barrita energ�tica', '0,5', 5);
    
execute crear_lineaReposicion (2, '0,4', 1, 1);
execute crear_lineaReposicion (2, '0,3', 2, 1);
execute crear_lineaReposicion (2, '0,3', 3, 1);
execute crear_lineaReposicion (2, '0,3', 3, 1);
 
execute crear_maquinas ('Cinta de correr', 'Cardio', to_date('05/01/2020','DD/MM/RR'), 0, SYSDATE);
execute crear_maquinas ('Cinta de correr', 'Cardio', to_date('23/01/2020','DD/MM/RR'), 0, SYSDATE);
execute crear_tecnicos ('Juan', 689523547, 'juanSeven@yahoo.es');
execute crear_tecnicos ('Pepe', 759523547, 'pepSeven@yahoo.es');
execute crear_reparaciones (1, 1, to_date('17/09/2017','DD/MM/RR'));
execute crear_reparaciones (2, 2, to_date('06/12/2019','DD/MM/RR'));

--Cursores
DECLARE CURSOR obtener_maximo IS 
    select idUsuario, nombre, apellido, sum (precio) from usuarios natural join pagos natural join tarifas 
    group by idUsuario, nombre, apellido having sum (precio) >= all (select sum (precio) from usuarios 
    natural join pagos natural join tarifas group by idUsuario);
BEGIN 
    DBMS_OUTPUT.PUT_LINE('El usuario que m�s ha pagado en Tarifas es: ');
    FOR fila IN obtener_maximo LOOP
            DBMS_OUTPUT.PUT_LINE(fila.nombre||' '||fila.apellido);
    END LOOP;
END;
/

DECLARE CURSOR stock_restantes IS 
    select nombre, stock from suplementos;
BEGIN 
    FOR fila IN stock_restantes LOOP
            DBMS_OUTPUT.PUT_LINE('Quedan '||fila.stock||' de '||fila.nombre);
    END LOOP;
END;
/

DECLARE CURSOR fecha_reposiciones IS 
    select nombre, fechaReposicion from suplementos natural join lineaReposicion natural join reposiciones;
BEGIN 
    FOR fila IN fecha_reposiciones LOOP
            DBMS_OUTPUT.PUT_LINE('Fecha de Reposici�n: '||fila.fechaReposicion||'  Producto: '||fila.nombre);
    END LOOP;
END;
/

DECLARE CURSOR siguiente_revision_maquina IS 
    select idMaquina, nombre_maquina, fechaRevision from maquinas;
BEGIN 
    FOR fila IN siguiente_revision_maquina LOOP
            DBMS_OUTPUT.PUT_LINE('Fecha de Revisi�n: '||fila.fechaRevision||'  M�quina: '||fila.idMaquina||' '||fila.nombre_maquina);
    END LOOP;
END;
/

DECLARE CURSOR siguiente_revision_maquina IS 
    select idMaquina, nombre_maquina, fechaRevision from maquinas 
    where fechaRevision = all (select min(fechaRevision) from maquinas);
BEGIN 
    FOR fila IN siguiente_revision_maquina LOOP
            DBMS_OUTPUT.PUT_LINE('Siguiente m�quina a revisar: '||fila.nombre_maquina||' con fecha de '||fila.fechaRevision);
    END LOOP;
END;
/

DECLARE CURSOR revisadas_por_tecnico IS 
    select idMaquina, nombre_maquina, nombre from maquinas natural join reparaciones natural join tecnicos;
BEGIN 
    FOR fila IN revisadas_por_tecnico LOOP
            DBMS_OUTPUT.PUT_LINE(fila.nombre||' ha reparado la m�quina '||fila.idMaquina);
    END LOOP;
END;
/

DECLARE CURSOR dinero_Invertido IS 
    select nombre, sum(precio_lin) as suma_precio from suplementos natural join lineaReposicion group by nombre;
BEGIN 
    FOR fila IN dinero_Invertido LOOP
            DBMS_OUTPUT.PUT_LINE('En el producto '||fila.nombre||' se ha gastado '||fila.suma_precio||'�');
    END LOOP;
END;
/

DECLARE CURSOR enfermedad_comun IS 
    select nombre_problema_medico, count(*) from problemas_medicos group by nombre_problema_medico 
    having count(*) >= all (select count(*) from problemas_medicos group by nombre_problema_medico);
BEGIN 
    FOR fila IN enfermedad_comun LOOP
            DBMS_OUTPUT.PUT_LINE('La enfermedad m�s com�n es '||fila.nombre_problema_medico);
    END LOOP;
END;
/

DECLARE CURSOR ultima_reposicion IS 
    select nombre_proveedor, fechaReposicion from proveedores natural join reposiciones 
    where fechaReposicion = all (select max(fechaReposicion) from reposiciones);
BEGIN 
    FOR fila IN ultima_reposicion LOOP
            DBMS_OUTPUT.PUT_LINE('La �lima reposici�n fu� de '||fila.nombre_proveedor||' el '||fila.fechaReposicion);
    END LOOP;
END;
/

DECLARE CURSOR proveedor_m�s_reposiciones IS 
    select nombre_proveedor, telefono from proveedores natural join reposiciones 
    group by nombre_proveedor, telefono having count(*) >= all (select count(*) from proveedores natural join reposiciones 
    group by nombre_proveedor, telefono);
BEGIN 
    FOR fila IN proveedor_m�s_reposiciones LOOP
            DBMS_OUTPUT.PUT_LINE('El proveedor m�s solicitado es '||fila.nombre_proveedor||' y su tel�fono '||fila.telefono);
    END LOOP;
END;
/

DECLARE CURSOR proveedor_m�s_caro IS 
    select nombre, nombre_proveedor, precio_lin from proveedores natural join suplementos natural join reposiciones 
    natural join lineaReposicion group by nombre, nombre_proveedor, precio_lin having precio_lin >= all (select max(precio_lin) from proveedores 
    natural join reposiciones natural join lineaReposicion group by nombre, nombre_proveedor, precio_lin);
BEGIN 
    FOR fila IN proveedor_m�s_caro LOOP
            DBMS_OUTPUT.PUT_LINE('El proveedor m�s caro para '||fila.nombre||' es '||fila.nombre_proveedor||' con un precio de '||fila.precio_lin);
    END LOOP;
END;
/


--Lista de Consultas
--Usuario m�s ha pagado en Tarifas
select idUsuario, nombre, apellido, sum (precio) from usuarios natural join pagos natural join tarifas 
group by idUsuario, nombre, apellido having sum (precio) >= all (select sum (precio) from usuarios 
natural join pagos natural join tarifas group by idUsuario);
--Suplementos restantes
select nombre, stock from suplementos;
--Fechas las reposiciones de los suplementos
select nombre, fechaReposicion from suplementos natural join lineaReposicion natural join reposiciones;
--Siguiente revisi�n de cada m�quina
select idMaquina, nombre_maquina, fechaRevision from maquinas;
--M�quina con revisi�n m�s pr�xima
select idMaquina, nombre_maquina, fechaRevision from maquinas 
where fechaRevision = all (select min(fechaRevision) from maquinas);
--Qu� m�quina repara cada t�cnico
select idMaquina, nombre_maquina, nombre from maquinas natural join reparaciones natural join tecnicos;
--Dinero Invertido en cada producto
select nombre, sum(precio_lin) from suplementos natural join lineaReposicion group by nombre;
--Problema m�dico m�s com�n
select nombre_problema_medico, count(*) from problemas_medicos group by nombre_problema_medico 
having count(*) >= all (select count(*) from problemas_medicos group by nombre_problema_medico);
--�ltima reposici�n
select nombre_proveedor, fechaReposicion from proveedores natural join reposiciones 
where fechaReposicion = all (select max(fechaReposicion) from reposiciones);
--Proveedor con m�s reposiciones hechas
select nombre_proveedor, telefono from proveedores natural join reposiciones 
group by nombre_proveedor, telefono having count(*) >= all (select count(*) from proveedores natural join reposiciones 
group by nombre_proveedor, telefono);
--Proveedor m�s caro por producto
select nombre, nombre_proveedor, precio_lin from proveedores natural join suplementos natural join reposiciones 
natural join lineaReposicion group by nombre, nombre_proveedor, precio_lin having precio_lin >= all (select max(precio_lin) from proveedores 
natural join reposiciones natural join lineaReposicion group by nombre, nombre_proveedor, precio_lin);

execute crear_mensaje('David', 'daviiprobeticoo55@gmail.com', 'Esto es un mensaje de pureba');
--Probar FUNCIONES
BEGIN
    DBMS_OUTPUT.PUT_LINE('El usuario con dni: 29506399K; tiene la tarifa: '||Tarifa_usuario('29506399K'));
    DBMS_OUTPUT.PUT_LINE('Usuario con dni: 56874521L '||Usuario_registrado('29506399K'));
    DBMS_OUTPUT.PUT_LINE(Categoria_maquinas('Cardio'));
    DBMS_OUTPUT.PUT_LINE(Datos_Usuarios('29506399K'));
END;
/