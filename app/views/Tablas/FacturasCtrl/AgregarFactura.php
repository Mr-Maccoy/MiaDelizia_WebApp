<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Factura</title>
</head>
<body>
    <h1>Agregar Factura</h1>
    <form action="Insert.php" method="post">
        <label for="id_pedido">Pedido:</label>
        <input type="text" id="id_pedido" name="id_pedido" required>
        <br>
        <label for="fecha_factura">Fecha Factura:</label>
        <input type="date" id="fecha_factura" name="fecha_factura" required>
        <br>
        <label for="total">Total:</label>
        <input type="number" id="total" name="total" required>
        <br>
        <label for="estado_factura">Estado:</label>
            <select name="estado_factura" id="estado_factura" required>
                <option value="Pendiente">PENDIENTE</option>
                <option value="Enviado">PAGADA</option>
                <option value="Entregado">ANULADA</option>
            </select><br><br>
        <button type="submit">Agregar</button>
    </form>


</body>
</html>