-- Escenarios relacionados con la equidad de género
INSERT INTO Escenario (ambito, rutaMapa)
VALUES
('Educación', '/mapas/educacion.jpg'),
('Empleo', '/mapas/empleo.jpg'),
('Salud', '/mapas/salud.jpg');

-- Puntos de interes de cada mapa
INSERT INTO Escenario_PtsInteres (idEscenario, ptX, ptY)
VALUES
-- Puntos de interés del primer mapa (Educación)
(1,7,70),
(1,40,70),
(1,10,10),
(1,20,5),

-- Opciones para la segunda pregunta (Empleo)

(2,35,13),
(2,33,33),
(2,90,4),
(2,67,22),

-- Opciones para la tercera pregunta (Salud)
(3,12,56),
(3,78,43),
(3,25,99),
(3,89,37);
