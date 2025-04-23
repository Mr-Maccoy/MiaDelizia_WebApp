<?php
// EditarRol.php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';
$id_rol = (int)$_POST['id_rol'];

$query = "BEGIN pkg_roles.obtener_rol_por_id(:id_rol, :cursor); END;";
$statement = oci_parse($conn, $query);
$cursor = oci_new_cursor($conn);
oci_bind_by_name($statement, ':id_rol', $id_rol, -1, SQLT_INT);
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
    <title>Editar Rol</title>
</head>
<body>
    <h2>Editar Rol</h2>
    <form action="update.php" method="post">
        <input type="hidden" name="id_rol" value="<?= $id_rol ?>">
        <label>Nombre del Rol:</label>
        <select name="nombre_rol" required>
            <option value="ADMINISTRADOR" <?= $row['NOMBRE_ROL'] == 'ADMINISTRADOR' ? 'selected' : '' ?>>ADMINISTRADOR</option>
            <option value="VENDEDOR" <?= $row['NOMBRE_ROL'] == 'VENDEDOR' ? 'selected' : '' ?>>VENDEDOR</option>
        </select>
        <br><br>
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>
