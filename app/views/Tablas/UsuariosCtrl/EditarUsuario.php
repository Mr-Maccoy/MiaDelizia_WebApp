<?php
// EditarUsuario.php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';
$id_usuario = (int)$_POST['id_usuario'];

$query = "BEGIN pkg_usuarios.obtener_usuario_por_id(:id_usuario, :cursor); END;";
$statement = oci_parse($conn, $query);
$cursor = oci_new_cursor($conn);
oci_bind_by_name($statement, ':id_usuario', $id_usuario, -1, SQLT_INT);
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
    <title>Editar Usuario</title>
</head>
<body>
    <h2>Editar Usuario</h2>
    <form action="update.php" method="post">
        <input type="hidden" name="id_usuario" value="<?= $id_usuario ?>">
        <label>ID Rol:</label>
        <input type="number" name="id_rol" value="<?= $row['ID_ROL'] ?>" required><br><br>
        <label>Nombre de Usuario:</label>
        <input type="text" name="nombre_usuario" value="<?= $row['NOMBRE_USUARIO'] ?>" required><br><br>
        <label>Clave:</label>
        <input type="text" name="clave" value="<?= $row['CLAVE'] ?>" required><br><br>
        <label>Email:</label>
        <input type="email" name="email" value="<?= $row['EMAIL'] ?>" required><br><br>
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>
