USE instituto;

-- IF

/*1. Buscar nombre,apellidos y telefono de los acudientes según el nombre o DNI del alumno, 
para casos de emergencia. */
DELIMITER //
CREATE PROCEDURE buscarAcudientes(OUT pError VARCHAR (30),IN nomAlumno VARCHAR(15), IN dniAlumno VARCHAR(10))
BEGIN
	IF(nomAlumno IS NOT NULL AND dniAlumno IS NOT NULL)THEN
		SELECT ac.nombre, ac.apellidos, ac.telefono
		FROM acudiente AS ac
			INNER JOIN alumno AS a ON a.id_alumno = ac.alumno_id
		WHERE a.nombre = nomAlumno AND a.dni = dniAlumno;
	ELSEIF (nomAlumno IS NULL AND dniAlumno IS NOT NULL)THEN
		SELECT ac.nombre, ac.apellidos, ac.telefono
		FROM acudiente AS ac
			INNER JOIN alumno AS a ON a.id_alumno = ac.alumno_id
		WHERE a.dni = dniAlumno;
	ELSE 
		SET pError = 'Acudiente no encontrado'; 
        SELECT pError;
	END IF;
END //
DELIMITER ;
SELECT * FROM ALUMNO;
CALL buscarAcudientes(@mensaje,'joel','75934213C');
CALL buscarAcudientes(@mensaje,NULL,'10293847H');
CALL buscarAcudientes(@mensaje,NULL,NULL);
-- DROP PROCEDURE buscarAcudientes;


/*2. insertar, actualizar o mostrar datos de la tabla "familia_formativa según el parametro ingresado*/
DELIMITER //
CREATE PROCEDURE crudFamiliaFormativa(IN accion VARCHAR(12),IN nomFamFornou VARCHAR(50), IN nomFamFor VARCHAR(50))
BEGIN
		DECLARE lid_famfor SMALLINT(6);
        
	IF(accion='insertar' AND nomFamFornou IS NOT NULL)THEN
		INSERT INTO familia_formativa (nombre) VALUES (nomFamFornou);
        SET lid_famfor = LAST_INSERT_ID();
        INSERT INTO familia_formativa (id_famfor) VALUES (lid_famfor);
	ELSEIF(accion='actualizar' AND nomFamFor IS NOT NULL AND nomFamFornou IS NOT NULL)THEN
		UPDATE familia_formativa
        SET nombre = nomFamFornou
        WHERE nombre = nomFamFor;
	ELSE 
		SELECT id_famfor, nombre
        FROM familia_formativa;
	END IF;
END //
DELIMITER ;
CALL crudFamiliaFormativa('insertar','Mecanica Automotriz',NULL);
CALL crudFamiliaFormativa('actualizar','Mecanica Maritima','Mecanica Automotriz');
CALL crudFamiliaFormativa(NULL,NULL,NULL);


-- 3. Poner el dia de atencion y el profesor que tenga el mismo dia que salga el nombre y el apellido
DROP PROCEDURE IF EXISTS buscarProfesor;
DELIMITER //
CREATE PROCEDURE buscarProfesor(IN diaAtencion VARCHAR(15),OUT diasError VARCHAR(20))
BEGIN
	IF(diaAtencion="Lunes")THEN
		SELECT nombre,apellidos
			FROM profesor
            WHERE dias_atencion="Lunes";
	ELSEIF (diaAtencion="Martes")THEN
				SELECT nombre,apellidos
			FROM profesor
            WHERE dias_atencion="Martes";
	ELSEIF (diaAtencion="Miercoles")THEN
    		SELECT nombre,apellidos
			FROM profesor
            WHERE dias_atencion="Miercoles";
    ELSEIF (diaAtencion="Jueves")THEN
				SELECT nombre,apellidos
			FROM profesor
            WHERE dias_atencion="Jueves";
    ELSEIF (diaAtencion="Viernes")THEN
    		SELECT nombre,apellidos
			FROM profesor
            WHERE dias_atencion="Viernes";
	ELSE 
			SET @diasError= 'Ningun profesor coincide';
            SELECT @diasError;
	END IF;
END //
DELIMITER ;
CALL buscarProfesor("Martes",@diasError);
CALL buscarProfesor("Jueves",@diasError);
CALL buscarProfesor("Sabado",@diasError);


