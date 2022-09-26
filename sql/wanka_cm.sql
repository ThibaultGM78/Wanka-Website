/*Milk Chocolate*/
CREATE DATABASE IF NOT EXISTS `wanka_database`;
USE `wanka_database`;

CREATE TABLE IF NOT EXISTS `wanka_cm`
(
	`id_milkChocolate` INT NOT NULL AUTO_INCREMENT, 
	`chocolate_id` VARCHAR(3) NOT NULL, 
	`chocolate_price` FLOAT NOT NULL, 
	`chocolate_img` VARCHAR(50) NOT NULL, 
	`chocolate_description` TEXT NOT NULL, 
	PRIMARY KEY(`id_milkChocolate`)
);

/*
----------------------------------------------------------------------------------------------------------------
-- Ajout de quelques enregistrements ---------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------
*/
INSERT INTO `wanka_cm`(`chocolate_id`, `chocolate_price`, `chocolate_img`, `chocolate_description`)
VALUES
('m01', 4, 'img/milkChocolate1.jpg', 'Le célébre chocolat Wonka'), 
('m02', 1, 'img/milkChocolate2.jpg', 'Tablette MAÎTRE CHOCOLATIER Lait Extra Fin 110g'), 
('m03', 3, 'img/milkChocolate3.jpg', 'Tablette LINDOR Lait 150g'), 
('m04', 3, 'img/milkChocolate4.jpg', 'Chocolat au lait les Pyrénéens 150g'), 
('m05', 3, 'img/milkChocolate5.jpg', 'Tablette CRÉATION Rocher Lait 150g');