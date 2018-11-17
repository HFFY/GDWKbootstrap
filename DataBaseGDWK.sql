DROP DATABASE GDWKF;
CREATE DATABASE GDWKF;
CREATE TABLE Usuarios (
     Nombres VARCHAR(64) NOT NULL,
     ID_usuarios INT UNIQUE AUTO_INCREMENT,
     Apellidos VARCHAR(64) NOT NULL,
      Contraseña VARCHAR(64) NOT NULL,
     Usuario VARCHAR(64) NULL
);
INSERT INTO Usuarios (Nombres, ID_usuarios, Apellidos,Contraseña,Usuario)
VALUES ('asdasd', null, 'asdasdasda','MTIzNA==','mataperras');
