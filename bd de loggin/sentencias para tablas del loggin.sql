-- CREATE USER 'admonistrador'@'localhost' IDENTIFIED BY 'Admincovid19@';
-- drop user 'admonistrador'@'localhost';
-- GRANT insert,select,update ON covid19.informegeneral TO 'admonistrador'@'localhost';
-- flush privileges;
USE covid19;

CREATE TABLE roles(
	Id_rol		INT AUTO_INCREMENT PRIMARY KEY,
	Rol 		VARCHAR(10)
);

CREATE TABLE users(
	Id_usuario	INT AUTO_INCREMENT PRIMARY KEY,
	Nick		VARCHAR(15),
	Passwd		VARCHAR(25),
	Id_rol		INT,
	Estado ENUM('Activo','Ocupado','Inhabilitado') DEFAULT "Activo" NOT NULL,
	FOREIGN KEY (Id_rol) REFERENCES roles(Id_rol)
);

INSERT INTO roles (Rol)VALUES("Administrador");
INSERT INTO roles (Rol)VALUES("Consultas");

INSERT INTO users (Nick,Passwd,Id_Rol)VALUES("sandro",54321,1);
INSERT INTO users (Nick,Passwd,Id_Rol)VALUES("roque",12345,2);

SELECT u.Id_usuario, u.Nick, u.Passwd FROM users u
    INNER JOIN roles r ON r.Id_rol= u.Id_rol
    -- WHERE  u.Nick = '$user' AND u.Pass = BINARY '$contrasena';
    WHERE  u.Nick = 'sandro' AND u.Passwd = BINARY '54321';