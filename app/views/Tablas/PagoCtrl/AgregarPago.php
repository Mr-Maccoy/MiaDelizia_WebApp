<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Pago</title>
</head>
<body>
    <div class="Insert">
    <h2>Agregar Pago</h2>
    <form action="inseert.php" method="post">

        <label for="id_pedido">Pedido:</label>
        <input type="text" id="id_pedido" name="id_pedido" required><br><br>

        <label for="fecha_pago">Fecha Pago:</label>
        <input type="date" id="fecha_pago" name="fecha_pago" required><br><br>

        <label for="monto">Monto:</label>
        <input type="number" id="monto" name="monto" required><br><br>

        <label for="metodo_pago">Método Pago:</label>
        <select name="metodo_pago" id="metodo_pago" required>
                <option value="TARJETA">TARJETA</option>
                <option value="EFECTIVO">EFECTIVO</option>
                <option value="TRANSFERENCIA">TRANSFERENCIA</option>
            </select><br><br>

        <label for="estado_pago">Estado Pago:</label>
        <select name="estado_pago" id="estado_pago" required>
                <option value="PENDIENTE">PENDIENTE</option>
                <option value="CONFIRMADO">CONFIRMADO</option>
                <option value="CANCELADO">CANCELADO</option>
            </select><br><br>

        <label for="pago_pedido">Pago Pedido:</label>
        <input type="text" id="pago_pedido" name="pago_pedido" required><br><br>

        <button type="submit">Agregar</button>
    </form>

</body>
</html>