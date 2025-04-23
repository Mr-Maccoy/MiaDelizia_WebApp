<?php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pedido = $_POST['id_pedido'];
    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];
    $precio_unitario = $_POST['precio_unitario'];

    $query = "BEGIN pkg_detalle_pedido.agregar_detalle(:id_pedido, :id_producto, :cantidad, :precio_unitario); END;";
    $stmt = oci_parse($conn, $query);

    oci_bind_by_name($stmt, ':id_pedido', $id_pedido);
    oci_bind_by_name($stmt, ':id_producto', $id_producto);
    oci_bind_by_name($stmt, ':cantidad', $cantidad);
    oci_bind_by_name($stmt, ':precio_unitario', $precio_unitario);

    if (oci_execute($stmt)) {
        oci_commit($conn);
        header("Location: /../Tablas/detallePedido.php?success=1");
        exit;
    } else {
        $e = oci_error($stmt);
        echo "Error al agregar el detalle: " . $e['message'];
    }

    oci_free_statement($stmt);
    oci_close($conn);
}
?>
