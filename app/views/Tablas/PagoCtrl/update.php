<?php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';

// Variables recibidas del formulario
$id_pedido = $_POST['id_pedido'];
$monto = $_POST['monto'];
$metodo_pago = $_POST['metodo_pago'];
$estado_pago = $_POST['estado_pago'];

// Sentencia SQL para actualizar
$sql= "BEGIN pkg_pagos.actualizar_pago(:id_pedido, :monto, :metodo_pago, :estado_pago); END;";

$stmt = oci_parse($conn, $sql);

// Asociar variables a los parámetros de la consulta
oci_bind_by_name($stmt, ':id_pedido', $id_pedido);
oci_bind_by_name($stmt, ':monto', $monto);
oci_bind_by_name($stmt, ':metodo_pago', $metodo_pago);
oci_bind_by_name($stmt, ':estado_pago', $estado_pago);

// Ejecutar la consulta
if (oci_execute($stmt)) {
    oci_commit($conn);
    echo "Registro actualizado correctamente.";
    header("Location: /../Tablas/pagos.php?success=1");
} else {
    $e = oci_error($stmt);
    echo "Error al actualizar: " . $e['message'];
}

// Cerrar la conexión
oci_free_statement($stmt);
oci_close($conn);
?>
