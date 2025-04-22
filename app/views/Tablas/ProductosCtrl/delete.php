<?php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';


$id_producto = (int)$_POST['id_producto'];
echo "ID a eliminar: " . $id_producto . "<br>";


$sql = "BEGIN pkg_productos.eliminar_producto(:id_producto); END;";

$stmt = oci_parse($conn, $sql);

oci_bind_by_name($stmt, ':id_producto', $id_producto);

if (oci_execute($stmt)) {
    oci_commit($conn);
    echo "Producto eliminado correctamente.";
    header("Location: /../Tablas/productos.php?success=1");
} else {
    $e = oci_error($stmt);
    echo "Error al eliminar el producto: " . $e['message'];
}
    
    oci_free_statement($stmt);
    oci_close($conn);
    ?>
    