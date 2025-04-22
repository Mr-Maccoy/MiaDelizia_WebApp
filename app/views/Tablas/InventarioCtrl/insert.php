<?php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id_producto = $_POST['id_producto'];
    $cantidad_disponible = $_POST['cantidad'];

    $sql = "BEGIN pkg_inventario.insertar_inventario(:id_producto, :cantidad_disponible, SYSDATE); END;";
    
    $stmt = oci_parse($conn, $sql);

    oci_bind_by_name($stmt, ':id_producto', $id_producto);
    oci_bind_by_name($stmt, ':cantidad_disponible', $cantidad_disponible);

    if (oci_execute($stmt)) {
        echo "Inventario agregado correctamente.";
    } else {
        $e = oci_error($stmt);
        echo "Error al agregar el inventario: " . $e['message'];
    }

    oci_free_statement($stmt);
    oci_close($conn);
}
?>

<form action="insert_inventario.php" method="POST">
    <label for="id_producto">ID Producto:</label>
    <input type="number" name="id_producto" required><br>

    <label for="cantidad">Cantidad Disponible:</label>
    <input type="number" name="cantidad" required><br>

    <input type="submit" value="Agregar Inventario">
</form>
