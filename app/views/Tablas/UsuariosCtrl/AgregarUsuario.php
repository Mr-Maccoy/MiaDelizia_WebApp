<?php
// AgregarUsuario.php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_rol = $_POST['id_rol'];
    $nombre_usuario = $_POST['nombre_usuario'];
    $clave = $_POST['clave'];
    $email = $_POST['email'];

    $query = "BEGIN pkg_usuarios.insertar_usuario(:id_rol, :nombre_usuario, :clave, :email); END;";
    $stmt = oci_parse($conn, $query);
    oci_bind_by_name($stmt, ':id_rol', $id_rol);
    oci_bind_by_name($stmt, ':nombre_usuario', $nombre_usuario);
    oci_bind_by_name($stmt, ':clave', $clave);
    oci_bind_by_name($stmt, ':email', $email);

    if (oci_execute($stmt)) {
        oci_commit($conn);
        header("Location: /../Tablas/usuarios.php?success=1");
        exit;
    } else {
        $e = oci_error($stmt);
        echo "Error al insertar: " . $e['message'];
    }
    oci_free_statement($stmt);
    oci_close($conn);
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Usuario</title>
</head>
<body>
    <h2>Agregar Usuario</h2>
    <form method="post">
        <label>ID Rol:</label>
        <input type="number" name="id_rol" required><br><br>
        <label>Nombre de Usuario:</label>
        <input type="text" name="nombre_usuario" required><br><br>
        <label>Clave:</label>
        <input type="password" name="clave" required><br><br>
        <label>Email:</label>
        <input type="email" name="email" required><br><br>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>