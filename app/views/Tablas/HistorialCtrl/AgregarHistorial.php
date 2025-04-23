<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Detalle de Pedido</title>
</head>

<body>
    <div class="Insert">
        <h2>Agregar Historial de Pedido</h2>
        <form action="insert.php" method="post">
    <label>ID Pedido:</label>
    <input type="number" name="id_pedido" required><br><br>

    <label>Estado:</label>
    <select name="estado" required>
        <option value="EN ESPERA">EN ESPERA</option>
        <option value="EN PROCESO">EN PROCESO</option>
        <option value="COMPLETADO">COMPLETADO</option>
        <option value="CANCELADO">CANCELADO</option>
    </select><br><br>

    <button type="submit">Agregar Historial</button>
</form>
    </div>
</body>

</html>
