<?php
$conn = include_once __DIR__ . '/../../libraries/Database.php';


$id_cliente = $_POST['id_cliente'];


$sql = "DELETE FROM HR.CLIENTES WHERE ID_CLIENTE = :id_cliente";

$stmt = oci_parse($conn, $sql);


oci_bind_by_name($stmt, ':id_cliente', $id_cliente);


if (oci_execute($stmt)) {
    echo "Registro eliminado correctamente.";
} else {
    $e = oci_error($stmt);
    echo "Error al eliminar: " . $e['message'];
}


oci_free_statement($stmt);
oci_close($conn);
?>