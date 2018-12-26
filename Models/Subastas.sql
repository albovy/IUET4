/*CREACIÓN DE TABLAS*/
/* Avatar, Login, Rol.*/
CREATE TABLE IF NOT EXISTS USUARIO(
	NOMBRE VARCHAR(30) NOT NULL,
	APELLIDOS VARCHAR(50) NOT NULL,
	DNI VARCHAR(9) NOT NULL,
	EMAIL VARCHAR(60) NOT NULL,
	DIRECCIÓN VARCHAR(60) NOT NULL,
	AVATAR VARCHAR(60) NOT NULL,
	ROL ENUM('ADMINISTRADOR','PUJADOR','SUBASTADOR') NOT NULL,
	ESTADO ENUM('PENDIENTE','CREADO') NOT NULL,
	LOGIN VARCHAR(15) NOT NULL,
	PASSWORD VARCHAR(128) NOT NULL,
	LOGIN_ADMIN VARCHAR(15),
	CONSTRAINT PK_USUARIO PRIMARY KEY(LOGIN)
);
ALTER TABLE USUARIO ADD FOREIGN KEY(LOGIN_ADMIN) REFERENCES USUARIO(LOGIN);

CREATE TABLE IF NOT EXISTS SUBASTA(

	ID INT AUTO_INCREMENT NOT NULL,
	TIPO ENUM('CIEGA','NO CIEGA') NOT NULL,
	INFORMACION TEXT NOT NULL,
	INCREMENTO INT(10) NOT NULL,
	FECH_INICIO DATE NOT NULL,
	FECH_FIN DATE NOT NULL,
	ESTADO ENUM('PENDIENTE','APROBADA','INICIADA','FINALIZADA') NOT NULL,
	LOGIN_SUBASTADOR VARCHAR(15) NOT NULL,
	LOGIN_ADMIN VARCHAR(15) NOT NULL,

	CONSTRAINT FK_LOGIN_SUBASTADOR FOREIGN KEY(LOGIN_SUBASTADOR) REFERENCES USUARIO(LOGIN) ON DELETE CASCADE,
    CONSTRAINT FK_LOGIN_ADMIN FOREIGN KEY(LOGIN_ADMIN) REFERENCES USUARIO(LOGIN) ON DELETE CASCADE,
	CONSTRAINT PK_SUBASTA PRIMARY KEY(ID)

);


INSERT INTO SUBASTA(TIPO,INFORMACION,INCREMENTO,FECH_INICIO,FECH_FIN) VALUES('CIEGA','Menuda kk',50,'2018-4-4','2018-4-4');

CREATE TABLE IF NOT EXISTS PUJA(
	ID INT AUTO_INCREMENT NOT NULL,
	DINERO INT NOT NULL;
	LOGIN_PUJADOR VARCHAR(15) NOT NULL,
	ID_SUBASTA INT NOT NULL,
	
	CONSTRAINT FK_LOGIN_PUJADOR FOREIGN KEY(LOGIN_PUJADOR) REFERENCES USUARIO(LOGIN) ON DELETE CASCADE,
	CONSTRAINT FK_ID_SUBASTA FOREIGN KEY(ID_SUBASTA) REFERENCES SUBASTA(ID) ON DELETE CASCADE,
	CONSTRAINT PK_PUJA PRIMARY KEY(ID)
);

CREATE TABLE IF NOT EXISTS NOTIFICACION(
	ESTADO_SUBASTA ENUM('PENDIENTE','APROBADA','INICIADA','FINALIZADA') NOT NULL,
	LOGIN_SUBASTADOR TEXT NOT NULL,
	ID_SUBASTA INT NOT NULL,

	CONSTRAINT FK_ESTADO_SUBASTA FOREIGN KEY(ESTADO_SUBASTA) REFERENCES SUBASTA(ESTADO) ON DELETE CASCADE,
	CONSTRAINT FK_LOGIN_SUBASTADOR FOREIGN KEY(LOGIN_SUBASTADOR) REFERENCES SUBASTA(LOGIN_SUBASTADOR) ON DELETE CASCADE,
	CONSTRAINT FK_ID_SUBASTA FOREIGN KEY(ID_SUBASTA) REFERENCES SUBASTA(ID) ON DELETE CASCADE,

);
