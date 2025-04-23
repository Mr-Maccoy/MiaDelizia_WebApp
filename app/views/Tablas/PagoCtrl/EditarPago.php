<?php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';
$id_cliente = (int)$_POST['id_pedido'];

$query = "BEGIN pkg_pagos.obtener_pago_por_id(:id_pedido, :cursor); END;";
$stmt = oci_parse($conn, $query);
$cursor = oci_new_cursor($conn);
oci_bind_by_name($stmt, ':id_pedido', $id_pedido);
oci_bind_by_name($stmt, ':cursor', $cursor, -1, OCI_B_CURSOR);
oci_execute($stmt);
oci_execute($cursor);
$row = oci_fetch_assoc($cursor);
oci_free_statement($stmt);
oci_free_statement($cursor);
oci_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="Edit">
    <h2>Editar Pago</h2>
    <form action="update.php" method="post">

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

            <button type="submit">Guardar Cambios</button>
        </form>





    </div>
</body>

</html>
