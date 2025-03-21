<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_pago'])) {
    $conn = include_once __DIR__ . '/../../libraries/Database.php';
    $id_pago = $_POST['id_pago'];

    $query = "DELETE FROM PAGOS WHERE ID_PAGO = :id_pago";
    $statement = oci_parse($conn, $query);
    oci_bind_by_name($statement, ':id_pago', $id_pago);

    if (!oci_execute($statement)) {
        $e = oci_error($statement);
        die("Error al eliminar el pago: " . $e['message']);
    }

    echo "Pago eliminado exitosamente.";
    oci_free_statement($statement);
    oci_close($conn);
}
?>