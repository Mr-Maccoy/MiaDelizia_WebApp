<?php
$conn = include_once __DIR__ . '/../../libraries/Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = $_POST['id_producto'];

    // Consulta para eliminar el producto
    $query = "DELETE FROM PRODUCTOS WHERE ID_PRODUCTO = :id_producto";
    $stmt = oci_parse($conn, $query);

    // Vincular los valores
    oci_bind_by_name($stmt, ':id_producto', $id_producto);

    // Ejecutar la consulta
    if (oci_execute($stmt)) {
        echo "Producto eliminado correctamente.";
    } else {
        $e = oci_error($stmt);
        echo "Error al eliminar el producto: " . $e['message'];
    }

    // Liberar los recursos y cerrar la conexión
    oci_free_statement($stmt);
    oci_close($conn);
}
?>

<form action="delete.php" method="POST">
    <label for="id_producto">ID Producto:</label>
    <input type="text" name="id_producto" required><br>
    <input type="submit" value="Eliminar Producto">
</form>
