-- Modificaciones sugeridas por el profesor
USE instituto;
ALTER TABLE asignatura DROP CONSTRAINT ck_asignatura_cantidad_ufs;
ALTER TABLE asignatura ADD CONSTRAINT ck_asignatura_cantidad_ufs CHECK (cantidad_ufs >0);
ALTER TABLE alumno AUTO_INCREMENT=101;

#-- INSERTS M02
USE instituto;

#-- familia_formativa
INSERT INTO familia_formativa (nombre) VALUES ('Informatica'),
	('Electricidad'),('Medicina'),('Quimica'),('Condicion Fisica');

#-- ciclos
INSERT INTO ciclo (famfor_id,nombre,jornada) VALUES (1,'Desarrollo web','Mañana'),
	(1,'Desarrollo multiplataforma', 'Mañana'),(3,'Enfermeria','Mañana'), 
    (2,'Electricidad residencial','Mañana'),(4,'Quimica','Mañana'),
    (1,'Desarrollo web','Tarde'),(1,'Desarrollo multiplataforma','Tarde'),
    (2,'Electricidad residencial','Tarde'),(2,'Emfermeria','Tarde'),
    (4,'Quimica','Tarde'),(1,'Redes de datos','Mañana'),
    (2,'Electronica','Mañana'),(3,'Inyectologia','Mañana'),
    (4,'Petroquimica','Mañana'),(5,'Deporte','Mañana'),
    (1,'Redes de datos','Tarde'),(2,'Electronica','Tarde'),
    (3,'Inyectologia','Tarde'),(4,'Petroquimica','Tarde'),(5,'Deporte','Tarde');


#--alumno
INSERT INTO alumno (ciclo_id,delegado_id,dni,nombre,apellidos,email,telefono,ciudad,fecha_nacimiento,edad,codigo_postal,direccion) 
VALUES (1,NULL,'67283901A','Diego','Amador','damador@institut.com',NULL,'Sabadel','1999/07/13',20,'08221','carrer 564'),
		(2,NULL,'84930293J','Dario','Alamos','dalamos@institut.com','611278390','Rubi','1939/05/05',15,'08221',NULL),
		(3,NULL,'37482018U','Daniela','Alvarez','dalvarez@institut.com','621489038','Sabadell','2000/07/23',34,'08224','avinguda 32'),
		(4,NULL,'10293847H','Fernando','Borja','fborja@institut.com','923847102','Sabadell','1999/08/01',16,'08321','paseig 67'),
		(5,NULL,'92810263K','Gloria','Polanco','gpolanco@institut.com','974830293','Martorel',NULL,15,'08221','carrer 43'),
		(6,NULL,'65748392P','Andrea','Puig','apuig@institut.com','938277632',NULL,'200/08/31',15,'08225','paseig 43'),
		(7,107,'33662288N','Clark','Kent',NULL,'674039456','Barcelona',NULL,33,'88221','avinguda 31'),
		(8,NULL,'12345678Z','Benjamin','Roig',NULL,'633892029','Barcelona',NULL,21,'06221',NULL),
		(9,NULL,'87654321X','Monica','Mantilla','mmantilla@gmail.com',NULL,'Martorel',NULL,NULL,'08211','paseig 54'),
		(10,NULL,'46738291Y','Aroa','Jimenez','ajimenez@hotmail.com','922893018','Sant Cugat',NULL,30,'08233','carrer 21'),
		(11,NULL,'67273819B','Marta','Garcia','mgarcia@gmail.com','735284921','Terrassa','1997/03/01',22,'08223','carrer 21'),
		(4,NULL,'75934213C','Joel','Resina','jresina@hotmail.com','645364126','Martorell',NULL,19,'08207','avinguda valles'),
		(6,NULL,'37495731A','Marc','Hernandez','mhernandez@gmail.com','471920362','Sant Cugat','1999/05/31',21,'08232','carrer sicilia'),
		(11,NULL,'83740182Z','Kevin','Lopez','klopez@gmail.com','658347231','Terrassa',NULL,28,'08023','paseig 21'),
		(10,NULL,'54829348X','Manel','Puig','mpuig@hotmail.com','675643891','Terrassa','2004/01/01',32,'08020',NULL),
		(19,NULL,'89374653E','Pedro','Ibañez','pibañez@gmail.com','638462134','Martorell',NULL,31,'08033','carrer 04'),
		(19,NULL,'89456890Z','Ivan','Garcia','igarcia@hotmail.com','678364351','Barcelona','2002/07/01',25,'08033','paseig 71'),
		(3,NULL,'29467345F','Dani','Lopez','dlopez@hotmail.com','694746321','Sant Cugat',NULL,22,'08044','carrer ramon llul'),
        (12,NULL,'74638456P','Nerea','Garcia','ngarcia@gmail.com','645378912','Martorell','2001/07/06',30,'08031','avinguda 89'),
		(5,NULL,'45734571Y','Julian','Ramirez','jramirez@hotmail.com','637463214','Barcelona',NULL,19,'08046',NULL);

