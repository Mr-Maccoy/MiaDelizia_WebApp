<?php
// Conexión a la base de datos
$conn = include_once __DIR__ . '/../../../libraries/Database.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") 
    

$id_cliente = (int)$_POST['id_cliente'];
$fecha_pedido = $_POST['fecha_pedido'];
$estado_pedido = $_POST['estado_pedido'];
$fecha_entrega = $_POST['fecha_entrega'];
$tipo_envio = $_POST['tipo_envio'];
$monto_total = (float)$_POST['monto_total'];
    

$sql = "BEGIN pkg_pedidos.insertar_pedido(:id_cliente, TO_DATE(:fecha_pedido, 'YYYY-MM-DD'), :estado_pedido, TO_DATE(:fecha_entrega, 'YYYY-MM-DD'), :tipo_envio, :monto_total); END;";
$stmt = oci_parse($conn, $sql);


oci_bind_by_name($stmt, ':id_cliente', $id_cliente);
oci_bind_by_name($stmt, ':fecha_pedido', $fecha_pedido);
oci_bind_by_name($stmt, ':estado_pedido', $estado_pedido);
oci_bind_by_name($stmt, ':fecha_entrega', $fecha_entrega);
oci_bind_by_name($stmt, ':tipo_envio', $tipo_envio);
oci_bind_by_name($stmt, ':monto_total', $monto_total);

if (oci_execute($stmt)) {
oci_commit($conn);
echo "Registro agregado correctamente.";
header("Location: /../Tablas/pedidos.php?success=1");
} else {
$e = oci_error($stmt);
echo "Error al insertar: " . $e['message'];
}


// Cerrar conexión
oci_free_statement($stmt);
oci_close($conn);
