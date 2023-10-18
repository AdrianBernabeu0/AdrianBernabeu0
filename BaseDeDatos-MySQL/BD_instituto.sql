-- DROP DATABASE instituto;
CREATE DATABASE instituto;
USE instituto;

CREATE TABLE familia_formativa
(id_famfor SMALLINT AUTO_INCREMENT,
nombre VARCHAR(50) NOT NULL,
PRIMARY KEY (id_famfor)
)ENGINE =INNODB;


CREATE TABLE ciclo
(id_ciclo SMALLINT AUTO_INCREMENT,
famfor_id SMALLINT NOT NULL,
nombre VARCHAR(30) NOT NULL,
jornada ENUM('Mañana','Tarde') NOT NULL,
PRIMARY KEY (id_ciclo),
CONSTRAINT fk_ciclo_familia_formativa FOREIGN KEY (famfor_id) REFERENCES familia_formativa(id_famfor),
CONSTRAINT uk_ciclo_nombre_jornada UNIQUE( nombre,jornada)
)ENGINE=INNODB;

CREATE TABLE alumno
(id_alumno SMALLINT AUTO_INCREMENT,
ciclo_id SMALLINT,
delegado_id SMALLINT,
dni VARCHAR(10) NOT NULL,
nombre VARCHAR(15) NOT NULL,
apellidos VARCHAR(25) NOT NULL,
email VARCHAR(30),
telefono VARCHAR (10),
ciudad VARCHAR (15) DEFAULT 'Terrassa',
fecha_nacimiento DATE,
edad TINYINT(2),
codigo_postal VARCHAR(5),
direccion VARCHAR(30),
PRIMARY KEY (id_alumno),
CONSTRAINT fk_alumno_ciclo_id FOREIGN KEY(ciclo_id) REFERENCES ciclo(id_ciclo),
CONSTRAINT fk_alumno_delegado_id FOREIGN KEY(delegado_id) REFERENCES alumno(id_alumno),
CONSTRAINT ck_alumno_edad CHECK (edad>=15),
CONSTRAINT uk_alumno_dni UNIQUE( dni )
)ENGINE=INNODB;

CREATE INDEX ix_alumno ON alumno (dni,nombre,apellidos);

CREATE TABLE profesor
(id_profesor SMALLINT AUTO_INCREMENT,
dni VARCHAR(10) NOT NULL,
nombre VARCHAR(15) NOT NULL,
apellidos VARCHAR(25) NOT NULL,
fecha_nacimiento DATE,
email VARCHAR(30),
telefono VARCHAR(10),
edad TINYINT(2),
codigo_postal VARCHAR(5),
ciudad VARCHAR (15) DEFAULT 'Terrassa',
direccion VARCHAR(30),
dias_atencion ENUM('Lunes','Martes','Miercoles','Jueves','Viernes'),
PRIMARY KEY (id_profesor),
CONSTRAINT ck_profesor_edad CHECK (edad>=25),
CONSTRAINT uk_profesor_dni UNIQUE( dni )
)ENGINE=INNODB;

ALTER TABLE profesor ADD INDEX ix_profesor (dni,nombre,apellidos);

CREATE TABLE asignatura
(id_asignatura SMALLINT AUTO_INCREMENT,
nombre VARCHAR (40) NOT NULL,
hora_duracion VARCHAR(5),
cantidad_ufs TINYINT(1),
PRIMARY KEY (id_asignatura),
CONSTRAINT ck_asignatura_cantidad_ufs CHECK (cantidad_ufs !=0)
)ENGINE=INNODB;


CREATE TABLE asignatura_ciclo
(id_asignatura SMALLINT,
id_ciclo SMALLINT,
PRIMARY KEY (id_asignatura,id_ciclo),
CONSTRAINT fk_asignatura_ciclo_asignatura FOREIGN KEY(id_asignatura) REFERENCES asignatura(id_asignatura),
CONSTRAINT fk_asignatura_ciclo_ciclo FOREIGN KEY(id_ciclo) REFERENCES ciclo(id_ciclo)
)ENGINE=INNODB;

CREATE TABLE asignatura_profesor
(id_asignatura  SMALLINT,
id_profesor SMALLINT,
PRIMARY KEY (id_asignatura,id_profesor),
CONSTRAINT fk_asignatura_profesor_asignatura FOREIGN KEY(id_asignatura) REFERENCES asignatura(id_asignatura),
CONSTRAINT fk_asignatura_profesor_profesor FOREIGN KEY(id_profesor) REFERENCES profesor(id_profesor)
)ENGINE=INNODB;

CREATE TABLE tutor
(id_tutor SMALLINT AUTO_INCREMENT,
hora_inicio_atencion TIME NOT NULL,
hora_final_atencion TIME NULL,
PRIMARY KEY(id_tutor),
CONSTRAINT fk_tutor_profesor FOREIGN KEY (id_tutor) REFERENCES profesor(id_profesor),
CONSTRAINT ck_tuto_hora_final_atencion CHECK(hora_final_atencion > hora_inicio_atencion)
)ENGINE=INNODB;


CREATE TABLE acudiente
(id_acudiente SMALLINT AUTO_INCREMENT,
alumno_id SMALLINT NOT NULL,
dni VARCHAR(10) NOT NULL,
nombre VARCHAR(15) NOT NULL,
apellidos VARCHAR(25) NOT NULL,
email VARCHAR(30),
telefono VARCHAR (10),
ciudad VARCHAR (15) DEFAULT 'Terrassa',
direccion VARCHAR (30),
fecha_nacimiento DATE,
edad TINYINT(2),
codigo_postal VARCHAR(5),
PRIMARY KEY(id_acudiente),
CONSTRAINT fk_acudiente_alumno FOREIGN KEY (alumno_id) REFERENCES alumno (id_alumno)
)ENGINE=INNODB;

CREATE TABLE planta
(id_planta SMALLINT AUTO_INCREMENT,
nombre VARCHAR(15) NOT NULL,
nro_oficinas SMALLINT(4),
PRIMARY KEY (id_planta)
)ENGINE=INNODB;

CREATE TABLE oficina
(id_oficina SMALLINT AUTO_INCREMENT,
id_planta SMALLINT,
nro_oficina SMALLINT(3)NOT NULL,
PRIMARY KEY (id_oficina, id_planta),
CONSTRAINT fk_oficina_planta FOREIGN KEY (id_planta) REFERENCES planta(id_planta)
)ENGINE=INNODB;

CREATE TABLE coordinador
(id_coordinador SMALLINT AUTO_INCREMENT,
oficina_id SMALLINT,
planta_id SMALLINT,
salario INT(4) NOT NULL DEFAULT 1000,
PRIMARY KEY(id_coordinador),
CONSTRAINT fk_coordinador_profesor FOREIGN KEY (id_coordinador) REFERENCES profesor(id_profesor),
CONSTRAINT fk_coordinador_oficina FOREIGN KEY (oficina_id,planta_id) REFERENCES oficina(id_oficina,id_planta),
CONSTRAINT ck_coordinador_salario CHECK(salario>0)
)ENGINE=INNODB;

CREATE INDEX ix_coordinador ON coordinador (salario);


    
