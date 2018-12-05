DROP DATABASE GDWKF;
CREATE DATABASE GDWKF;
USE GDWKF;
CREATE TABLE RangoUsuarios (
  `idRangoUsuarios` INT NOT NULL AUTO_INCREMENT,
  `Descripcion` MEDIUMTEXT NULL,
  PRIMARY KEY (`idRangoUsuarios`)
);
CREATE TABLE Usuarios (
  Nombres VARCHAR(64) NOT NULL,
  ID_usuarios INT NOT NULL AUTO_INCREMENT,
  Idrango INT NOT NULL,
  Apellidos VARCHAR(64) NOT NULL,
  Contraseña VARCHAR(64) NOT NULL,
  Usuario VARCHAR(64) UNIQUE,
  Estado INT NULL,
  `Fecha de login` DATETIME,
  `Fecha de cambio de clave` DATETIME,
  `Fecha de creación` DATETIME,
  IDcreador INT NULL,
  IPcreación VARCHAR(64),
  IPlogin VARCHAR(64),
    PRIMARY KEY (`ID_usuarios`),
    FOREIGN KEY (`Idrango`)
    REFERENCES `RangoUsuarios` (`idRangoUsuarios`) ON DELETE CASCADE
);


CREATE TABLE `Tipo de documento` (
  `idtipo de documento` INT NOT NULL AUTO_INCREMENT,
  `Descripción` VARCHAR(64) NOT NULL,
  PRIMARY KEY (`idtipo de documento`)
);
CREATE TABLE `subproceso` (
  `idsubproceso` INT NOT NULL AUTO_INCREMENT,
  `Descripción` VARCHAR(64) NOT NULL,
  PRIMARY KEY (`idsubproceso`)
);
CREATE TABLE `Proceso` (
  `idProceso` INT NOT NULL AUTO_INCREMENT,
  `Descripcion` VARCHAR(64) NOT NULL,
  PRIMARY KEY (`idProceso`)
);
CREATE TABLE Documentos (
  `ID_documentos` INT NOT NULL AUTO_INCREMENT,
  `Proceso` INT NULL,
  `Subproceso` INT NULL,
  `Tipo de documento` INT NULL,
  `Numero del documento` VARCHAR(45) NULL,
  `Nombre del documento` VARCHAR(45) NULL,
  `Version` VARCHAR(45) NULL,
  `Creador` VARCHAR(45) NULL,
  `Revisor` VARCHAR(45) NULL,
  `Autorizador` VARCHAR(45) NULL,
  `Diseño del proceso` VARCHAR(45) NULL,
  `Fecha de entrada en vigencia` DATE NULL,
  `Fecha de entrada en caducidad` DATE NULL,
  `Areas a las que afecta` VARCHAR(45) NULL,
  `Registros que corresponden` VARCHAR(45) NULL,
  `Descripción` LONGTEXT NULL,
  `Estado` INT NOT NULL,
  `Link` LONGTEXT NOT NULL,
    PRIMARY KEY (`ID_documentos`),
    FOREIGN KEY (`Proceso`)
    REFERENCES `Proceso` (`idProceso`),
    FOREIGN KEY (`Subproceso`)
    REFERENCES `subproceso` (`idsubproceso`),
    FOREIGN KEY (`Tipo de documento`)
    REFERENCES `Tipo de documento` (`idtipo de documento`)
);

