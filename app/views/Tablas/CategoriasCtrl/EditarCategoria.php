<?php
// EditarCategoria.php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';
$id_categoria = (int)$_POST['id_categoria'];

$query = "BEGIN pkg_categorias.obtener_categoria_por_id(:id_categoria, :cursor); END;";
$statement = oci_parse($conn, $query);
$cursor = oci_new_cursor($conn);
oci_bind_by_name($statement, ':id_categoria', $id_categoria, -1, SQLT_INT);
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
    <title>Editar Categoría</title>
</head>
<body>
    <h2>Editar Categoría</h2>
    <form action="update.php" method="post">
        <input type="hidden" name="id_categoria" value="<?= $id_categoria ?>">

        <label>Nombre:</label>
        <input type="text" name="nombre_categoria" value="<?= $row['NOMBRE_CATEGORIA'] ?>" required><br><br>

        <label>Descripción:</label>
        <input type="text" name="descripcion_categoria" value="<?= $row['DESCRIPCION_CATEGORIA'] ?>"><br><br>

        <button type="submit">Actualizar</button>
    </form>
</body>
</html>
