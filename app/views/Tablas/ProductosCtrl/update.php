<?php
// Conexión a la base de datos
$conn = include_once __DIR__ . '/../../../libraries/Database.php';

$id_producto = (int)$_POST['id_producto']; 
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$disponibilidad = $_POST['disponibilidad'];
$id_categoria = $_POST['id_categoria'];


$sql = "BEGIN pkg_productos.actualizar_producto(:id_producto, :nombre, :descripcion, :precio, :disponibilidad, :id_categoria); END;";

$stmt = oci_parse($conn, $sql);


oci_bind_by_name($stmt, ':id_producto', $id_producto);
oci_bind_by_name($stmt, ':nombre', $nombre);
oci_bind_by_name($stmt, ':descripcion', $descripcion);
oci_bind_by_name($stmt, ':precio', $precio);
oci_bind_by_name($stmt, ':disponibilidad', $disponibilidad);
oci_bind_by_name($stmt, ':id_categoria', $id_categoria);


if (oci_execute($stmt)) {
    oci_commit($conn);
    echo "Producto actualizado correctamente.";
    header("Location: /../Tablas/productos.php?success=1");
} else {
    $e = oci_error($stmt);
    echo "Error al actualizar el producto: " . $e['message'];
}
    
    // Cerrar la conexión
    oci_free_statement($stmt);
    oci_close($conn);
    ?>
    