CREATE TABLE `codigoDocumento` (
  `idcodigoDocumento` INT NOT NULL AUTO_INCREMENT,
  `idproceso` INT NULL,
  `idsubproceso` INT NULL,
  `idtipodedocumento` INT NULL,
  `descripcion` VARCHAR(64) NULL,
  `ID_documentos` INT NOT NULL,
    PRIMARY KEY (`idcodigoDocumento`),
    FOREIGN KEY (`idproceso`)
    REFERENCES `GDWKF`.`Proceso` (`idProceso`),
    FOREIGN KEY (`idsubproceso`)
    REFERENCES `GDWKF`.`subproceso` (`idsubproceso`),
    FOREIGN KEY (`idtipodedocumento`)
    REFERENCES `Tipo de documento` (`idtipo de documento`),
    FOREIGN KEY (`ID_documentos`)
    REFERENCES `Documentos` (`ID_documentos`)
);
CREATE TABLE `documentosPorRango` (
  `idDocumentosPorRango` INT NOT NULL AUTO_INCREMENT,
  `idRangoUsuarios` INT NOT NULL,
  `ID_documentos` INT NOT NULL,
  PRIMARY KEY (`idDocumentosPorRango`),
    FOREIGN KEY (`idRangoUsuarios`)
    REFERENCES `RangoUsuarios` (`idRangoUsuarios`),
    FOREIGN KEY (`ID_documentos`)
    REFERENCES `Documentos` (`ID_documentos`)
);
CREATE TABLE `DocUsuCambios` (
  `Id_cambio` INT NOT NULL AUTO_INCREMENT,
  `id_documento` INT NOT NULL,
  `Id_usuario` INT NOT NULL,
  `fecha` DATE NOT NULL,
  `hora` TIME NOT NULL,
  `Descripcion` LONGTEXT NOT NULL,
  `IP revision` VARCHAR(64) NULL,
    PRIMARY KEY (`Id_cambio`),
    FOREIGN KEY (`id_documento`)
    REFERENCES `GDWKF`.`Documentos` (`ID_documentos`),
    FOREIGN KEY (`Id_usuario`)
    REFERENCES `GDWKF`.`Usuarios` (`ID_usuarios`)
);
CREATE TABLE `TipoTareas` (
  `idTipoTareas` INT NOT NULL AUTO_INCREMENT,
  `Descripción` VARCHAR(64) NOT NULL,
  PRIMARY KEY (`idTipoTareas`)
);
CREATE TABLE `Tareas` (
  `id_tareas` INT NOT NULL AUTO_INCREMENT,
  `Prioridad` TINYINT(2) NOT NULL,
  `Fechaestimada` DATE NOT NULL,
  `Fechaoficial` DATE NOT NULL,
  `Descripcion` VARCHAR(45) NULL,
  `Id_usuario` INT NOT NULL,
  `Tipo` INT NOT NULL,
  `Demora` DATETIME NULL,
  `Creadopor` VARCHAR(45) NULL,
  `IP` VARCHAR(45) NULL,
  `Fecha de creación` DATE NULL,
  `Estado` VARCHAR(1) NOT NULL,
  `Persona` VARCHAR(45) NULL,
  `NombreTarea` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_tareas`),
    FOREIGN KEY (`Id_usuario`)
    REFERENCES `GDWKF`.`Usuarios` (`ID_usuarios`),
    FOREIGN KEY (`Tipo`)
    REFERENCES `GDWKF`.`TipoTareas` (`idTipoTareas`)
);
CREATE TABLE `TareasUsuarios` (
  `Id_proceso` INT NOT NULL AUTO_INCREMENT,
  `Id_tarea` INT NOT NULL,
  `Id_usuario` INT NOT NULL,
  `Fecha` DATE NOT NULL,
  `Hora` TIME NOT NULL,
  PRIMARY KEY (`Id_proceso`),
    FOREIGN KEY (`Id_tarea`)
    REFERENCES `GDWKF`.`Tareas` (`id_tareas`),
    FOREIGN KEY (`Id_usuario`)
    REFERENCES `GDWKF`.`Usuarios` (`ID_usuarios`)
);
INSERT INTO RangoUsuarios (idRangoUsuarios, Descripcion)
VALUES (null, 'Administrador');
INSERT INTO RangoUsuarios (idRangoUsuarios, Descripcion)
VALUES (null, 'Vicerrector/Decano');
INSERT INTO RangoUsuarios (idRangoUsuarios, Descripcion)
VALUES (null, 'Jefe de carrera');
INSERT INTO RangoUsuarios (idRangoUsuarios, Descripcion)
VALUES (null, 'Docente');

INSERT INTO RangoUsuarios (idRangoUsuarios, Descripcion) VALUES (666,'GOD');
INSERT into proceso VALUES(null,'proceso1');
INSERT into subproceso VALUES(null,'proceso1');
INSERT into `tipo de documento` VALUES(null,'proceso1');
INSERT into proceso VALUES(null,'proceso1');
INSERT into subproceso VALUES(null,'proceso1');
INSERT into `tipo de documento` VALUES(null,'proceso1');
INSERT into proceso VALUES(null,'proceso1');
INSERT into subproceso VALUES(null,'proceso1');
INSERT into `tipo de documento` VALUES(null,'proceso1');
INSERT into proceso VALUES(null,'proceso1');
INSERT into subproceso VALUES(null,'proceso1');
INSERT into `tipo de documento` VALUES(null,'proceso1');
INSERT INTO usuarios VALUES ('GOD', '1','666','GOD','MTIzNA==','admin',1,null,null,null,null,null,null);
INSERT INTO TipoTareas VALUES (null,'Reunión para documento');
INSERT INTO TipoTareas VALUES (null,'Solicitud de actualización de proceso');
INSERT INTO TipoTareas VALUES (null,'Solicitud de nuevo proceso');
INSERT INTO TipoTareas VALUES (null,'Interpretación de normas y procesos');
INSERT INTO TipoTareas VALUES (null,'Consulta');
INSERT INTO Tareas VALUES (1,1,"2018-12-12","2018-12-12","Tarea de prueba","1","1", null , null , null , null , 0, null,"prueba");
INSERT INTO Tareas VALUES (2,1,"2018-12-12","2018-12-12","Tarea de prueba","1","1", null , null , null , null , 1, null,"prueba");
INSERT INTO Tareas VALUES (3,1,"2018-12-12","2018-12-12","Tarea de prueba","1","2", null , null , null , null , 2, null,"prueba");
INSERT INTO Tareas VALUES (4,1,"2018-12-12","2018-12-12","Tarea de prueba","1","3", null , null , null , null , 3, null,"prueba");
INSERT INTO Tareas VALUES (5,1,"2018-12-12","2018-12-12","Tarea de prueba","1","1", null , null , null , null , 0, null,"prueba");
