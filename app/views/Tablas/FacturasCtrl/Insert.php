<?php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';

//Aca guardamos lo que metimos en el form en variables de php

$pedido = $_POST['id_pedido'];
$fecha_factura = $_POST['fecha_factura'];
$total = $_POST['total'];
$estado_factura = $_POST['estado_factura'];

$sql= "BEGIN pkg_facturas.insertar_factura(:id_pedido, :fecha_factura, :total, :estado_factura); END;";
       
$stmt = oci_parse($conn, $sql);



oci_bind_by_name($stmt, ':id_pedido', $pedido);
oci_bind_by_name($stmt, ':fecha_factura', $fecha_factura);
oci_bind_by_name($stmt, ':total', $total);
oci_bind_by_name($stmt, ':estado_factura', $estado_factura);

if (oci_execute($stmt)) {
    oci_commit($conn);
    echo "Registro agregado correctamente.";
    header("Location: /../Tablas/facturas.php?success=1");
} else {
    $e = oci_error($stmt);
    echo "Error al insertar: " . $e['message'];
}

// Cerrar conexión
oci_free_statement($stmt);
oci_close($conn);


?>
</body>
</html>