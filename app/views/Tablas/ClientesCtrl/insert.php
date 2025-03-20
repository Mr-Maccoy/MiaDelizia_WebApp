<?php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';

//Aca guardamos lo que metimos en el form en variables de php

$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$direccion = $_POST['direccion'];
$tipo = $_POST['tipo'];
$nacimiento = $_POST['nacimiento'];


//Aqui hacemos la sentencia sql para mandar los datos a las BD

$sql= "INSERT INTO CLIENTES (NOMBRE, TELEFONO, CORREO_ELECTRONICO, DIRECCION, TIPO_CLIENTE, FECHA_NACIMIENTO) 
VALUES (:nombre, :telefono, :correo, :direccion, :tipo, TO_DATE(:nacimiento, 'YYYY-MM-DD'))";
       
$stmt = oci_parse($conn, $sql);



oci_bind_by_name($stmt, ':nombre', $nombre);
oci_bind_by_name($stmt, ':telefono', $telefono);
oci_bind_by_name($stmt, ':correo', $correo);
oci_bind_by_name($stmt, ':direccion', $direccion);
oci_bind_by_name($stmt, ':tipo', $tipo);
oci_bind_by_name($stmt, ':nacimiento', $nacimiento);

if (oci_execute($stmt)) {
    oci_commit($conn);
    echo "Registro agregado correctamente.";
    header("Location: /../Tablas/clientes.php?success=1");
} else {
    $e = oci_error($stmt);
    echo "Error al insertar: " . $e['message'];
}

// Cerrar conexión
oci_free_statement($stmt);
oci_close($conn);
?>