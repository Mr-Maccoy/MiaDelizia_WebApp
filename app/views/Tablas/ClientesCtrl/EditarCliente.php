<?php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';
$id_cliente = (int)$_POST['id_cliente'];

$query = "BEGIN pkg_clientes.obtener_cliente_por_id(:id_cliente, :cursor); END;";
$stmt = oci_parse($conn, $query);
$cursor = oci_new_cursor($conn);
oci_bind_by_name($stmt, ':id_cliente', $id_cliente);
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
        <h2>Agregar Cliente</h2>
        <form action="update.php" method="post">
            <input type="hidden" name="id_cliente" value="<?= $id_cliente ?>">

            <label>Nombre:</label>
            <input type="text" name="nombre" value="<?= $row['NOMBRE'] ?>" required><br><br>

            <label>Teléfono:</label>
            <input type="text" name="telefono" value="<?= $row['TELEFONO'] ?>" required><br><br>

            <label>Correo:</label>
            <input type="email" name="correo" value="<?= $row['CORREO_ELECTRONICO'] ?>" required><br><br>

            <label>Dirección:</label>
            <input type="text" name="direccion" value="<?= $row['DIRECCION'] ?>" required><br><br>

            <label>Tipo:</label>
            <select name="tipo" id="tipo" required>
                <option value="nuevo" <?= $row['TIPO_CLIENTE'] == 'nuevo' ? 'selected' : '' ?>>Nuevo</option>
                <option value="recurrente" <?= $row['TIPO_CLIENTE'] == 'recurrente' ? 'selected' : '' ?>>Recurrente</option>
                <option value="VIP" <?= $row['TIPO_CLIENTE'] == 'VIP' ? 'selected' : '' ?>>VIP</option>
            </select><br><br>

            <label>Nacimiento:</label>
            <input type="date" name="nacimiento" value="<?= date('Y-m-d', strtotime($row['FECHA_NACIMIENTO'])) ?>" required><br><br>

            <button type="submit">Guardar Cambios</button>
        </form>






    </div>
</body>

</html>