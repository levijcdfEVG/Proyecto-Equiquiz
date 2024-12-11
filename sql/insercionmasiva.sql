-- Escenarios relacionados con la equidad de género
INSERT INTO Escenario (ambito, rutaMapa)
VALUES
('Educación', '/mapas/educacion.jpg'),
('Empleo', '/mapas/empleo.jpg'),
('Salud', '/mapas/salud.jpg');

-- Puntos de interes de cada mapa
INSERT INTO PuntosInteres_Escenario (puntosInteres)
VALUES
-- Puntos de interés del primer mapa (Educación)
('(7,70)'),
('(40,70)'),
('(10,10)'),
('(20,5)'),

-- Opciones para la segunda pregunta (Empleo)

('(35,13)'),
('(33,33)'),
('(90,4)'),
('(67,22)'),

-- Opciones para la tercera pregunta (Educación - Martina)
('(12,56)'),
('(78,43)'),
('(25,99)'),
('(89,37)');
