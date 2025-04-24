<?php
// AgregarFactura.php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pedido = $_POST['id_pedido'];
    $total = $_POST['total'];
    $estado = $_POST['estado'];

    $query = "BEGIN pkg_facturas.insertar_factura(:id_pedido, :total, :estado); END;";
    $stmt = oci_parse($conn, $query);
    oci_bind_by_name($stmt, ':id_pedido', $id_pedido);
    oci_bind_by_name($stmt, ':total', $total);
    oci_bind_by_name($stmt, ':estado', $estado);

    if (oci_execute($stmt)) {
        oci_commit($conn);
        header("Location: /../Tablas/facturas.php?success=1");
        exit;
    } else {
        $e = oci_error($stmt);
        echo "Error al insertar: " . $e['message'];
    }
    oci_free_statement($stmt);
    oci_close($conn);
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Factura</title>
</head>
<body>
    <h2>Agregar Factura</h2>
    <form method="post">
        <label>ID Pedido:</label>
        <input type="number" name="id_pedido" required><br><br>

        <label>Total:</label>
        <input type="number" name="total" step="0.01" required><br><br>

        <label>Estado:</label>
        <select name="estado" required>
            <option value="PENDIENTE">PENDIENTE</option>
            <option value="PAGADA">PAGADA</option>
            <option value="ANULADA">ANULADA</option>
        </select><br><br>

        <button type="submit">Guardar</button>
    </form>
</body>
</html>