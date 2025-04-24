<?php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';


$id_cliente = (int)$_POST['id_factura'];
echo "ID a eliminar: " . $id_factura . "<br>";

$sql = "BEGIN pkg_categorias.eliminar_categoria(:id_categoria); END;";

$stmt = oci_parse($conn, $sql);


oci_bind_by_name($stmt, ':id_categoria', $id_categoria);


if (oci_execute($stmt)) {
    oci_commit($conn);
    echo "Registro eliminado correctamente.";
    header("Location: /../Tablas/categorias.php?success=1");
} else {
    $e = oci_error($stmt);
    echo "Error al eliminar: " . $e['message'];
}


oci_free_statement($stmt);
oci_close($conn);
?>

