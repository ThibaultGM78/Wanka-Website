/*Category*/
CREATE DATABASE IF NOT EXISTS `wanka_database`;
USE `wanka_database`;

CREATE TABLE IF NOT EXISTS `wanka_cb`
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
INSERT INTO `wanka_cb`(`chocolate_id`, `chocolate_price`, `chocolate_img`, `chocolate_description`)
VALUES
('b01', 2, 'img/blackChocolate1.jpg', 'Tablette EXCELLENCE Noir 90% 100g'), 
('b02', 1, 'img/blackChocolate2.jpg', 'Tablette MAÎTRE CHOCOLATIER Noir Extra Fondant 110g'), 
('b03', 3, 'img/blackChocolate3.jpg', 'Tablette CRÉATION Noir 70% Coulis de chocolat 150g'), 
('b04', 2, 'img/blackChocolate4.jpg', 'Tablette EXCELLENCE Noir 70% 100g'), 
('b05', 2, 'img/blackChocolate5.jpg', 'Tablette EXCELLENCE Doux 70% Cacao Noir 100g');