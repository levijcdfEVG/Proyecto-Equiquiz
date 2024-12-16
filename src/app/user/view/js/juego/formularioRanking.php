<?php
    $puntuacion = $_GET['puntuacion'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../assets/img/Logo.png" type="image/x-icon">
        <title>Inscripción al ranking</title>
        <link rel="stylesheet" href ="../../../assets/css/reset.css">
        <link rel="stylesheet" href="../../../assets/css/styleMaria.css">
        <script src="validacionRanking.js"></script>
    </head>
    <body>
        <header>
            <h1>Inscripción al Ranking</h1>
        </header>
        <main id="rankingForm">
            <form action="../../../controller/intermedioRanking.php" method="POST" id="formRanking"> 
                <div id="rellenar">
                    <label for="name">Jugador:</label>
                    <input type="text" id="name" name="nombreJugador" placeholder="Ej: Maria">
                    <label for="puntuacion">Puntuacion:</label>
                    <input type="text" id="puntuacion" name="puntuacion" value="<?php echo $puntuacion ?>" readonly> 
                </div>
                <div id="botones">
                    <button class="cancelar">Cancelar</button>
                    <button class="borrar">Borrar</button> 
                    <button id="enviar">Enviar</button>
                </div>
            </>
        </main>
        <button class="volver">Volver</button>
    </body>
</html>