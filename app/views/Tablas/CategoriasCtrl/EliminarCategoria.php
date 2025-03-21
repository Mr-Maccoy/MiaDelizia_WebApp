<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_categoria'])) {
    $conn = include_once __DIR__ . '/../../libraries/Database.php';
    $id_categoria = $_POST['id_categoria'];

    $query = "DELETE FROM CATEGORIAS WHERE ID_CATEGORIA = :id_categoria";
    $statement = oci_parse($conn, $query);
    oci_bind_by_name($statement, ':id_categoria', $id_categoria);

    if (!oci_execute($statement)) {
        $e = oci_error($statement);
        die("Error al eliminar la categoría: " . $e['message']);
    }

    echo "Categoría eliminada exitosamente.";
    oci_free_statement($statement);
    oci_close($conn);
}
?>