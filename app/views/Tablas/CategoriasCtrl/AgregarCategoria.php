<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Categoría</title>
</head>
<body>
<div class="Insert">
        <h2>Agregar Categoría</h2>
        <form action="insert.php" method="post">

        <label for="nombre_categoria">Nombre:</label>
            <input type="text" name="nombre_categoria" id="nombre_categoria" required><br><br>

        <label for="descripcion_categoria">Descripción:</label>
        <input type="text" id="descripcion_categoria" name="descripcion_categoria" required><br><br>

        <button type="submit">Agregar</button>
        </form>
</body>
</html>