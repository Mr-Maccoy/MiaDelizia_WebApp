<?php
// delete.php para pagos
$conn = include_once __DIR__ . '/../../../libraries/Database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_pago = $_POST['id_pago'];

    $query = "BEGIN pkg_pagos.eliminar_pago(:id_pago); END;";
    $stmt = oci_parse($conn, $query);
    oci_bind_by_name($stmt, ':id_pago', $id_pago, -1, SQLT_INT);

    if (oci_execute($stmt)) {
        oci_commit($conn);
        header("Location: /../Tablas/pagos.php?success=1");
        exit;
    } else {
        $e = oci_error($stmt);
        echo "Error al eliminar: " . $e['message'];
    }
    oci_free_statement($stmt);
    oci_close($conn);
}
?>