<?php
// update.php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';
$id_usuario = $_POST['id_usuario'];
$id_rol = $_POST['id_rol'];
$nombre_usuario = $_POST['nombre_usuario'];
$clave = $_POST['clave'];
$email = $_POST['email'];

$query = "BEGIN pkg_usuarios.actualizar_usuario(:id_usuario, :id_rol, :nombre_usuario, :clave, :email); END;";
$stmt = oci_parse($conn, $query);
oci_bind_by_name($stmt, ':id_usuario', $id_usuario);
oci_bind_by_name($stmt, ':id_rol', $id_rol);
oci_bind_by_name($stmt, ':nombre_usuario', $nombre_usuario);
oci_bind_by_name($stmt, ':clave', $clave);
oci_bind_by_name($stmt, ':email', $email);

if (oci_execute($stmt)) {
    oci_commit($conn);
    header("Location: /../Tablas/usuarios.php?success=1");
    exit;
} else {
    $e = oci_error($stmt);
    echo "Error al actualizar: " . $e['message'];
}
oci_free_statement($stmt);
oci_close($conn);
?>