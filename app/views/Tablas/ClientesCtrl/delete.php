<?php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';


$id_cliente = (int)$_POST['id_cliente'];
echo "ID a eliminar: " . $id_cliente . "<br>";

$sql = "DELETE FROM CLIENTES WHERE ID_CLIENTE = :id_cliente";

$stmt = oci_parse($conn, $sql);


oci_bind_by_name($stmt, ':id_cliente', $id_cliente);


if (oci_execute($stmt)) {
    oci_commit($conn);
    echo "Registro eliminado correctamente.";
    header("Location: /../Tablas/clientes.php?success=1");
} else {
    $e = oci_error($stmt);
    echo "Error al eliminar: " . $e['message'];
}


oci_free_statement($stmt);
oci_close($conn);
?>
