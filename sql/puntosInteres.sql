-- Carlos Rodriguez Botello
-- Crear la tabla Escenario
CREATE TABLE Escenario (
    idEscenario TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    ambito VARCHAR(25) NOT NULL,
    rutaMapa VARCHAR(250) NOT NULL,
    puntosInteres VARCHAR(25) NOT NULL,
    CONSTRAINT pk_Escenario PRIMARY KEY (idEscenario),
    CONSTRAINT fk_Puntos_Interes FOREIGN KEY (puntosInteres) REFERENCES PuntosInteres_Escenario(puntosInteres)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- Crear la tabla de puntos de interes
CREATE TABLE PuntosInteres_Escenario (
    idPuntoInteres SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    puntosInteres VARCHAR(350) NOT NULL,
    CONSTRAINT pk_PInteres PRIMARY KEY (idPuntoInteres)
);