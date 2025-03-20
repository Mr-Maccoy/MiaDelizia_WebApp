<?php
$conn = include_once __DIR__ . '/../../libraries/Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $id_inventario = $_POST['id_inventario'];

   
    $query = "DELETE FROM INVENTARIO WHERE ID_INVENTARIO = :id_inventario";

    $stmt = oci_parse($conn, $query);

   
    oci_bind_by_name($stmt, ':id_inventario', $id_inventario);

    
    if (oci_execute($stmt)) {
        echo "Inventario eliminado correctamente.";
    } else {
        $e = oci_error($stmt);
        echo "Error al eliminar el inventario: " . $e['message'];
    }

    
    oci_free_statement($stmt);
    oci_close($conn);
}
?>

<form action="delete_inventario.php" method="POST">
    <label for="id_inventario">ID Inventario:</label>
    <input type="number" name="id_inventario" required><br>
    <input type="submit" value="Eliminar Inventario">
</form>
