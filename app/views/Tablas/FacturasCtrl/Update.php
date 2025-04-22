<?php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';

// Variables recibidas del formulario
$id_pedido = (int)$_POST['id_pedido']; // ID del cliente que se va a actualizar
$fecha_factura = $_POST['fecha_factura'];
$total = $_POST['total'];
$estado_factura = $_POST['estado_factura'];


// Sentencia SQL para actualizar
$sql = "BEGIN pkg_facturas.actualizar_factura(:id_pedido, TO_DATE(:fecha_factura, 'YYYY-MM-DD'), :total, :estado_factura)); END;";

$stmt = oci_parse($conn, $sql);

// Asociar variables a los parámetros de la consulta
oci_bind_by_name($stmt, ':id_pedido', $id_pedido);
oci_bind_by_name($stmt, ':fecha_factura', $fecha_factura);
oci_bind_by_name($stmt, ':total', $total);
oci_bind_by_name($stmt, ':estado_factura', $estado_factura);


// Ejecutar la consulta
if (oci_execute($stmt)) {
    oci_commit($conn);
    echo "Registro actualizado correctamente.";
    header("Location: /../Tablas/facturas.php?success=1");
} else {
    $e = oci_error($stmt);
    echo "Error al actualizar: " . $e['message'];
}

// Cerrar la conexión
oci_free_statement($stmt);
oci_close($conn);
?>

