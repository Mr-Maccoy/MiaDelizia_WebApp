<?php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';
$id_pedido = (int)$_POST['id_pedido'];

$query = "BEGIN pkg_facturas.obtener_factura_por_id(:id_pedido, :cursor); END;";
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
        <h2>Agregar Factura</h2>
        <form action="update.php" method="post">
            <input type="hidden" name="id_pedido" value="<?= $id_pedido ?>">

            <label>Pedido:</label>
            <input type="text" name="Pedido" value="<?= $row['id_pedido'] ?>" required><br><br>

            <label>Fecha:</label>
            <input type="text" name="Fecha" value="<?= $row['fecha_factura'] ?>" required><br><br>

            <label>total:</label>
            <input type="text" name="total" value="<?= $row['total'] ?>" required><br><br>

            <label>Estado:</label>
            <input type="email" name="Estado" value="<?= $row['estado_factura'] ?>" required><br><br>
            <option value="Pendiente">PENDIENTE</option>
            <option value="Enviado">PAGADA</option>
            <option value="Entregado">ANULADA</option>
            <button type="submit">Guardar Cambios</button>
        </form>






    </div>
</body>

</html>