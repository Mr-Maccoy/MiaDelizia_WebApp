<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Detalle de Pedido</title>
</head>

<body>
    <div class="Insert">
        <h2>Agregar Detalle de Pedido</h2>
        <form action="insert.php" method="post">

            <label for="id_pedido">ID Pedido:</label>
            <input type="number" name="id_pedido" id="id_pedido" required><br><br>

            <label for="id_producto">ID Producto:</label>
            <input type="number" name="id_producto" id="id_producto" required><br><br>

            <label for="cantidad">Cantidad:</label>
            <input type="number" name="cantidad" id="cantidad" min="1" required><br><br>

            <label for="precio_unitario">Precio Unitario:</label>
            <input type="number" name="precio_unitario" id="precio_unitario" step="0.01" min="0.01" required><br><br>

            <button type="submit">Agregar Detalle</button>
        </form>
    </div>
</body>

</html>
