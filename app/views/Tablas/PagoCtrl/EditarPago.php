<?php
// EditarPago.php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';
$id_pago = (int)$_POST['id_pago'];

$query = "BEGIN pkg_pagos.obtener_pago_por_id(:id_pago, :cursor); END;";
$statement = oci_parse($conn, $query);
$cursor = oci_new_cursor($conn);
oci_bind_by_name($statement, ':id_pago', $id_pago, -1, SQLT_INT);
oci_bind_by_name($statement, ':cursor', $cursor, -1, OCI_B_CURSOR);
oci_execute($statement);
oci_execute($cursor);
$row = oci_fetch_assoc($cursor);
oci_free_statement($statement);
oci_free_statement($cursor);
oci_close($conn);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Pago</title>
</head>
<body>
    <h2>Editar Pago</h2>
    <form action="update.php" method="post">
        <input type="hidden" name="id_pago" value="<?= $id_pago ?>">

        <label>ID Pedido:</label>
        <input type="number" name="id_pedido" value="<?= $row['ID_PEDIDO'] ?>" disabled><br><br>

        <label>Monto:</label>
        <input type="number" step="0.01" name="monto" value="<?= $row['MONTO'] ?>" required><br><br>

        <label>Método de Pago:</label>
        <select name="metodo" required>
            <option value="TARJETA" <?= $row['METODO_PAGO'] == 'TARJETA' ? 'selected' : '' ?>>TARJETA</option>
            <option value="EFECTIVO" <?= $row['METODO_PAGO'] == 'EFECTIVO' ? 'selected' : '' ?>>EFECTIVO</option>
            <option value="TRANSFERENCIA" <?= $row['METODO_PAGO'] == 'TRANSFERENCIA' ? 'selected' : '' ?>>TRANSFERENCIA</option>
        </select><br><br>

        <label>Estado del Pago:</label>
        <select name="estado" required>
            <option value="PENDIENTE" <?= $row['ESTADO_PAGO'] == 'PENDIENTE' ? 'selected' : '' ?>>PENDIENTE</option>
            <option value="CONFIRMADO" <?= $row['ESTADO_PAGO'] == 'CONFIRMADO' ? 'selected' : '' ?>>CONFIRMADO</option>
            <option value="CANCELADO" <?= $row['ESTADO_PAGO'] == 'CANCELADO' ? 'selected' : '' ?>>CANCELADO</option>
        </select><br><br>

        <button type="submit">Actualizar Pago</button>
    </form>
</body>
</html>