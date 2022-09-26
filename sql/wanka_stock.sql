/*Milk Chocolate*/
CREATE DATABASE IF NOT EXISTS `wanka_database`;
USE `wanka_database`;

CREATE TABLE IF NOT EXISTS `wanka_stocks`
( 
    `id_chocolate` INT NOT NULL AUTO_INCREMENT,
	`chocolate_id` VARCHAR(3) NOT NULL, 
	`chocolate_stock` INT NOT NULL, 
    PRIMARY KEY(`id_chocolate`)
);

/*
----------------------------------------------------------------------------------------------------------------
-- Ajout de quelques enregistrements ---------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------
*/
INSERT INTO `wanka_stocks`(`chocolate_id`, `chocolate_stock`)
VALUES
('m01', 50),
('m02', 50),
('m03', 50),
('m04', 50),
('m05', 50),
('b01', 50),
('b02', 50),
('b03', 50),
('b04', 50),
('b05', 50),
('w01', 50),
('w02', 50),
('w03', 50),
('w04', 50),
('w05', 50);