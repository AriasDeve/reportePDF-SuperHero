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