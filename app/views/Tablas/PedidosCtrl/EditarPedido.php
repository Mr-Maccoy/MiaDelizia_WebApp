<?php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';
$id_pedido = (int)$_POST['id_pedido']; // Se obtiene el ID del pedido a editar

$query = "BEGIN pkg_pedidos.obtener_pedido_por_id(:id_pedido, :cursor); END;";
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
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pedido</title>
</head>

<body>
    <div class="Edit">
        <h2>Editar Pedido</h2>
        <form action="update.php" method="post">
            <input type="hidden" name="id_pedido" value="<?= $id_pedido ?>">
            
            <label>ID Cliente:</label>
            <input type="number" name="id_cliente" value="<?= $row['ID_CLIENTE'] ?>" required><br><br>


            <label>Estado del Pedido:</label>
            <input type="text" name="estado_pedido" value="<?= $row['ESTADO_PEDIDO'] ?>" required><br><br>


            <label>Fecha de Entrega:</label>
            <input type="date" name="fecha_entrega" value="<?= date('Y-m-d', strtotime($row['FECHA_ENTREGA'])) ?>" required><br><br>

            <label>Tipo de Envío:</label>
            <input type="text" name="tipo_envio" value="<?= $row['TIPO_ENVIO'] ?>" required><br><br>

            <label>Monto Total:</label>
            <input type="number" name="monto_total" value="<?= $row['MONTO_TOTAL'] ?>" required><br><br>

            <button type="submit">Guardar Cambios</button>
        </form>


    </div>
</body>

</html>
