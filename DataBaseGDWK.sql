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
  Usuario VARCHAR(64),
  Estado INT NULL,
  `Fecha de login` DATETIME,
  `Fecha de cambio de clave` DATETIME,
  `Fecha de creación` DATETIME,
  IDcreador INT NULL,
  IPcreación VARCHAR(64),
  IPlogin VARCHAR(64),
    PRIMARY KEY (`ID_usuarios`),
    FOREIGN KEY (`Idrango`)
    REFERENCES `RangoUsuarios` (`idRangoUsuarios`)
);


CREATE TABLE `Tipo de documento` (
  `idtipo de documento` INT NOT NULL,
  `Descripción` VARCHAR(64) NOT NULL,
  PRIMARY KEY (`idtipo de documento`)
);
CREATE TABLE `subproceso` (
  `idsubproceso` INT NOT NULL,
  `Descripción` VARCHAR(64) NOT NULL,
  PRIMARY KEY (`idsubproceso`)
);
CREATE TABLE `Proceso` (
  `idProceso` INT NOT NULL,
  `Descripcion` VARCHAR(64) NOT NULL,
  PRIMARY KEY (`idProceso`)
);
CREATE TABLE Documentos (
  `ID_documentos` INT NOT NULL,
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
    PRIMARY KEY (`idcodigoDocumento`),
    FOREIGN KEY (`idproceso`)
    REFERENCES `GDWKF`.`Proceso` (`idProceso`),
    FOREIGN KEY (`idsubproceso`)
    REFERENCES `GDWKF`.`subproceso` (`idsubproceso`),
    FOREIGN KEY (`idtipodedocumento`)
    REFERENCES `Tipo de documento` (`idtipo de documento`)
);
CREATE TABLE `documentosPorRango` (
  `idDocumentosPorRango` INT NOT NULL AUTO_INCREMENT,
  `idRangoUsuarios` INT NULL,
  `idCodigoDocumento` INT NULL,
  PRIMARY KEY (`idDocumentosPorRango`),
    FOREIGN KEY (`idRangoUsuarios`)
    REFERENCES `RangoUsuarios` (`idRangoUsuarios`),
    FOREIGN KEY (`idCodigoDocumento`)
    REFERENCES `GDWKF`.`codigoDocumento` (`idcodigoDocumento`)
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
INSERT INTO usuarios (Nombres, ID_usuarios, Idrango, Apellidos, Contraseña, Usuario, Estado, `Fecha de login`, `Fecha de cambio de clave`, `Fecha de creación`, IDcreador, IPcreación, IPlogin)
VALUES ('asdasd', null, '1','asdasd','MTIzNA==','mataperras',1,'12/08/18','12/08/18','12/08/18',null,'asdasd123','qwqeasda21312');
