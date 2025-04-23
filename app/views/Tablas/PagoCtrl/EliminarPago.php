<?php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';


$id_pago = (int)$_POST['id_pago'];
echo "ID a eliminar: " . $id_pago . "<br>";

$sql = "BEGIN pkg_pagos.eliminar_pago(:id_pago); END;";

$stmt = oci_parse($conn, $sql);


oci_bind_by_name($stmt, ':id_pago', $id_pago);


if (oci_execute($stmt)) {
    oci_commit($conn);
    echo "Registro eliminado correctamente.";
    header("Location: /../Tablas/pagos.php?success=1");
} else {
    $e = oci_error($stmt);
    echo "Error al eliminar: " . $e['message'];
}


oci_free_statement($stmt);
oci_close($conn);
?>
