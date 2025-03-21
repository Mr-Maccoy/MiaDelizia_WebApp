<?php
// Conexión a la base de datos
$conn = include_once __DIR__ . '/../../libraries/Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id_pedido = $_POST['id_pedido'];

    
    $query = "DELETE FROM PEDIDOS WHERE ID_PEDIDO = :id_pedido";

    $stmt = oci_parse($conn, $query);

    
    oci_bind_by_name($stmt, ':id_pedido', $id_pedido);

    
    if (oci_execute($stmt)) {
        echo "Pedido eliminado correctamente.";
    } else {
        $e = oci_error($stmt);
        echo "Error al eliminar el pedido: " . $e['message'];
    }

    
    oci_free_statement($stmt);
    oci_close($conn);
}
?>

<form action="delete_pedido.php" method="POST">
    <label for="id_pedido">ID Pedido:</label>
    <input type="text" name="id_pedido" required><br>
    <input type="submit" value="Eliminar Pedido">
</form>