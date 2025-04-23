<?php
// delete.php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_rol = (int)$_POST['id_rol'];

    $query = "BEGIN pkg_roles.eliminar_rol(:id_rol); END;";
    $stmt = oci_parse($conn, $query);
    oci_bind_by_name($stmt, ':id_rol', $id_rol, -1, SQLT_INT);

    if (oci_execute($stmt)) {
        oci_commit($conn);
        header("Location: /../Tablas/roles.php?success=1");
        exit;
    } else {
        $e = oci_error($stmt);
        echo "Error al eliminar: " . $e['message'];
    }
    oci_free_statement($stmt);
    oci_close($conn);
}
?>