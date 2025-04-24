<?php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';

//Aca guardamos lo que metimos en el form en variables de php

$id_categoria = (int)$_POST['id_categoria']; // ID del cliente que se va a actualizar
$nombre_categoria = $_POST['nombre_categoria'];
$descripcion_categoria = $_POST['descripcion_categoria'];

$sql= "BEGIN pkg_facturas.insertar_categoria(:id_categoria, :nombre_categoria, :descripcion_categoria); END;";

$stmt = oci_parse($conn, $sql);



oci_bind_by_name($stmt, ':id_categoria', $id_categoria);
oci_bind_by_name($stmt, ':nombre_categoria', $nombre_categoria);
oci_bind_by_name($stmt, ':descripcion_categoria', $descripcion_categoria);

if (oci_execute($stmt)) {
    oci_commit($conn);
    echo "Registro agregado correctamente.";
    header("Location: /../Tablas/categorias.php?success=1");
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
