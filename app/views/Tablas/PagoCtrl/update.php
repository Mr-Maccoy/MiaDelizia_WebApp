<?php
// update.php para pagos
$conn = include_once __DIR__ . '/../../../libraries/Database.php';

$id_pago = $_POST['id_pago'];
$monto = $_POST['monto'];
$metodo = $_POST['metodo'];
$estado = $_POST['estado'];

$query = "BEGIN pkg_pagos.actualizar_pago(:id_pago, :monto, :metodo, :estado); END;";
$stmt = oci_parse($conn, $query);
oci_bind_by_name($stmt, ':id_pago', $id_pago);
oci_bind_by_name($stmt, ':monto', $monto);
oci_bind_by_name($stmt, ':metodo', $metodo);
oci_bind_by_name($stmt, ':estado', $estado);

if (oci_execute($stmt)) {
    oci_commit($conn);
    header("Location: /../Tablas/pagos.php?success=1");
    exit;
} else {
    $e = oci_error($stmt);
    echo "Error al actualizar: " . $e['message'];
}
oci_free_statement($stmt);
oci_close($conn);
?>