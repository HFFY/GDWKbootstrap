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
  `Fecha de login` VARCHAR(64),
  `Fecha de cambio de clave` VARCHAR(64),
  `Fecha de creación` VARCHAR(64),
  IDcreador INT NULL,
  IPcreación VARCHAR(64),
  IPlogin VARCHAR(64),
    PRIMARY KEY (`ID_usuarios`),
    FOREIGN KEY (`Idrango`)
    REFERENCES `RangoUsuarios` (`idRangoUsuarios`)
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
  `Fecha de entrada en vigencia` VARCHAR(45) NULL,
  `Fecha de entrada en caducidad` VARCHAR(45) NULL,
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
  `Id_cambio` INT NOT NULL,
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
  `idTipoTareas` INT NOT NULL,
  `Descripción` VARCHAR(64) NOT NULL,
  PRIMARY KEY (`idTipoTareas`)
);
CREATE TABLE `Tareas` (
  `id_tareas` INT NOT NULL,
  `Prioridad` TINYINT(2) NOT NULL,
  `Fecha de estimada` DATETIME(1) NOT NULL,
  `Fecha oficial` DATETIME(1) NOT NULL,
  `Descripción` VARCHAR(45) NULL,
  `Id_usuario` INT NOT NULL,
  `Tipo` INT NOT NULL,
  `Demora` DATETIME NULL,
  `Creadopor` VARCHAR(45) NULL,
  `IP` VARCHAR(45) NULL,
  `Fecha de creación` DATE NULL,
  `Estado` VARCHAR(1) NULL,
  `Persona` VARCHAR(45) NULL,
  PRIMARY KEY (`id_tareas`),
    FOREIGN KEY (`Id_usuario`)
    REFERENCES `GDWKF`.`Usuarios` (`ID_usuarios`),
    FOREIGN KEY (`Tipo`)
    REFERENCES `GDWKF`.`TipoTareas` (`idTipoTareas`)
);
CREATE TABLE `TareasUsuarios` (
  `Id_proceso` INT NOT NULL,
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
VALUES (null, 'Super Usuario');
INSERT INTO RangoUsuarios (idRangoUsuarios, Descripcion) VALUES (666,'GOD');
INSERT into proceso VALUES(null,'proceso1');
INSERT into subproceso VALUES(null,'proceso1');
INSERT into `tipo de documento` VALUES(null,'proceso1');
INSERT INTO usuarios VALUES ('GOD', '666','666','GOD','MTIzNA==','admin',1,null,null,null,null,null,null);
INSERT INTO usuarios (Nombres, ID_usuarios, Idrango, Apellidos, Contraseña, Usuario, Estado, `Fecha de login`, `Fecha de cambio de clave`, `Fecha de creación`, IDcreador, IPcreación, IPlogin)
VALUES ('asdasd', null, '1','asdasd','MTIzNA==','mataperras',1,'12/08/18','12/08/18','12/08/18',null,'asdasd123','qwqeasda21312');
INSERT INTO usuarios VALUES ('asdasd', null, '1','asdasd','MTIzNA==','mataperras2',1,'12/08/18','12/08/18','12/08/18',null,'asdasd123','qwqeasda21312');
INSERT INTO usuarios VALUES ('asdasd', null, '1','asdasd','asdasd','haosdaosdao',1,'','','asdasd',null,'asdasd123','qwqeasda21312');
INSERT into documentos VALUES (null, '1', '1','1','1','documentoprueba','1.5','pedro','pedra','hola','hola','15/25','12/89','todas','todos','documento hola','1','http://www.google.com');
INSERT into codigoDocumento VALUES (null, '1','1','1','111','1');
