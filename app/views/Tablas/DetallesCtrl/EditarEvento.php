<?php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';
$id_detalle = (int)$_POST['id_detalle'];

$query = "BEGIN pkg_detalle_pedido.obtener_detalle_por_id(:id_detalle, :cursor); END;";
$statement = oci_parse($conn, $query);

$cursor = oci_new_cursor($conn);

oci_bind_by_name($statement, ':id_detalle', $id_detalle, -1, SQLT_INT);
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
    <title>Editar Detalle de Pedido</title>
</head>

<body>
    <div class="Edit">
        <h2>Editar Detalle de Pedido</h2>
        <form action="update.php" method="post">
            <input type="hidden" name="id_detalle" value="<?= $id_detalle ?>">

            <label>ID Pedido:</label>
            <input type="number" name="id_pedido" value="<?= $row['ID_PEDIDO'] ?>" required><br><br>

            <label>ID Producto:</label>
            <input type="number" name="id_producto" value="<?= $row['ID_PRODUCTO'] ?>" required><br><br>

            <label>Cantidad:</label>
            <input type="number" name="cantidad" value="<?= $row['CANTIDAD'] ?>" required><br><br>

            <label>Precio Unitario:</label>
            <input type="number" name="precio_unitario" step="0.01" value="<?= $row['PRECIO_UNITARIO'] ?>" required><br><br>

            <button type="submit">Guardar Cambios</button>
        </form>
    </div>
</body>

</html>
