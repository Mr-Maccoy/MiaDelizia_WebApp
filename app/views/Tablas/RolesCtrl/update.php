<?php
// update.php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';
$id_rol = (int)$_POST['id_rol'];
$nombre_rol = $_POST['nombre_rol'];

$query = "BEGIN pkg_roles.actualizar_rol(:id_rol, :nombre_rol); END;";
$stmt = oci_parse($conn, $query);
oci_bind_by_name($stmt, ':id_rol', $id_rol);
oci_bind_by_name($stmt, ':nombre_rol', $nombre_rol);

if (oci_execute($stmt)) {
    oci_commit($conn);
    header("Location: /../Tablas/roles.php?success=1");
    exit;
} else {
    $e = oci_error($stmt);
    echo "Error al actualizar: " . $e['message'];
}
oci_free_statement($stmt);
oci_close($conn);
?>