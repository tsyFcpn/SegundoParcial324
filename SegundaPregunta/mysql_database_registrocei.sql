CREATE database registrocei;

USE registrocei;
create table flujoproceso
(
flujo varchar(3),
proceso  varchar(3),
tipo varchar(1),
rol varchar(15), 
procesosiguiente varchar(3),
formulario varchar(20)
);

insert into flujoproceso values('F1','P1','I','Usuario','P2','index.php');
insert into flujoproceso values('F1','P2','P','Usuario','P3','bandejaCandidato.php');
insert into flujoproceso values('F1','P3','C','Usuario', null,'checkDocs.php');
insert into flujoproceso values('F1','P4','P','Usuario', 'P2','failDocs.php');
insert into flujoproceso values('F1','P5','P','Usuario', 'P6','qualifiedCand.php');
insert into flujoproceso values('F1','P6','P','Usuario', 'Fin','accepted.php');

create table flujocondicionante
(
proceso  varchar(3),
Si varchar(3),
No varchar(3)
);

insert into flujocondicionante values('P3','P5','P4');

create table seguimiento
(
notramite integer,
usuario varchar(10),
flujo varchar(3),
proceso varchar(3),
fechainicio datetime,
fechafin datetime
);
create table usuarios
(
usuario varchar(10),
contrasenia varchar(10),
rol varchar(10)
);


CREATE TABLE IF NOT EXISTS `images_tabla`(
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `imagenes` LONGBLOB NOT NULL,
    `creado` DATETIME NOT NULL,
    PRIMARY KEY(`id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_unicode_ci AUTO_INCREMENT = 3;

