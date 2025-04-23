<?php
// delete.php para historial_estado_pedido
$conn = include_once __DIR__ . '/../../../libraries/Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_historial = $_POST['id_historial'];

    $query = "BEGIN pkg_historial_estado.eliminar_historial(:id_historial); END;";
    $stmt = oci_parse($conn, $query);

    oci_bind_by_name($stmt, ':id_historial', $id_historial, -1, SQLT_INT);

    if (oci_execute($stmt)) {
        oci_commit($conn);
        header("Location: /../Tablas/histEstadoPedido.php?success=1");
        exit;
    } else {
        $e = oci_error($stmt);
        echo "Error al eliminar: " . $e['message'];
    }

    oci_free_statement($stmt);
    oci_close($conn);
}
?>