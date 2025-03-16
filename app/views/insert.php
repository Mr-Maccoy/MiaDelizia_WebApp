<?php
$conn = include_once __DIR__ . '/../libraries/Database.php';

//Aca guardamos lo que metimos en el form en variables de php

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];

//Aqui hacemos la sentencia sql para mandar los datos a las BD

$sql= "INSERT INTO HR.CLIENTES (ID_CLIENTE, NOMBRE_CLIENTE, CORREO_CLIENTE, TELEFONO_CLIENTE) 
       VALUES (HR.CLIENTES_SEQ.NEXTVAL, :nombre, :correo, :telefono)";
       
$stmt = oci_parse($conn, $sql);



oci_bind_by_name($stmt, ':nombre', $nombre);
oci_bind_by_name($stmt, ':correo', $correo);
oci_bind_by_name($stmt, ':telefono', $telefono);

if (oci_execute($stmt)) {
    echo "Registro agregado correctamente.";
} else {
    $e = oci_error($stmt);
    echo "Error al insertar: " . $e['message'];
}

// Cerrar conexión
oci_free_statement($stmt);
oci_close($conn);
?>