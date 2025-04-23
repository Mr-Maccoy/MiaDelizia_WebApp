<?php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';

// Variables del formulario
$id_detalle = (int)$_POST['id_detalle'];
$id_pedido = (int)$_POST['id_pedido'];
$id_producto = (int)$_POST['id_producto'];
$cantidad = (int)$_POST['cantidad'];
$precio_unitario = (float)$_POST['precio_unitario'];

// Consulta para ejecutar el procedimiento
$sql = "BEGIN pkg_detalle_pedido.actualizar_detalle(:id_detalle, :id_pedido, :id_producto, :cantidad, :precio_unitario); END;";
$stmt = oci_parse($conn, $sql);

// Asociar los valores
oci_bind_by_name($stmt, ':id_detalle', $id_detalle);
oci_bind_by_name($stmt, ':id_pedido', $id_pedido);
oci_bind_by_name($stmt, ':id_producto', $id_producto);
oci_bind_by_name($stmt, ':cantidad', $cantidad);
oci_bind_by_name($stmt, ':precio_unitario', $precio_unitario);

// Ejecutar
if (oci_execute($stmt)) {
    oci_commit($conn);
    header("Location: /../Tablas/detallePedido.php?success=1");
    exit;
} else {
    $e = oci_error($stmt);
    echo "Error al actualizar: " . $e['message'];
}

oci_free_statement($stmt);
oci_close($conn);
?>
