<?php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';


$id_cliente = (int)$_POST['id_pedido'];
echo "ID a eliminar: " . $id_pedido . "<br>";

$sql = "BEGIN pkg_facturas.eliminar_factura(:id_pedido); END;";

$stmt = oci_parse($conn, $sql);


oci_bind_by_name($stmt, ':id_pedido', $id_pedido);


if (oci_execute($stmt)) {
    oci_commit($conn);
    echo "Registro eliminado correctamente.";
    header("Location: /../Tablas/facturas.php?success=1");
} else {
    $e = oci_error($stmt);
    echo "Error al eliminar: " . $e['message'];
}


oci_free_statement($stmt);
oci_close($conn);
?>