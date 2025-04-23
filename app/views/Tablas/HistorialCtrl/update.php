<?php

$conn = include_once __DIR__ . '/../../../libraries/Database.php';

$id_historial = $_POST['id_historial'];
$estado = $_POST['estado'];

$query = "BEGIN pkg_historial_estado.actualizar_historial(:id_historial, :estado); END;";
$stmt = oci_parse($conn, $query);

oci_bind_by_name($stmt, ':id_historial', $id_historial);
oci_bind_by_name($stmt, ':estado', $estado);

if (oci_execute($stmt)) {
    oci_commit($conn);
    header("Location: /../Tablas/histEstadoPedido.php?success=1");
    exit;
} else {
    $e = oci_error($stmt);
    echo "Error al actualizar: " . $e['message'];
}

oci_free_statement($stmt);
oci_close($conn);
?>
