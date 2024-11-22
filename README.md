# Proyecto-Equiquiz

# Constitución de la Aplicación

## Parte de Usuario

### Introducción y Selección de Personajes
Al iniciar el juego, se presenta la historia de los tres personajes con sus respectivos contextos sociales y necesidades:

- **Ana**: Necesita superar barreras en un entorno en el cual los estigmas sociales hacen difícil a las mujeres formarse como ingenieras.
- **Luis**: Lucha contra prejuicios sociales que dificultan que busque ayuda para su salud mental.
- **Martina**: Busca acceso a becas y recursos educativos, enfrentando la desigualdad de oportunidades.

### Comienzo del Juego
Un botón **"Comenzar Partida"** lleva al jugador a un mapa dinámico donde inicia la aventura:
- Se muestra la **barra de equidad**, comenzando al 50%.

### Desarrollo del Juego

#### Sistema de Preguntas Basado en Escenarios
- **Escenarios principales**: Salud, Empleo y Educación.
- El juego guía al jugador a un punto del mapa para responder preguntas que plantean decisiones relacionadas con las necesidades de los personajes.
- Cada pregunta aborda un conflicto donde las opciones favorecen de forma diferente a cada personaje:
  - **Ejemplo**: "¿A quién priorizarías para recibir apoyo en este escenario?"
    - **Opción A**: Apoyar a Ana con una beca de ingeniería.
    - **Opción B**: Financiar terapia para Luis.
    - **Opción C**: Ayudar a Martina con material educativo.

#### Impacto en la Barra de Equidad
- Las decisiones afectan la barra de equidad de manera positiva o negativa, mostrando cómo las elecciones del jugador benefician o perjudican a los personajes en función de sus necesidades versus los deseos personales.
- La barra refleja el balance entre **equidad social** y **personal**.

#### Interfaz Dinámica
- La interfaz del mapa cambia según las respuestas y progreso del jugador:
  - Animaciones que representan las consecuencias de las decisiones (por ejemplo, un aula construida o una clínica abierta).
  - Cambios visuales en la **barra de equidad**.

### Fin del Juego y Guardado de Puntuación
- Al finalizar todas las preguntas, se muestra un resumen del impacto de las decisiones:
  - Cuánto ayudaron a cada personaje.
  - El estado final de la barra de equidad.
- Se solicita un nickname para guardar la puntuación en un ranking global, destacando a los jugadores con decisiones equilibradas.

---

## Parte Administrativa

### Gestión de Preguntas (CRUD)
- **Funciones disponibles**:
  - Crear, editar, eliminar y listar preguntas según los tres escenarios: **Salud**, **Empleo** y **Educación**.
  - Asociar cada pregunta a los personajes y definir cómo afecta la barra de equidad.

### Control de Puntuaciones
- **Funciones disponibles**:
  - Visualizar el ranking de puntuaciones.
  - Filtrar por nombre de usuario, fecha, y balance de la barra de equidad.


