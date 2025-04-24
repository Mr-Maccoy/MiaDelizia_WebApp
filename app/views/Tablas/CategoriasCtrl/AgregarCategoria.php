<?php
// AgregarCategoria.php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre_categoria'];
    $descripcion = $_POST['descripcion_categoria'];

    $query = "BEGIN pkg_categorias.insertar_categoria(:nombre, :descripcion); END;";
    $stmt = oci_parse($conn, $query);
    oci_bind_by_name($stmt, ':nombre', $nombre);
    oci_bind_by_name($stmt, ':descripcion', $descripcion);

    if (oci_execute($stmt)) {
        oci_commit($conn);
        header("Location: /../Tablas/categorias.php?success=1");
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
    <title>Agregar Categoría</title>
</head>
<body>
    <h2>Agregar Categoría</h2>
    <form method="post">
        <label>Nombre:</label>
        <input type="text" name="nombre_categoria" required><br><br>

        <label>Descripción:</label>
        <input type="text" name="descripcion_categoria"><br><br>

        <button type="submit">Guardar</button>
    </form>
</body>
</html>
