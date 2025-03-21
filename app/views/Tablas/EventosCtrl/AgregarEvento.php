<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Evento</title>
</head>

<body>
    <div class="Insert">
        <h2>Agregar Evento</h2>
        <form action="insert_evento.php" method="post">

            <label for="nombre_evento">Nombre del Evento:</label>
            <input type="text" name="nombre_evento" id="nombre_evento" required><br><br>

            <label for="fecha_evento">Fecha del Evento:</label>
            <input type="date" name="fecha_evento" id="fecha_evento" required><br><br>

            <label for="ubicacion">Ubicación:</label>
            <input type="text" name="ubicacion" id="ubicacion"><br><br>

            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion"></textarea><br><br>

            <button type="submit">Agregar Evento</button>
        </form>
    </div>
</body>

</html>