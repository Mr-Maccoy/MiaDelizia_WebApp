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
        <label for="pedido">Pedido:</label>
        <input type="text" id="pedido" name="pedido" required>
        <br>
        <label for="fecha_factura">Fecha Factura:</label>
        <input type="date" id="fecha_factura" name="fecha_factura" required>
        <br>
        <label for="total">Total:</label>
        <input type="number" id="total" name="total" required>
        <br>
        <label for="estado_factura">Estado Factura:</label>
        <input type="text" id="estado_factura" name="estado_factura" required>
        <br>
        <button type="submit">Agregar</button>
    </form>


</body>
</html>