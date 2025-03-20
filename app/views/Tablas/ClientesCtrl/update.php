<?php
$conn = include_once __DIR__ . '/../../libraries/Database.php';

// Variables recibidas del formulario
$id_cliente = $_POST['id_cliente']; // ID del cliente que se va a actualizar
$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$direccion = $_POST['direccion'];
$tipo = $_POST['tipo'];
$nacimiento = $_POST['nacimiento'];

// Sentencia SQL para actualizar
$sql = "UPDATE HR.CLIENTES 
        SET NOMBRE = :nombre, 
            TELEFONO = :telefono, 
            CORREO_ELECTRONICO = :correo, 
            DIRECCION = :direccion, 
            TIPO_CLIENTE = :tipo, 
            FECHA_NACIMIENTO = :nacimiento 
        WHERE ID_CLIENTE = :id_cliente";

$stmt = oci_parse($conn, $sql);

// Asociar variables a los parámetros de la consulta
oci_bind_by_name($stmt, ':id_cliente', $id_cliente);
oci_bind_by_name($stmt, ':nombre', $nombre);
oci_bind_by_name($stmt, ':telefono', $telefono);
oci_bind_by_name($stmt, ':correo', $correo);
oci_bind_by_name($stmt, ':direccion', $direccion);
oci_bind_by_name($stmt, ':tipo', $tipo);
oci_bind_by_name($stmt, ':nacimiento', $nacimiento);

// Ejecutar la consulta
if (oci_execute($stmt)) {
    echo "Registro actualizado correctamente.";
} else {
    $e = oci_error($stmt);
    echo "Error al actualizar: " . $e['message'];
}

// Cerrar la conexión
oci_free_statement($stmt);
oci_close($conn);
?>