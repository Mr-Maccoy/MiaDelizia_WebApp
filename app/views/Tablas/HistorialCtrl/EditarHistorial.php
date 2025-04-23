<?php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';
$id_historial = (int)$_POST['id_historial'];

$query = "BEGIN pkg_historial_estado.obtener_historial_por_id(:id_historial, :cursor); END;";
$statement = oci_parse($conn, $query);
$cursor = oci_new_cursor($conn);
oci_bind_by_name($statement, ':id_historial', $id_historial, -1, SQLT_INT);
oci_bind_by_name($statement, ':cursor', $cursor, -1, OCI_B_CURSOR);

oci_execute($statement);
oci_execute($cursor);
$row = oci_fetch_assoc($cursor);

oci_free_statement($statement);
oci_free_statement($cursor);
oci_close($conn);
?>

<form action="update.php" method="post">
    <input type="hidden" name="id_historial" value="<?= $id_historial ?>">

    <label>ID Pedido:</label>
    <input type="number" value="<?= $row['ID_PEDIDO'] ?>" disabled><br><br>

    <label>Estado:</label>
    <select name="estado" required>
        <option value="EN ESPERA" <?= $row['ESTADO'] == 'EN ESPERA' ? 'selected' : '' ?>>EN ESPERA</option>
        <option value="EN PROCESO" <?= $row['ESTADO'] == 'EN PROCESO' ? 'selected' : '' ?>>EN PROCESO</option>
        <option value="COMPLETADO" <?= $row['ESTADO'] == 'COMPLETADO' ? 'selected' : '' ?>>COMPLETADO</option>
        <option value="CANCELADO" <?= $row['ESTADO'] == 'CANCELADO' ? 'selected' : '' ?>>CANCELADO</option>
    </select><br><br>

    <button type="submit">Actualizar Historial</button>
</form>
    </div>
</body>

</html>
