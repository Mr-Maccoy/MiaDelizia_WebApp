<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
</head>

<body>
    <div class="Insert">
        <h2>Agregar Producto</h2>
        <form action="insert.php" method="post">

            <label for="nombre">Nombre del Producto:</label>
            <input type="text" name="nombre" id="nombre" required><br><br>

            <label for="descripcion">Descripción:</label>
            <input type="text" name="descripcion" id="descripcion" required><br><br>

            <label for="precio">Precio:</label>
            <input type="text" name="precio" id="precio" required><br><br>

            <label for="disponibilidad">Disponibilidad:</label>
            <select name="disponibilidad" id="disponibilidad" required>
                <option value="S">Sí</option>
                <option value="N">No</option>
            </select><br><br>

            <label for="id_categoria">Categoría:</label>
            <input type="number" name="id_categoria" id="id_categoria" required><br><br>

            <button type="submit">Agregar Producto</button>
        </form>
    </div>
</body>

</html>
