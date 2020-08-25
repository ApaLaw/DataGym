execute crear_maquinas ('Cinta de correr', 'Cardio', to_date('05/01/2021','DD/MM/RR'), 0, SYSDATE);
execute crear_maquinas ('Cinta de correr', 'Cardio', to_date('23/09/2020','DD/MM/RR'), 0, SYSDATE);
execute crear_maquinas ('Cinta de correr', 'Cardio', to_date('24/06/2021','DD/MM/RR'), 0, SYSDATE);
execute crear_maquinas ('Cinta de correr', 'Cardio', to_date('23/07/2020','DD/MM/RR'), 0, SYSDATE);
execute crear_maquinas ('Cinta de correr', 'Cardio', to_date('25/07/2020','DD/MM/RR'), 0, SYSDATE);


execute crear_maquinas ('Multi-Power', 'Tren Superior', to_date('01/03/2021','DD/MM/RR'), 0, SYSDATE);


execute crear_maquinas ('Press Banca', 'Tren Superior', to_date('22/04/2021','DD/MM/RR'), 0, SYSDATE);
execute crear_maquinas ('Press Banca', 'Tren Superior', to_date('07/08/2020','DD/MM/RR'), 0, SYSDATE);
execute crear_maquinas ('Press Banca', 'Tren Superior', to_date('13/08/2020','DD/MM/RR'), 0, SYSDATE);


execute crear_maquinas ('Prensa', 'Tren Inferior', to_date('05/06/2020','DD/MM/RR'), 0, SYSDATE);


execute crear_maquinas ('Remo', 'Tren Superior', to_date('07/01/2021','DD/MM/RR'), 0, SYSDATE);
execute crear_maquinas ('Remo', 'Tren Superior', to_date('12/10/2020','DD/MM/RR'), 0, SYSDATE);


execute crear_maquinas ('Bicicleta Estática', 'Cardio', to_date('05/02/2021','DD/MM/RR'), 0, SYSDATE);
execute crear_maquinas ('Bicicleta Estática', 'Cardio', to_date('23/10/2020','DD/MM/RR'), 0, SYSDATE);
execute crear_maquinas ('Bicicleta Estática', 'Cardio', to_date('24/07/2021','DD/MM/RR'), 0, SYSDATE);
execute crear_maquinas ('Bicicleta Estática', 'Cardio', to_date('23/08/2020','DD/MM/RR'), 0, SYSDATE);
execute crear_maquinas ('Bicicleta Estática', 'Cardio', to_date('25/08/2022','DD/MM/RR'), 0, SYSDATE);
execute crear_maquinas ('Bicicleta Estática', 'Cardio', to_date('25/09/2021','DD/MM/RR'), 0, SYSDATE);




execute crear_tecnicos ('Marina', 685511424, 'marinas_repair@hotmail.es');
execute crear_tecnicos ('Manuel', 356952687, 'manuelsm@gmail.com');
execute crear_tecnicos ('Juan', 689523547, 'juanSeven@gmail.com');
execute crear_tecnicos ('Pepe', 759523547, 'pepe32@yahoo.es');




execute crear_reparaciones (1, 1, to_date('05/01/2020','DD/MM/RR'));
execute crear_reparaciones (2, 2, to_date('23/09/2019','DD/MM/RR'));
execute crear_reparaciones (3, 3, to_date('24/06/2019','DD/MM/RR'));
execute crear_reparaciones (4, 4, to_date('23/07/2019','DD/MM/RR'));
execute crear_reparaciones (3, 5, to_date('25/07/2019','DD/MM/RR'));
execute crear_reparaciones (2, 6, to_date('01/03/2020','DD/MM/RR'));
execute crear_reparaciones (1, 7, to_date('22/04/2020','DD/MM/RR'));
execute crear_reparaciones (4, 8, to_date('07/08/2019','DD/MM/RR'));
execute crear_reparaciones (4, 9, to_date('13/08/2019','DD/MM/RR'));
execute crear_reparaciones (3, 10, to_date('05/06/2019','DD/MM/RR'));
execute crear_reparaciones (1, 11, to_date('07/01/2018','DD/MM/RR'));
execute crear_reparaciones (2, 12, to_date('12/10/2019','DD/MM/RR'));
execute crear_reparaciones (4, 13, to_date('05/02/2018','DD/MM/RR'));
execute crear_reparaciones (3, 14, to_date('23/10/2019','DD/MM/RR'));
execute crear_reparaciones (2, 15, to_date('24/07/2018','DD/MM/RR'));
execute crear_reparaciones (1, 16, to_date('23/08/2019','DD/MM/RR'));
execute crear_reparaciones (4, 17, to_date('25/08/2021','DD/MM/RR'));
execute crear_reparaciones (4, 18, to_date('25/09/2018','DD/MM/RR'));




