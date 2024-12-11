-- Escenarios relacionados con la equidad de género
INSERT INTO Escenario (ambito, rutaMapa, puntosInteres)
VALUES
('Educación', '/mapas/educacion.jpg', 'Oportunidades Educativas'),
('Empleo', '/mapas/empleo.jpg', 'Estigmas Sociales'),
('Salud', '/mapas/salud.jpg', 'Salud Mental');

-- Preguntas relacionadas con los escenarios
INSERT INTO Pregunta (contenido_P, idEscenario)
VALUES
('¿Cuál es un desafío común que enfrentan las mujeres en carreras de ingeniería?', 2),
('¿Qué estigma social suele impedir que los hombres busquen ayuda para su salud mental?', 3),
('¿Qué factores influyen en la falta de acceso a becas educativas para mujeres en zonas rurales?', 1);

-- Opciones para las preguntas
INSERT INTO Opciones (contenidos, esCorrecto, idPregunta)
VALUES
-- Opciones para la primera pregunta (Empleo - Ana)
('Falta de interés de las mujeres en estas áreas', 0, 1),
('Estigmas sociales y falta de apoyo', 1, 1),
('Mayor interés en carreras tradicionales', 0, 1),
('Ausencia de ejemplos a seguir', 0, 1),

-- Opciones para la segunda pregunta (Salud - Luis)
('No saber a dónde acudir', 0, 2),
('Miedo al juicio social', 1, 2),
('Falta de servicios de salud mental', 0, 2),
('Bajo interés en su salud personal', 0, 2),

-- Opciones para la tercera pregunta (Educación - Martina)
('Falta de instituciones educativas', 0, 3),
('Desigualdad de oportunidades y sesgos culturales', 1, 3),
('Desinterés por estudiar', 0, 3),
('Preferencia por trabajos manuales', 0, 3);
