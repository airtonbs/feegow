----------------------------------------------
-- Arquivo de criação do banco de dados e tabela de agendamento dos pacientes
----------------------------------------------

CREATE DATABASE db_vitallife;

USE db_vitallife;
-- TABELA de agendamento de paciente
CREATE TABLE `tb_schedule` (
	`schedule_id` INT(11) NOT NULL AUTO_INCREMENT,
	`specialty_id` INT(11) NOT NULL,
	`professional_id` INT(11) NOT NULL,
	`source_id` INT(11) NOT NULL,
	`name` VARCHAR(128) NOT NULL,
	`birthdate` VARCHAR(128) NOT NULL,
	`cpf` VARCHAR(128) NOT NULL,
	`date_time` DATETIME NOT NULL,
	PRIMARY KEY (`schedule_id`)
)
	ENGINE = InnoDB
	AUTO_INCREMENT = 1
	DEFAULT CHARACTER SET = utf8;
;

--PROCEDURE para criar registros nas tabelas tb_schedule e retornar os dados
DELIMITER $$
CREATE PROCEDURE `sp_schedule_create`(
pspecialty_id int(11),
pprofessional_id int(11),
psource_id int(11),
pname varchar(128),
pbirthdate varchar(128),
pcpf varchar(128)
)
BEGIN
DECLARE vschedule_id int(11);

INSERT INTO tb_schedule 
	(specialty_id, professional_id, source_id, name, birthdate, cpf, date_time) 
	VALUE (pspecialty_id, pprofessional_id, psource_id, pname, pbirthdate, pcpf, CURTIME());
        
SET vschedule_id = last_insert_id();

SELECT * FROM tb_schedule WHERE schedule_id = vschedule_id;

END $$
DELIMITER ;
