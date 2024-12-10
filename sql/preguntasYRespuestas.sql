-- Levi Josué Candeias de Figueiredo
-- Crear la tabla Escenario
CREATE TABLE Escenario (
    idEscenario TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    ambito VARCHAR(25) NOT NULL,
    rutaMapa VARCHAR(250) NOT NULL,
    puntosInteres VARCHAR(25) NOT NULL,
    CONSTRAINT pk_Escenario PRIMARY KEY (idEscenario)
);

-- Crear la tabla Pregunta
CREATE TABLE Pregunta (
    idPregunta SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    contenido_P VARCHAR(350) NOT NULL,
    idEscenario TINYINT UNSIGNED NOT NULL,
    CONSTRAINT pk_Pregunta PRIMARY KEY (idPregunta),
    CONSTRAINT fk_Pregunta_Escenario FOREIGN KEY (idEscenario) REFERENCES Escenario(idEscenario)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- Crear la tabla Opciones
CREATE TABLE Opciones (
    idOpcion SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    contenidos VARCHAR(300) NOT NULL,
    esCorrecto BOOLEAN NOT NULL,
    idPregunta SMALLINT UNSIGNED NOT NULL,
    CONSTRAINT pk_Opciones PRIMARY KEY (idOpcion),
    CONSTRAINT fk_Opciones_Pregunta FOREIGN KEY (idPregunta) REFERENCES Pregunta(idPregunta)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);