#--profesor
INSERT INTO profesor (dni,nombre,apellidos,fecha_nacimiento,email,telefono,edad,codigo_postal,ciudad,direccion,dias_atencion) 
VALUES ('28918402I','Jaime','Morales','1990/09/14','jmorales@institut.com','983728330',26,'08224','Terrassa','carrer San lloreç 102','Lunes'),
		('56748392P','Mercedes','Torres',NULL,'mtorres@institut.com','657483002',45,'09876','Sabadell',NULL,'Martes'),
        ('46767291B','Rosa','Rosales','1985/07/07','rorosales@gmail.com',NULL,33,'07893',NULL,NULL,'Jueves'),
        ('46738291B','Julia','Rosales','1978/12/17',NULL,'611674938',33,'07893','Rubi','Carrer Joan 378','Jueves'),
        ('77893210X','Lina','Castillo','1991/09/30','lcastillo@hotmail.com','999374201',29,'08224',NULL,NULL,'Lunes'),
        ('66359028D','Juan','Bermudez','1977/04/08','jbermudez@gmail.com','999784763',30,NULL,'Ripollet','avinguda 22 juliol','Viernes'),
        ('19380283F','Martin','Murcia',NULL,'mmurcia@gmail.com','632456321',26,'02773','Matadepera','Carrer mola 36','Lunes'),
        ('55463822G','Teresa','Trinidad',NULL,'ttrinidad@hotmail.com','632456322',40,'08224','Barcelona','Diagonal mar 483','Miercoles'),
        ('44326673C','Carla','Costa','1982/02/27',NULL,'897837283',27,'09876','Sabadell','Rambla 478','Viernes'),
		('11092837H','Yaiza','Maneus',NULL,NULL,'674839203',28,'08224','Martorel','Carrer Tulia 47','Viernes'),
        ('56478323A','Jose','Gaviria','1978/08/24','jgaviria@institut.com','932648320',36,'08976','Barcelona','Ronda Ponent 56','Martes'),
		('75846320D','Juan','Morin','1990/01/15','jmorin@institut.com','547728330',29,'08224','Terrassa','carrer San vicen 02','Lunes'),
        ('54620193G','Jaime','Guzman','1980/11/25','jguzman@institut.com',NULL,29,'08223','Rubi','carrer bicentenario 12','Jueves'),
        ('19283740H','Maria','Martinez','1990/01/19','mmartinez@gmail.com',NULL,33,'07836','Manresa',NULL,'Viernes'),
        ('90346218Y','Roberto','Ferrero','1970/06/15','rferrero@institut.com','450028330',45,'08224','Terrassa',NULL,NULL),
        ('87310283F','Xavier','Roig','1980/10/01','xroig@institut.com','903421230',38,'08224','Terrassa',NULL,NULL),
		('12354784l','Monica','Milan','1977/03/20','mmilan@institut.com',NULL,45,NULL,'Ripollet','carrer San vicen 02',NULL),
        ('65748291Z','Aroa','Jimenez','1994/01/15','ajimenez@hotmail.com','564828330',28,'05673','Barcelona',NULL,'Miercoles'),
        ('25846320D','Adrina','Bernal','1985/07/22','abernal@gmail.com','611721345',34,'08222','Terrassa','carrer Can palet 11','Jueves'),
        ('55846320D','Diego','Rios','1994/01/15','drios@institut.com',NULL,28,'07654','Barcelona',NULL,'Martes');
        
#--asignatura
INSERT INTO asignatura (nombre,hora_duracion,cantidad_ufs) VALUES ('Programacion','105',4),
('Base de datos','100',4),('Electrodos','80',2),
('Inyecciones','50',3),('ciclos quimicos','40',1),
('Emprendimiento','70',4),('Calculo','84',3),
('Instalaciones','30',1),('Reanimacion','60',5),
('Fisicoquimica','45',3),('Lenguajes tipados','45',3),
('Materiales','90',4),('Futbol','50',1),
('Equitacion','15',1),('Primeros auxilios','20',2),
('Sistemas fisicos','45',3),('Natacion','20',2),
('Sistemas informaticos','45',4),('Circuitos','40',3),
('Ciclismo','45',3);


#--tutor
INSERT INTO tutor (id_tutor,hora_inicio_atencion,hora_final_atencion) VALUES (3,'13:00:00','14:00:00'),
(2,'11:00:00','12:00:00'),(4,'09:00:00','10:00:00'),(5,'11:00:00','12:00:00'),(9,'08:00:00','09:00:00');


#--asignatura_ciclo
INSERT INTO asignatura_ciclo (id_asignatura,id_ciclo) VALUES (1,1),
(6,6),(2,2),(7,7),(3,3),(8,8),(4,4),(9,9),(5,5),(10,10),(11,11),(12,12),
(13,13),(14,14),(15,15),(16,16),(17,17),(18,18),(19,19),(20,20);


#--asignatura_profesor
INSERT INTO asignatura_profesor (id_asignatura,id_profesor) VALUES (1,1),
(2,1),(3,3),(4,9),(5,7),(6,6),(7,7),(8,8),(9,9),(10,7),
(11,20),(12,19),(13,19),(14,20),(15,11),(16,12),(17,13),(18,14),(19,15),(20,16);

