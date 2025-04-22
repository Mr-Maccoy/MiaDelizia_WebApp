<?php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_inventario = $_POST['id_inventario'];

    $query = "BEGIN pkg_inventario.eliminar_inventario(:id_inventario); END;";
    $stmt = oci_parse($conn, $query);

    oci_bind_by_name($stmt, ':id_inventario', $id_inventario);

    if (oci_execute($stmt)) {
        echo "Inventario eliminado correctamente.";
        header("Location: /../Tablas/inventario.php?success=1");
    } else {
        $e = oci_error($stmt);
        echo "Error al eliminar el inventario: " . $e['message'];
    }

    oci_free_statement($stmt);
    oci_close($conn);
}
?>

