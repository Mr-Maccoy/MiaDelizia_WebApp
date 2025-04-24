<?php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';

// Variables recibidas del formulario
$id_categoria = (int)$_POST['id_categoria']; // ID del cliente que se va a actualizar
$nombre_categoria = $_POST['nombre_categoria'];
$descripcion_categoria = $_POST['descripcion_categoria'];



// Sentencia SQL para actualizar
$sql = "BEGIN pkg_facturas.actualizar_categoria(:id_categoria, :nombre_categoria, :descripcion_categoria); END;";

$stmt = oci_parse($conn, $sql);

// Asociar variables a los parámetros de la consulta
oci_bind_by_name($stmt, ':id_categoria', $id_categoria);
oci_bind_by_name($stmt, ':nombre_categoria', $nombre_categoria);
oci_bind_by_name($stmt, ':descripcion_categoria', $descripcion_categoria);


// Ejecutar la consulta
if (oci_execute($stmt)) {
    oci_commit($conn);
    echo "Registro actualizado correctamente.";
    header("Location: /../Tablas/categorias.php?success=1");
} else {
    $e = oci_error($stmt);
    echo "Error al actualizar: " . $e['message'];
}

// Cerrar la conexión
oci_free_statement($stmt);
oci_close($conn);
?>
