/*Account*/
CREATE DATABASE IF NOT EXISTS `wanka_database`;
USE `wanka_database`;

CREATE TABLE IF NOT EXISTS `wanka_account`
(
	`id_user` INT NOT NULL AUTO_INCREMENT, 
	`user_pseudo` VARCHAR(20) NOT NULL, 
	`user_password` VARCHAR(40) NOT NULL, 
	`user_email` VARCHAR(50) NOT NULL, 
	`user_phone_number` VARCHAR(10) NOT NULL,
    `user_sexe` VARCHAR(5) NOT NULL,
    `user_birthday` VARCHAR(10) NOT NULL,
    `user_adress` VARCHAR(100) NOT NULL,
    `user_job` VARCHAR(10) NOT NULL,
    `user_role` VARCHAR(5),
	PRIMARY KEY(`id_user`)
);

/*
----------------------------------------------------------------------------------------------------------------
-- Ajout de quelques enregistrements ---------------------------------------------------------------------------
----------------------------------------------------------------------------------------------------------------
*/
INSERT INTO `wanka_account`(`user_pseudo`, `user_password`, `user_email`, `user_phone_number`, `user_sexe`, `user_birthday`, `user_adress`, `user_job`, `user_role`)
VALUES
('steguo','sasa','michel@gmail.com','0695837261','men','30-07-2002','11 Rue des Marchands, Colmar,68000','student','admin');