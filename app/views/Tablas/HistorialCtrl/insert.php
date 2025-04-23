<?php
// insert.php para historial_estado_pedido
$conn = include_once __DIR__ . '/../../../libraries/Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pedido = $_POST['id_pedido'];
    $estado = $_POST['estado'];

    $query = "BEGIN pkg_historial_estado.insertar_historial(:id_pedido, :estado); END;";
    $stmt = oci_parse($conn, $query);

    oci_bind_by_name($stmt, ':id_pedido', $id_pedido);
    oci_bind_by_name($stmt, ':estado', $estado);

    if (oci_execute($stmt)) {
        oci_commit($conn);
        header("Location: /../Tablas/histEstadoPedido.php?success=1");
        exit;
    } else {
        $e = oci_error($stmt);
        echo "Error al insertar: " . $e['message'];
    }

    oci_free_statement($stmt);
    oci_close($conn);
}
?>