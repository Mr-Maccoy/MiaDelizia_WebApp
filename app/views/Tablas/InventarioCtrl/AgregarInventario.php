<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Inventario</title>
</head>

<body>
    <div class="Insert">
        <h2>Agregar Inventario</h2>
        <form action="insert.php" method="post">

            <label for="id_producto">ID Producto:</label>
            <input type="text" name="id_producto" id="id_producto" required><br><br>

            <label for="cantidad_disponible">Cantidad Disponible:</label>
            <input type="number" name="cantidad_disponible" id="cantidad_disponible" required><br><br>

            <input type="hidden" name="fecha_actualizacion" value="<?php echo date('Y-m-d'); ?>"><br><br>

            <button type="submit">Agregar Inventario</button>
        </form>
    </div>
</body>

</html>