execute crear_mensaje('Victor','victor@gmail.com','Buena página!');
execute crear_mensaje('Manuel','manuel@gmail.com','Buen gimnasio');
execute crear_mensaje('Jesús','jesus@gmail.com','Excelente trato');
execute crear_mensaje('David','david@gmail.com','Maquinas ideales');
execute crear_mensaje('Paco','paco@gmail.com','El mejor gimnasio de Sevilla');
execute crear_mensaje('Mercedes','mercedes@gmail.com','Trato Excelente');
execute crear_mensaje('Beatriz','beatriz@gmail.com','Las mejores maquinas');
execute crear_mensaje('Jose Luis','joseluis@gmail.com','Muy agradable el lugar');
execute crear_mensaje('Miguel','miguel@gmail.com','Todo en perfecto estado');
execute crear_mensaje('Isabel','isabel@gmail.com','Me encanta el gimnasio');




execute crear_proveedores ('pao', 354268769, 'pao@gmail.com');
execute crear_proveedores ('jorge', 354798759, 'jorge@gmail.com');  
execute crear_proveedores ('juanluis', 354268759, 'juanluis@gmail.com');




execute crear_reposiciones (to_date('07/07/2019','DD/MM/RR'), 1);
execute crear_reposiciones (to_date('01/08/2019','DD/MM/RR'), 2);
execute crear_reposiciones  (to_date('28/07/2019','DD/MM/RR'), 2);
execute crear_reposiciones  (to_date('29/08/2019','DD/MM/RR'), 2);
execute crear_reposiciones  (to_date('28/07/2020','DD/MM/RR'), 2);
execute crear_reposiciones  (to_date('28/08/2020','DD/MM/RR'), 1);
execute crear_reposiciones  (to_date('28/09/2020','DD/MM/RR'), 3);
execute crear_reposiciones  (to_date('28/10/2020','DD/MM/RR'), 3);

execute crear_suplementos ('Barrita energética', '1,80', 5);
execute crear_suplementos ('Powerade', '1,20', 5);
execute crear_suplementos ('Camiseta DataGym', '9,98', 5);
execute crear_suplementos ('Proteinas 2Kg', '24,99', 5);
execute crear_suplementos ('Guantes deportivos', '7,99', 5);
execute crear_suplementos ('Aquarius de Naranja', '1,20', 5);

execute crear_lineaReposicion (30, '0,4', 1, 1);
execute crear_lineaReposicion (10, '10,5', 2, 4);
execute crear_lineaReposicion (20, '0,7', 1, 2);
execute crear_lineaReposicion (20, '0,7', 1, 6);
execute crear_lineaReposicion (10, '5,5', 3, 3);
execute crear_lineaReposicion (10, '3,5', 3, 5);
execute crear_lineaReposicion (30, '0,5', 4, 6);
execute crear_lineaReposicion (20, '0,5', 4, 2);
execute crear_lineaReposicion (30, '0,3', 4, 1);
execute crear_lineaReposicion (15, '5,0', 5, 3);
execute crear_lineaReposicion (15, '3,0', 5, 5);
execute crear_lineaReposicion (10, '5,0', 6, 3);
execute crear_lineaReposicion (10, '3,0', 6, 5);
execute crear_lineaReposicion (20, '10,0', 7, 4);
execute crear_lineaReposicion (30, '0,5', 8, 6);
execute crear_lineaReposicion (20, '0,5', 8, 2);
execute crear_lineaReposicion (30, '0,3', 8, 1);




