<?php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';
$id_pedido = (int)$_POST['id_categoria'];

$query = "BEGIN pkg_categorias.obtener_categoria_por_id(:id_categoria, :cursor); END;";
$stmt = oci_parse($conn, $query);
$cursor = oci_new_cursor($conn);
oci_bind_by_name($stmt, ':id_categoria', $id_categoria);
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
    <title>Editar Categoría</title>
</head>

<body>
<div class="Edit">

    <h1>Editar Categoría</h1>
        <form action="update.php" method="post">
            <input type="hidden" name="id_categoria" value="<?= $id_categoria ?>">

            <label for="nombre_categoria">Nombre:</label>
            <input type="text" name="nombre_categoria" id="nombre_categoria" required><br><br>

        <label for="descripcion_categoria">Descripción:</label>
        <input type="text" id="descripcion_categoria" name="descripcion_categoria" required><br><br>

        <button type="submit">Actualizar</button>
    </form>
    </div>

</body>
</html>