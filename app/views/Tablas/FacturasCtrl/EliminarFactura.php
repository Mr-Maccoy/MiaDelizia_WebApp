<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_factura'])) {
    $conn = include_once __DIR__ . '/../../libraries/Database.php';
    $id_factura = $_POST['id_factura'];

    $query = "DELETE FROM FACTURA WHERE ID_FACTURA = :id_factura";
    $statement = oci_parse($conn, $query);
    oci_bind_by_name($statement, ':id_factura', $id_factura);

    if (!oci_execute($statement)) {
        $e = oci_error($statement);
        die("Error al eliminar la factura: " . $e['message']);
    }

    echo "Factura eliminada exitosamente.";
    oci_free_statement($statement);
    oci_close($conn);
}
?>