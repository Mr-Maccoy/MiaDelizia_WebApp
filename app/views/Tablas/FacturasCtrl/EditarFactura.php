<?php
// EditarFactura.php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';
$id_factura = (int)$_POST['id_factura'];

$query = "BEGIN pkg_facturas.obtener_factura_por_id(:id_factura, :cursor); END;";
$statement = oci_parse($conn, $query);
$cursor = oci_new_cursor($conn);
oci_bind_by_name($statement, ':id_factura', $id_factura, -1, SQLT_INT);
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
    <title>Editar Factura</title>
</head>
<body>
    <h2>Editar Factura</h2>
    <form action="update.php" method="post">
        <input type="hidden" name="id_factura" value="<?= $id_factura ?>">

        <label>ID Pedido:</label>
        <input type="number" name="id_pedido" value="<?= $row['ID_PEDIDO'] ?>" required><br><br>

        <label>Total:</label>
        <input type="number" name="total" step="0.01" value="<?= $row['TOTAL'] ?>" required><br><br>

        <label>Estado:</label>
        <select name="estado" required>
            <option value="PENDIENTE" <?= $row['ESTADO_FACTURA'] == 'PENDIENTE' ? 'selected' : '' ?>>PENDIENTE</option>
            <option value="PAGADA" <?= $row['ESTADO_FACTURA'] == 'PAGADA' ? 'selected' : '' ?>>PAGADA</option>
            <option value="ANULADA" <?= $row['ESTADO_FACTURA'] == 'ANULADA' ? 'selected' : '' ?>>ANULADA</option>
        </select><br><br>

        <button type="submit">Actualizar</button>
    </form>
</body>
</html>