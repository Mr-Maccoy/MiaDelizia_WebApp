<?php
// update.php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';

$id_categoria = $_POST['id_categoria'];
$nombre = $_POST['nombre_categoria'];
$descripcion = $_POST['descripcion_categoria'];

$query = "BEGIN pkg_categorias.actualizar_categoria(:id, :nombre, :descripcion); END;";
$stmt = oci_parse($conn, $query);
oci_bind_by_name($stmt, ':id', $id_categoria);
oci_bind_by_name($stmt, ':nombre', $nombre);
oci_bind_by_name($stmt, ':descripcion', $descripcion);

if (oci_execute($stmt)) {
    oci_commit($conn);
    header("Location: /../Tablas/categorias.php?success=1");
    exit;
} else {
    $e = oci_error($stmt);
    echo "Error al actualizar: " . $e['message'];
}
oci_free_statement($stmt);
oci_close($conn);
?>

