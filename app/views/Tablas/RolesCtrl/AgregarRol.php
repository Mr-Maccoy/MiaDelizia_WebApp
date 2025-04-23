<?php
// AgregarRol.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = include_once __DIR__ . '/../../../libraries/Database.php';
    $nombre_rol = $_POST['nombre_rol'];

    $query = "BEGIN pkg_roles.insertar_rol(:nombre_rol); END;";
    $stmt = oci_parse($conn, $query);
    oci_bind_by_name($stmt, ':nombre_rol', $nombre_rol);

    if (oci_execute($stmt)) {
        oci_commit($conn);
        header("Location: /../Tablas/roles.php?success=1");
        exit;
    } else {
        $e = oci_error($stmt);
        echo "Error al insertar: " . $e['message'];
    }
    oci_free_statement($stmt);
    oci_close($conn);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Rol</title>
</head>
<body>
    <h2>Agregar Rol</h2>
    <form method="post">
        <label>Nombre del Rol:</label>
        <select name="nombre_rol" required>
            <option value="ADMINISTRADOR">ADMINISTRADOR</option>
            <option value="VENDEDOR">VENDEDOR</option>
        </select>
        <br><br>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>

<?php
