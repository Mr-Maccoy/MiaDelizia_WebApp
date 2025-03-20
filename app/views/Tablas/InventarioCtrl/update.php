<?php
$conn = include_once __DIR__ . '/../../libraries/Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id_inventario = $_POST['id_inventario'];
    $cantidad = $_POST['cantidad'];
    $ubicacion = $_POST['ubicacion'];

   
    $query = "UPDATE INVENTARIO 
              SET CANTIDAD = :cantidad, 
                  UBICACION = :ubicacion 
              WHERE ID_INVENTARIO = :id_inventario";

    $stmt = oci_parse($conn, $query);


    oci_bind_by_name($stmt, ':cantidad', $cantidad);
    oci_bind_by_name($stmt, ':ubicacion', $ubicacion);
    oci_bind_by_name($stmt, ':id_inventario', $id_inventario);

    
    if (oci_execute($stmt)) {
        echo "Inventario actualizado correctamente.";
    } else {
        $e = oci_error($stmt);
        echo "Error al actualizar el inventario: " . $e['message'];
    }

    oci_free_statement($stmt);
    oci_close($conn);
}
?>


<form action="update_inventario.php" method="POST">
    <label for="id_inventario">ID Inventario:</label>
    <input type="number" name="id_inventario" required><br>

    <label for="cantidad">Cantidad:</label>
    <input type="number" name="cantidad" required><br>

    <label for="ubicacion">Ubicación:</label>
    <input type="text" name="ubicacion" required><br>

    <input type="submit" value="Actualizar Inventario">
</form>