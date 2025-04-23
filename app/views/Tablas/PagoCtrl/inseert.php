<?php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';

//Aca guardamos lo que metimos en el form en variables de php

$id_pedido = $_POST['id_pedido'];
$monto = $_POST['monto'];
$metodo = $_POST['metodo'];
$estado = $_POST['estado'];



//Aqui hacemos la sentencia sql para mandar los datos a las BD

$sql= "BEGIN pkg_pagos.insertar_pago(:id_pedido, :monto, :metodo, :estado); END;";
       
$stmt = oci_parse($conn, $sql);



oci_bind_by_name($stmt, ':id_pedido', $id_pedido);
oci_bind_by_name($stmt, ':monto', $monto);
oci_bind_by_name($stmt, ':metodo', $metodo);
oci_bind_by_name($stmt, ':estado', $estado);

if (oci_execute($stmt)) {
    oci_commit($conn);
    echo "Registro agregado correctamente.";
    header("Location: /../Tablas/pagos.php?success=1");
} else {
    $e = oci_error($stmt);
    echo "Error al insertar: " . $e['message'];
}

// Cerrar conexión
oci_free_statement($stmt);
oci_close($conn);
?>
