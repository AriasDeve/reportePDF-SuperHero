SELECT * FROM superhero;
SELECT * FROM gender;
SELECT * FROM colour;
SELECT * FROM race;
SELECT * FROM publisher;
SELECT * FROM alignment;
-- ------------------------------------------------------------------
SELECT 
	s.`id`,
	s.`superhero_name`,
	s.`full_name`,  
	c1.`colour` AS 'eye_colour',
	c2.`colour` AS 'hair_colour',
	c3.`colour` AS 'skin_colour'
		FROM superhero s 
		INNER JOIN colour c1 ON c1.`id` = s.`eye_colour_id`
		INNER JOIN colour c2 ON c2.`id` = s.`hair_colour_id`
		INNER JOIN colour c3 ON c3.`id` = s.`skin_colour_id`
		ORDER BY s.`id`;
-- ------------------------------------------------------------------		
DELIMITER $$
CREATE PROCEDURE spu_superhero_list_publisher(IN _publisher_id INT)
BEGIN
		SELECT 
			s.`id`,
			s.`superhero_name`,
			s.`full_name`,  
			c1.`colour` AS 'eye_colour',
			c2.`colour` AS 'hair_colour',
			c3.`colour` AS 'skin_colour'
				FROM superhero s 
				INNER JOIN colour c1 ON c1.`id` = s.`eye_colour_id`
				INNER JOIN colour c2 ON c2.`id` = s.`hair_colour_id`
				INNER JOIN colour c3 ON c3.`id` = s.`skin_colour_id`
				WHERE s.publisher_id = _publisher_id
				ORDER BY s.`id`;
END $$

CALL spu_superhero_list_publisher(5);
-- -----------------------------------------------------------------
DELIMITER $$
CREATE PROCEDURE spu_publisher_list()
BEGIN
	SELECT * FROM publisher ORDER BY publisher_name;
END $$

CALL spu_publisher_list();

-- ------------------------------------------------------------------
-- TAREAS
-- ------------------------------------------------------------------
-- Ejercicio 01
DELIMITER $$
CREATE PROCEDURE spu_alignment_list_t1
(
	IN _publisher_id INT,
	IN _alignment_id INT
)
BEGIN
	SELECT s.id, s.superhero_name, s.full_name, r.race, p.publisher_name
	FROM superhero s
	INNER JOIN  race r ON r.`id` = s.race_id
	INNER JOIN  publisher p ON p.id = s.publisher_id
	WHERE s.alignment_id = _alignment_id AND
			s.publisher_id = _publisher_id
	ORDER BY s.id;
END $$
CALL spu_alignment_list_t1(1,1);
-- ------------------------------------------------------------------
DELIMITER $$
CREATE PROCEDURE spu_alignment_list_t1_1()
BEGIN
	SELECT * FROM alignment ORDER BY alignment;
END $$

CALL spu_alignment_list_t1_1();


-- Lunes 19 Junio 2023
-- nick, nombre, raza, casa. alineación, altura
DELIMITER $$
CREATE PROCEDURE spu_superhero_listbyrace(IN _race_id INT)
BEGIN
	SELECT 
		SPH.`id`,
		SPH.`superhero_name`,
		SPH.`full_name`,
		RAC.`race`,
		PBS.`publisher_name`,
		ALG.`alignment`,
		SPH.`height_cm`
		FROM superhero SPH
		LEFT JOIN race RAC 		ON RAC.`id` = SPH.`race_id`
		LEFT JOIN publisher PBS ON PBS.`id` = SPH.`publisher_id`
		LEFT JOIN alignment ALG ON ALG.`id` = SPH.`alignment_id`
		WHERE SPH.race_id = _race_id
		ORDER BY PBS.publisher_name;
END $$


DELIMITER $$
CREATE PROCEDURE spu_race_list()
BEGIN
	SELECT * FROM race ORDER BY 2;
END $$

CALL spu_superhero_listbyrace(13);

DELIMITER $$ 
CREATE PROCEDURE spu_superhero_multi_race
( 
	IN _race_ids VARCHAR(255) 
) 
BEGIN 
	SELECT SPH.id, SPH.superhero_name, SPH.full_name, RAC.race 
		FROM superhero SPH 
		LEFT JOIN race RAC ON SPH.race_id = RAC.id 
		WHERE FIND_IN_SET(SPH.race_id, _race_ids) > 0 
	ORDER BY SPH.superhero_name ASC ,SPH.race_id ASC; 
