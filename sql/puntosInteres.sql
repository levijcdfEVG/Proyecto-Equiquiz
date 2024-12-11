-- Crear la tabla Escenario
CREATE TABLE Escenario (
    idEscenario TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    ambito VARCHAR(25) NOT NULL,
    rutaMapa VARCHAR(250) NOT NULL,
    CONSTRAINT pk_Escenario PRIMARY KEY (idEscenario)
);

-- Crear la tabla de puntos de interes
CREATE TABLE PuntosInteres_Escenario (
    idEscenario TINYINT UNSIGNED NOT NULL,
    puntosInteres VARCHAR(25) NOT NULL,
    CONSTRAINT pk_PInteres PRIMARY KEY (idEscenario, puntosInteres),
    CONSTRAINT fk_PK_PInteres FOREIGN KEY (idEscenario) REFERENCES Escenario(idEscenario)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);