#--acudiente

INSERT INTO acudiente (alumno_id,dni,nombre,apellidos,email,telefono,direccion,fecha_nacimiento,edad,codigo_postal)
VALUES (101,'456372839Y','Marlon','Beltran',NULL,'948392038','Carrer 3893','1970/01/01',45,NULL),
	(102,'65738291T','Jaime','Milan','jmilan@hotmail.com',NULL,'avinguda 378','1975/02/02',34,'08774'),
    (103,'65928302L','Lucia','Chia',NULL,'374829103','paseig 784','1970/03/03',25,NULL),
    (104,'56310293F','German','Pintor','gpintor@gmail.com',NULL,'carrer 894','1950/04/04',45,'09774'),
    (105,'34526172Z','Teresa','Ferrero',NULL,'948271028','avinguda111','1969/05/05',27,NULL),
    (106,'10293847F','Gloria','Polanco','gpolanco@hotmail.com',NULL,'paseig 894','1972/06/06',30,'08974'),
    (107,'71920374L','Raul','Neira',NULL,'638493022','carrer 392','1970/07/07',42,NULL),
    (108,'34251820K','Nicolas','Roig','nroig@gmail.com',NULL,'avinguda 999','1965/08/08',21,'08224'),
    (109,'91028362C','Manel','Puig',NULL,'738291029','paseig 901','1960/09/09',32,NULL),
    (110,'42636201H','Lucio','Querol','lquerol@hotmail.com',NULL,'carrer 623','1975/10/10',65,'08224'),
    (111,'12438043J','Pilar','Guzman',NULL,'6473902018','avinguda 333','1980/11/11',56,NULL),
    (112,'54839201S','Marta','Perez','mperez@gmail.com',NULL,'paseig 664','1990/12/12',46,'08224'),
    (113,'43782019A','Aldo','Raine',NULL,'362739102','carrer 234','1995/01/02',25,NULL),
    (114,'34291827G','Santiago','Hernandez','shernandez@hotmail.com',NULL,'avinguda 773','1998/02/03',34,NULL),
    (115,'78394563L','Juan','Baracaldo',NULL,'847362102','paseig 354','1991/03/04',54,'07445'),
    (116,'28931028G','Martin','Robayo','mrobayo@gmail.com',NULL,'carrer 80','1990/04/05',32,NULL),
    (117,'19203948S','Pedro','Casillas',NULL,'893820182','avinguda 72','1995/05/06',28,'08224'),
    (118,'63820382J','Jose','Pazos','jpazos@hotmail.com',NULL,'paseig 71','1999/06/07',37,NULL),
    (119,'92018374W','Aitor','Jimenez',NULL,'564732910','carrer 91','2000/07/08',58,'04556'),
    (120,'45362819Q','Clara','Pique','cpique@gmail.com','903748291','avinguda 08','1997/08/09',27,NULL);

#-- planta
INSERT INTO planta (nombre,nro_oficinas) VALUES('Galileo',5),('DaVinci',6),('Newton',3),
('Borh',5),('Curie',6);

#-- oficina
INSERT INTO oficina (id_planta,nro_oficina) VALUES (1,101),(2,202),(3,303),
(4,404),(5,505);

#--coordinador
INSERT INTO coordinador (id_coordinador,oficina_id,planta_id,salario) VALUES (7,1,1,2000),
(6,2,2,1500),(9,3,3,1750),(11,4,4,1850),(1,5,5,2050);


#-- SELECTS
USE instituto;

-- punto 1
SELECT id_alumno, email, telefono FROM alumno 
WHERE email IS NULL OR telefono LIKE '6%';

-- punto 2
SELECT id_alumno,nombre,codigo_postal FROM alumno
WHERE nombre LIKE 'D%' AND codigo_postal LIKE '%21';

-- punto 3
SELECT id_alumno, nombre, edad FROM alumno
WHERE edad BETWEEN 15 AND 30;

-- punto 4
SELECT * FROM alumno
WHERE email LIKE '%@%';

-- punto 5
SELECT COUNT(email) AS total_emails, COUNT(edad) AS total_edad FROM alumno
WHERE  email IS NOT NULL AND edad = 15 OR edad = 34;

-- punto 6
SELECT AVG(edad) AS Promedio_edad FROM alumno
WHERE edad > 17;

-- punto 7
SELECT * FROM alumno
WHERE edad >= ((SELECT MAX(edad) FROM alumno)-5);

-- punto 8
SELECT CONCAT(nombre,' ',apellidos) AS nombre_completo, codigo_postal, email FROM alumno
WHERE edad >= 15 AND codigo_postal LIKE '08%' AND LENGTH(email) >= 19 ; 

-- punto 9
SELECT UPPER(ciudad) AS ciudad, codigo_postal FROM alumno
WHERE codigo_postal LIKE '%8%' AND ciudad IS NOT NULL;

-- punto 10
SELECT * FROM alumno
WHERE fecha_nacimiento < CURDATE();

