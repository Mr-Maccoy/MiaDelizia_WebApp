<?php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id_inventario = $_POST['id_inventario'];
    $cantidad_disponible = $_POST['cantidad'];

    $sql = "BEGIN pkg_inventario.actualizar_inventario(:id_inventario, :id_producto, :cantidad_disponible, SYSDATE); END;";
    
    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ':id_inventario', $id_inventario);
    oci_bind_by_name($stmt, ':cantidad_disponible', $cantidad_disponible);
    
    $id_producto = $_POST['id_producto'];
    oci_bind_by_name($stmt, ':id_producto', $id_producto);

    if (oci_execute($stmt)) {
        echo "Inventario actualizado correctamente.";
        header("Location: /../Tablas/inventario.php?success=1");
    } else {
        $e = oci_error($stmt);
        echo "Error al actualizar el inventario: " . $e['message'];
    }

    oci_free_statement($stmt);
    oci_close($conn);
}
?>

