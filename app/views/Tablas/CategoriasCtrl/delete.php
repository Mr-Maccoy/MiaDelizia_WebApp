<?php
// delete.php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_categoria = $_POST['id_categoria'];

    $query = "BEGIN pkg_categorias.eliminar_categoria(:id); END;";
    $stmt = oci_parse($conn, $query);
    oci_bind_by_name($stmt, ':id', $id_categoria, -1, SQLT_INT);

    if (oci_execute($stmt)) {
        oci_commit($conn);
        header("Location: /../Tablas/categorias.php?success=1");
        exit;
    } else {
        $e = oci_error($stmt);
        echo "Error al eliminar: " . $e['message'];
    }
    oci_free_statement($stmt);
    oci_close($conn);
}
?>