-- 4. Procedimiento para buscar alumnos por el nombre o el apellido y que muestre toda su informacio, si los dos estan en blanco entonces mostrara todos los alumnos 
DROP PROCEDURE IF EXISTS buscarAlumno;
DELIMITER //
CREATE PROCEDURE buscarAlumno(IN alNombre VARCHAR(15), IN alApellido VARCHAR(25))
BEGIN
	IF(alNombre IS NOT NULL AND alApellido IS NULL)THEN
		SELECT id_alumno,ciclo_id,delegado_id,dni,nombre,apellidos,email,
				telefono,ciudad,fecha_nacimiento,edad,codigo_postal,direccion
			FROM alumno
            WHERE alNombre=nombre;
	ELSEIF(alNombre IS NULL AND alApellido IS NOT NULL)THEN
		SELECT id_alumno,ciclo_id,delegado_id,dni,nombre,apellidos,email,
				telefono,ciudad,fecha_nacimiento,edad,codigo_postal,direccion
			FROM alumno
            WHERE apellidos=alApellido;
	ELSEIF(alNombre IS NOT NULL AND alApellido IS NOT NULL)THEN
		SELECT id_alumno,ciclo_id,delegado_id,dni,nombre,apellidos,email,
				telefono,ciudad,fecha_nacimiento,edad,codigo_postal,direccion
			FROM alumno
            WHERE nombre=alNombre AND apellidos=alApellido;
	ELSEIF(alNombre IS NULL AND alApellido IS NULL)THEN
		SELECT id_alumno,ciclo_id,delegado_id,dni,nombre,apellidos,email,
				telefono,ciudad,fecha_nacimiento,edad,codigo_postal,direccion
			FROM alumno;
	END IF;
END //
DELIMITER ;
CALL buscarAlumno(NULL ,NULL);
CALL buscarAlumno("Joel","Resina");
CALL buscarAlumno("Fernando",NULL);
CALL buscarAlumno(NULL,"Garcia");

-- DROP PROCEDURE crudFamiliaFormativa;


-- CASE


/*5. Muestra la cantidad de alumnos según el dominio de su correo electronico, el dominio será ingresado por parametro*/
DELIMITER //
CREATE PROCEDURE cantAlumnosXDominio (IN pDominio VARCHAR (30), OUT pError VARCHAR(35))
BEGIN
	CASE pDominio
    WHEN 'institut' THEN
		SELECT COUNT(id_alumno) AS cantidad_alumnos
        FROM alumno
		WHERE email LIKE '%inst%';
	WHEN 'gmail' THEN
		SELECT COUNT(id_alumno) AS cantidad_alumnos
        FROM alumno
		WHERE email LIKE '%gm%';
	WHEN 'hotmail' THEN
		SELECT COUNT(id_alumno) AS cantidad_alumnos
        FROM alumno
		WHERE email LIKE '%hot%';
	ELSE
		SET pError = 'El dominio vacio o no existe';
        SELECT pError;
    END CASE;
END //
DELIMITER ;
CALL cantAlumnosXDominio('yahoo',@pError);
CALL cantAlumnosXDominio('gmail',@pError);
CALL cantAlumnosXDominio('institut',@pError);
-- DROP PROCEDURE cantAlumnosXDominio;


/*6. Mostrar a los coordinadores y tutores según el parametro ingresado, tambien que se muestren
los dias de atencion de cada individuo*/

DELIMITER //
CREATE PROCEDURE buscarProfesor(IN pProfesor VARCHAR(12), OUT pMensaje VARCHAR(20))
BEGIN
	CASE pProfesor
    WHEN 'coordinador' THEN
		SELECT CONCAT(p.nombre,' ',p.apellidos)AS nombre_coordinador, p.dias_atencion
        FROM profesor AS p
			INNER JOIN coordinador AS c ON p.id_profesor=c.id_coordinador;
	WHEN 'tutor' THEN
		SELECT CONCAT(p.nombre,' ',p.apellidos)AS nombre_tutor, p.dias_atencion
        FROM profesor AS p
			INNER JOIN tutor AS t ON p.id_profesor=t.id_tutor;
	ELSE
		SET pMensaje = 'Parametro no valido';
        SELECT pMensaje;
	END CASE;
END //
DELIMITER ;

CALL buscarProfesor('profesor', @mensaje);
CALL buscarProfesor('tutor', @mensaje);
CALL buscarProfesor('coordinador',@mensaje);
CALL buscarProfesor(NULL, @mensaje);

-- DROP PROCEDURE buscarProfesor;


-- 7.Procedimiento para poner el id de un ciclo y devuelve el nombre de la familia formativa a la que pertenece
DROP PROCEDURE IF EXISTS obtenerFamiliaFormativa;
DELIMITER //
CREATE PROCEDURE obtenerFamiliaFormativa(IN idCiclo INT,OUT idError VARCHAR(15))
BEGIN
    CASE idCiclo
      WHEN 1 THEN 
      SELECT nombre
		FROM familia_formativa
		WHERE id_famfor=1;
      WHEN 2 THEN 
      SELECT nombre
		FROM familia_formativa
		WHERE id_famfor=2;
      WHEN 3 THEN 
		SELECT nombre
		FROM familia_formativa
		WHERE id_famfor=3;
      WHEN 4 THEN 
            SELECT nombre
		FROM familia_formativa
		WHERE id_famfor=4;
      WHEN 5 THEN 
		SELECT nombre
		FROM familia_formativa
		WHERE id_famfor=5;
      ELSE 
      SET idError='Desconocido';
      SELECT idError;
      END CASE;