END $$

CALL spu_superhero_multi_race	('5,2,');


-- -----------------------------------------
-- Graficos
SELECT * FROM superhero; -- x750
SELECT * FROM alignment; -- x4
SELECT * FROM publisher; -- x25
-- Consultaas de resumen (GROUP BY)
-- Funciones: COUNT (), SUM(), MIN(), MAX(), AVG()
-- Subconsultas (SELECT > SELECT)

-- ¿Cuántos superhero son buenos, malos, neutrales o N/A?
SELECT 
	IFNULL (ALG.`alignment`, 'Ninguno') AS `Bandos`,
	COUNT(SPH.id) AS `Total`
	FROM superhero SPH
	LEFT JOIN alignment ALG ON ALG.`id` = SPH.`alignment_id`
	GROUP BY ALG.`alignment`;

SELECT 
	CASE 
		WHEN ALG.`alignment` IS NULL THEN 'Ninguno' 
		ELSE ALG.`alignment` 
	END AS `Bandos`,
	COUNT(SPH.id) AS `Total`
	FROM superhero SPH
	LEFT JOIN alignment ALG ON ALG.`id` = SPH.`alignment_id`
	WHERE SPH.`publisher_id` IN (1,4)
	GROUP BY ALG.`alignment`;
	
-- ¿Cuántos superhero tenemos en una colección de casas?
-- indicadas manualmente por los usuarios

SELECT 
CASE
	WHEN PBS.`publisher_name` = "" THEN 'Ninguno'
	WHEN PBS.`publisher_name` != "" THEN PBS.`publisher_name`
END AS `Casa`,
	COUNT(SPH.`id`) `Total`
	FROM superhero SPH
	LEFT JOIN publisher PBS ON PBS.`id` = SPH.`publisher_id`
	WHERE SPH.`publisher_id` IN (1,4,9,15)
	GROUP BY PBS.`publisher_name`;

-- Hallar el promedio de pesos y estatura para los superheroes de las razas
-- especificadas manualmente por el usuario
SELECT 
	RAC.`race`,
	AVG(SPH.`weight_kg`) 'Peso Promedio',
	AVG(SPH.`height_cm`) 'Estatura Promedio',
	MAX(SPH.`weight_kg`) 'Peso Maximo',
	MIN(SPH.`height_cm`) 'Estatura Min'
	FROM superhero SPH
	LEFT JOIN race RAC ON RAC.`id` = SPH.`race_id`
	WHERE SPH.`race_id` IN (5, 8, 9, 15, 20, 32)
	GROUP BY RAC.race;
	
-- ACTIVIDADES
-- --------------------------------------------------------------------------
-- --- Ejercio 01

DELIMITER $$
CREATE PROCEDURE sp_getAlignment_publisher 
( 
	IN _publisher INT 
) 
BEGIN 
	SELECT 
	a.alignment 'Bandos', 
	COUNT(s.id) 'Total' 
	FROM alignment a
	LEFT JOIN superhero s ON a.id = s.alignment_id AND s.publisher_id = _publisher
	WHERE a.id IN (1, 2)
	GROUP BY a.alignment; 
END $$

CALL sp_getAlignment_publisher(3);


-- --------------------------------------------------------------------------

-- --- Ejercio 02
SELECT
	c.colour,
	p.publisher_name,
	COALESCE(COUNT(s.id), 0) AS 'Total'
FROM publisher p
CROSS JOIN colour c
LEFT JOIN superhero s ON s.publisher_id = p.id AND s.eye_colour_id = c.id
WHERE p.publisher_name IN ('Marvel Comics', 'DC Comics') 
GROUP BY c.colour, p.publisher_name;

DELIMITER $$
CREATE PROCEDURE get_by_publisher_and_color()
BEGIN
	SELECT
		c.colour,
		p.publisher_name,
		COALESCE(COUNT(s.id), 0) AS 'Total'
	FROM publisher p
	CROSS JOIN colour c
	LEFT JOIN superhero s ON s.publisher_id = p.id AND s.eye_colour_id = c.id
	WHERE p.publisher_name IN ('Marvel Comics', 'DC Comics') 
	GROUP BY c.colour, p.publisher_name;
END $$

CALL get_superheroes_by_publisher_and_color();



