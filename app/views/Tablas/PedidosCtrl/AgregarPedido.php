<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Pedido</title>
</head>

<body>
    <div class="Insert">
        <h2>Agregar Pedido</h2>
        <form action="insert.php" method="post">

            <label for="id_cliente">ID Cliente:</label>
            <input type="text" name="id_cliente" id="id_cliente" required><br><br>

            <label for="fecha_pedido">Fecha del Pedido:</label>
            <input type="date" name="fecha_pedido" id="fecha_pedido" required><br><br>

            <label for="total">Total:</label>
            <input type="text" name="total" id="total" required><br><br>

            <label for="estado">Estado:</label>
            <select name="estado" id="estado" required>
                <option value="Pendiente">Pendiente</option>
                <option value="Enviado">Enviado</option>
                <option value="Entregado">Entregado</option>
            </select><br><br>

            <button type="submit">Agregar Pedido</button>
        </form>
    </div>
</body>

</html>