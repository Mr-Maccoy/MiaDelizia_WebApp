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

            <label for="fecha_entrega">Fecha del Pedido:</label>
            <input type="date" name="fecha_entrega" id="fecha_entrega" required><br><br>

            <label for="estado_pedido">Estado:</label>
            <select name="estado_pedido" id="estado_pedido" required>
                <option value="EN ESPERA">En Espera</option>
                <option value="EN PROCESO">En Proceso</option>
                <option value="COMPLETADO">Completado</option>
                <option value="CANCELADO">Cancelado</option>
            </select><br><br>

            <label for="tipo_envio">Tipo de Envio:</label>
            <select name="tipo_envio" id="tipo_envio" required>
                <option value="ENTREGA A DOMICILIO">Entrega a Domicilio</option>
                <option value="RETIRO EN TIENDA">Retiro en tienda</option>
            
            </select><br><br>

            <label for="monto_total">Total:</label>
            <input type="number" name="monto_total" id="total" required><br><br>



            <button type="submit">Agregar Pedido</button>
        </form>
    </div>
</body>

</html>