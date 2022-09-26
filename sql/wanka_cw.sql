/*White Chocolate*/
CREATE DATABASE IF NOT EXISTS `wanka_database`;
USE `wanka_database`;

CREATE TABLE IF NOT EXISTS `wanka_cw`
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
INSERT INTO `wanka_cw`(`chocolate_id`, `chocolate_price`, `chocolate_img`, `chocolate_description`)
VALUES
('w01', 4, 'img/whiteChocolate1.jpg', 'Chocolat blanc Lindt SWISS CLASSIC – Barre (100 g)'), 
('w02', 2, 'img/whiteChocolate2.jpg', 'Tablette EXCELLENCE Blanc Extra Velouté 100g'), 
('w03', 4, 'img/whiteChocolate3.jpg', 'Tablette GRAND PLAISIR Blanc Fraises & Amandes 150g'), 
('w04', 6, 'img/whiteChocolate4.jpg', 'LINDT Dessert fourré mousse chocolat blanc 140G'), 
('w05', 6, 'img/whiteChocolate5.jpg', 'LINDT Création tablette de chocolat au lait au nougat croquant 1 pièce 150g');