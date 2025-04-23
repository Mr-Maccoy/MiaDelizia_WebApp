<?php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_detalle = $_POST['id_detalle'];

    $query = "BEGIN pkg_detalle_pedido.eliminar_detalle(:id_detalle); END;";
    $stmt = oci_parse($conn, $query);

    oci_bind_by_name($stmt, ':id_detalle', $id_detalle, -1, SQLT_INT);

    if (oci_execute($stmt)) {
        oci_commit($conn);
        header("Location: /../Tablas/detallePedido.php?success=1");
        exit;
    } else {
        $e = oci_error($stmt);
        echo "❌ Error al eliminar el detalle: " . $e['message'];
    }

    oci_free_statement($stmt);
    oci_close($conn);
}
?>
