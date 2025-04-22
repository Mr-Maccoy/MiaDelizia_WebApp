<?php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';
$id_producto = (int)$_POST['id_producto'];


$query = "BEGIN pkg_productos.obtener_producto_por_id(:id_producto, :cursor); END;";
$stmt = oci_parse($conn, $query);
$cursor = oci_new_cursor($conn);
oci_bind_by_name($stmt, ':id_producto', $id_producto);
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
    <title>Editar Producto</title>
</head>

<body>
    <div class="Edit">
        <h2>Editar Producto</h2>
        <form action="update.php" method="post">
            <input type="hidden" name="id_producto" value="<?= $id_producto ?>">

            <label for="nombre">Nombre del Producto:</label>
            <input type="text" name="nombre" id="nombre" value="<?= $row['NOMBRE'] ?>" required><br><br>

            <label for="descripcion">Descripción:</label>
            <input type="text" name="descripcion" id="descripcion" value="<?= $row['DESCRIPCION'] ?>" required><br><br>

            <label for="precio">Precio:</label>
            <input type="text" name="precio" id="precio" value="<?= $row['PRECIO'] ?>" required><br><br>

            <label for="disponibilidad">Disponibilidad:</label>
            <select name="disponibilidad" id="disponibilidad" required>
                <option value="S" <?= $row['DISPONIBILIDAD'] == 'S' ? 'selected' : '' ?>>Sí</option>
                <option value="N" <?= $row['DISPONIBILIDAD'] == 'N' ? 'selected' : '' ?>>No</option>
            </select><br><br>

            <label for="id_categoria">Categoría:</label>
            <input type="number" name="id_categoria" id="id_categoria" value="<?= $row['ID_CATEGORIA'] ?>" required><br><br>

            <button type="submit">Guardar Cambios</button>
        </form>
    </div>
</body>

</html>