execute crear_usuario('David', 'Brincau', '29506399K', 678623620, 'daviiprobeticoo55@gmail.com', to_date('24/08/2000','DD/MM/RR'), 'Calle Vedra 1', 41016, '3000Toneladas');
execute crear_usuario('Jesús', 'Aparicio', '29540830K', 654256325, 'jesusaparicoortiz4@gmail.com', to_date('16/02/2000','DD/MM/RR'), 'Calle Baltasar de Alcazar', 41008, 'Arrucutua18');
execute crear_usuario('Manuel', 'Muñoz', '77849001G', 645827956, 'manmunes1@gmail.com', to_date('05/11/2000','DD/MM/RR'), 'Calle Tarsis', 41008, 'Vivaerbeti5');
execute crear_usuario('Victor', 'Granero', '77874111K', 657481235, 'victorgran@gmail.com', to_date('23/06/2000','DD/MM/RR'), 'Calle Manuel del valle', 41008, 'vivaermaincra777');
execute crear_usuario('Paco', 'Rodriguez', '65425163K', 602154635, 'pacolemon@gmail.com', to_date('14/08/2000','DD/MM/RR'), 'Calle Odisea', 41255, '25Clembu');
execute crear_usuario('Alejandro', 'Barranco', '65483623L', 605463215, 'barranco@gmail.com', to_date('24/05/1995','DD/MM/RR'), 'Calle de las ciencias', 41006, 'IloveJarvis5');




execute crear_problemas_medicos('asma, soplo', 2);
execute crear_problemas_medicos('anorexia', 3);
execute crear_problemas_medicos('miopia', 4);
execute crear_problemas_medicos('asma', 5);
execute crear_problemas_medicos('ninguno', 6);
execute crear_problemas_medicos('epilepsia', 7);


execute crear_pagos (to_date('19/03/2020','DD/MM/RR'), to_date('18/04/2020','DD/MM/RR'), 2, 'Basico');
execute crear_pagos (to_date('19/04/2020','DD/MM/RR'), to_date('18/05/2020','DD/MM/RR'), 2, 'Basico');
execute crear_pagos (to_date('19/05/2020','DD/MM/RR'), to_date('18/06/2020','DD/MM/RR'), 2, 'Amigo');

execute crear_pagos (to_date('19/05/2020','DD/MM/RR'), to_date('18/06/2020','DD/MM/RR'), 5, 'Amigo');

execute crear_pagos (to_date('06/09/2019','DD/MM/RR'), to_date('07/10/2019','DD/MM/RR'), 6, 'Familiar');
execute crear_pagos (to_date('06/10/2019','DD/MM/RR'), to_date('07/11/2019','DD/MM/RR'), 6, 'Familiar');

execute crear_pagos (to_date('06/09/2019','DD/MM/RR'), to_date('07/10/2019','DD/MM/RR'), 7, 'FamiliarAsociado');
execute crear_pagos (to_date('06/10/2019','DD/MM/RR'), to_date('07/11/2019','DD/MM/RR'), 7, 'FamiliarAsociado');

execute crear_pagos (to_date('13/08/2019','DD/MM/RR'), to_date('12/09/2019','DD/MM/RR'), 4, 'Basico');
execute crear_pagos (to_date('13/10/2019','DD/MM/RR'), to_date('12/10/2020','DD/MM/RR'), 4, 'Anual');
execute crear_pagos (to_date('13/10/2020','DD/MM/RR'), to_date('12/01/2021','DD/MM/RR'), 4, 'Trimestral');

execute crear_pagos (to_date('13/08/2019','DD/MM/RR'), to_date('12/09/2019','DD/MM/RR'), 3, 'Basico');
execute crear_pagos (to_date('13/10/2019','DD/MM/RR'), to_date('12/11/2019','DD/MM/RR'), 3, 'Basico');
execute crear_pagos (to_date('13/11/2019','DD/MM/RR'), to_date('12/02/2021','DD/MM/RR'), 3, 'Trimestral');