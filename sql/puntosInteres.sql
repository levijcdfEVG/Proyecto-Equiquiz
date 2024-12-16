-- Crear la tabla Escenario
CREATE TABLE Escenario (
    idEscenario TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    ambito VARCHAR(25) NOT NULL,
    rutaMapa VARCHAR(250) NOT NULL,
    CONSTRAINT pk_Escenario PRIMARY KEY (idEscenario)
);
-- Crear la tabla de puntos de interés
CREATE TABLE Escenario_PtsInteres (
    idPtoInteres SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    idEscenario TINYINT UNSIGNED NOT NULL,
    ptX DECIMAL(10, 6) NOT NULL,
    ptY DECIMAL(10, 6) NOT NULL,
    CONSTRAINT pk_Escenario_PtsInteres PRIMARY KEY (idPtoInteres),
    CONSTRAINT csu_PtsInteres UNIQUE (idEscenario, ptX, ptY),
    CONSTRAINT fk_Escenario_PtsInteres FOREIGN KEY (idEscenario) REFERENCES Escenario(idEscenario)
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