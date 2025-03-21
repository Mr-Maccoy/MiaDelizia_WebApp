<?php
// Conexión a la base de datos
$conn = include_once __DIR__ . '/../../libraries/Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id_pedido = $_POST['id_pedido'];
    $id_cliente = $_POST['id_cliente'];
    $fecha_pedido = $_POST['fecha_pedido'];
    $total = $_POST['total'];
    $estado = $_POST['estado'];

    
    $query = "UPDATE PEDIDOS 
              SET ID_CLIENTE = :id_cliente, FECHA_PEDIDO = :fecha_pedido, TOTAL = :total, ESTADO = :estado 
              WHERE ID_PEDIDO = :id_pedido";

    $stmt = oci_parse($conn, $query);

    
    oci_bind_by_name($stmt, ':id_pedido', $id_pedido);
    oci_bind_by_name($stmt, ':id_cliente', $id_cliente);
    oci_bind_by_name($stmt, ':fecha_pedido', $fecha_pedido);
    oci_bind_by_name($stmt, ':total', $total);
    oci_bind_by_name($stmt, ':estado', $estado);

    
    if (oci_execute($stmt)) {
        echo "Pedido actualizado correctamente.";
    } else {
        $e = oci_error($stmt);
        echo "Error al actualizar el pedido: " . $e['message'];
    }

    
    oci_free_statement($stmt);
    oci_close($conn);
}
?>

<form action="update_pedido.php" method="POST">
    <label for="id_pedido">ID Pedido:</label>
    <input type="text" name="id_pedido" required><br>
    <label for="id_cliente">ID Cliente:</label>
    <input type="text" name="id_cliente" required><br>
    <label for="fecha_pedido">Fecha del Pedido:</label>
    <input type="date" name="fecha_pedido" required><br>
    <label for="total">Total:</label>
    <input type="text" name="total" required><br>
    <label for="estado">Estado:</label>
    <select name="estado" required>
        <option value="Pendiente">Pendiente</option>
        <option value="Enviado">Enviado</option>
        <option value="Entregado">Entregado</option>
    </select><br>
    <input type="submit" value="Actualizar Pedido">
</form>