END //
DELIMITER ;
CALL obtenerFamiliaFormativa(1,@idError);
CALL obtenerFamiliaFormativa(5,@idError);
CALL obtenerFamiliaFormativa(6,@idError);


-- 8. Procedimiento para añadir o eliminar asignaturas y que le assigne automaticamente el ultimo identificador 
DROP PROCEDURE IF EXISTS añadirEliminarAsignaturas;
DELIMITER //
CREATE PROCEDURE añadirEliminarAsignaturas(IN accion VARCHAR(10), IN nombre VARCHAR(40), IN hora_duracion VARCHAR(5), IN cantidad_ufs TINYINT(1))
BEGIN
DECLARE	UltimaId SMALLINT(6); 
	CASE accion
    WHEN 'añadir' THEN
    INSERT INTO asignatura (nombre,hora_duracion,cantidad_ufs) 
    VALUES (nombre,hora_duracion,cantidad_ufs);
    SET UltimaId = LAST_INSERT_ID();
    INSERT INTO profesor (id_asignatura) VALUES (UltimaId);
    WHEN 'eliminar' THEN
    SET UltimaId = LAST_INSERT_ID();
    DELETE FROM asignatura WHERE id_asignatura=UltimaId;
      END CASE;
END //
DELIMITER ;
CALL añadirEliminarAsignaturas("añadir","prueba","300","4");
CALL añadirEliminarAsignaturas("eliminar",NULL,NULL,NULL);


-- WHILE


-- 9. Procedimiento para contar los alumnos que hay 
DROP PROCEDURE IF EXISTS ContarAlumnos;
DELIMITER //
CREATE PROCEDURE ContarAlumnos(OUT contador INT(3))
BEGIN
DECLARE contadorAlumnos INT DEFAULT 0;
DECLARE i INT DEFAULT 1;
WHILE i <= (SELECT COUNT(*) FROM alumno) DO
    SET contadorAlumnos = contadorAlumnos + 1;
    SET i = i + 1;
END WHILE;
SELECT contadorAlumnos;
END //
DELIMITER ;
CALL ContarAlumnos(@contadorAlumnos);



/*10. Se desea que para los acudientes que no tienen registro de un email se ingrese el mismo numero de
telefono para ser contactados via whatsapp */

DELIMITER //
CREATE PROCEDURE insertarEmail()
BEGIN
	WHILE((SELECT COUNT(*)
			FROM acudiente 
			WHERE email IS NULL) >0) DO
		UPDATE acudiente 
		SET email = CONCAT('+34 ',(SELECT telefono
			FROM acudiente 
			WHERE email IS NULL LIMIT 1))
        WHERE id_acudiente = (SELECT id_acudiente 
			FROM acudiente 
			WHERE email IS NULL LIMIT 1);
	END WHILE;
    SELECT nombre, apellidos, email FROM acudiente;
END //
DELIMITER ;

CALL insertarEmail;
-- DROP PROCEDURE insertarEmail;

UPDATE acudiente 
		SET email = NULL
        WHERE id_acudiente IN(SELECT id_acudiente
								FROM acudiente
									WHERE id_acudiente%2=1);

								

-- REPEAT


-- 11. Procedimiento para contar los profesores que hay 
DROP PROCEDURE IF EXISTS ContarProfesores;
DELIMITER //
CREATE PROCEDURE ContarProfesores(OUT contador INT(3))
BEGIN
DECLARE contadorProfesores INT DEFAULT 0;
DECLARE i INT DEFAULT 1;
REPEAT
    SET contadorProfesores = contadorProfesores + 1;
    SET i = i + 1;
	UNTIL i > (SELECT COUNT(*) FROM profesor) 
END REPEAT;

SELECT contadorProfesores;
END //
DELIMITER ;
CALL ContarProfesores(@contadorProfesores);


/*12. Se desea que para los acudientes que no tienen registrado un codigo postal, 
se ingrese por parametro un codigo postal general */

DELIMITER //
CREATE PROCEDURE insertarPostalCode(IN pCodigo_postal VARCHAR (5))
BEGIN
	REPEAT
		UPDATE acudiente 
		SET codigo_postal = pCodigo_postal
        WHERE id_acudiente = (SELECT id_acudiente 
			FROM acudiente 
			WHERE codigo_postal IS NULL LIMIT 1);
    UNTIL ((SELECT COUNT(*)
			FROM acudiente 
			WHERE codigo_postal IS NULL) =0)
    END REPEAT;
    SELECT nombre, apellidos, codigo_postal FROM acudiente;
END //
DELIMITER ;

CALL insertarPostalCode('11111');
-- DROP PROCEDURE insertarPostalCode;

UPDATE acudiente 
		SET codigo_postal = NULL
        WHERE id_acudiente IN(SELECT id_acudiente
								FROM acudiente
									WHERE id_acudiente%2=1);
