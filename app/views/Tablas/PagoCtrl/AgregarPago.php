<?php
// insert.php para pagos
$conn = include_once __DIR__ . '/../../../libraries/Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pedido = $_POST['id_pedido'];
    $monto = $_POST['monto'];
    $metodo = $_POST['metodo'];
    $estado = $_POST['estado'];

    $query = "BEGIN pkg_pagos.insertar_pago(:id_pedido, :monto, :metodo, :estado); END;";
    $stmt = oci_parse($conn, $query);
    oci_bind_by_name($stmt, ':id_pedido', $id_pedido);
    oci_bind_by_name($stmt, ':monto', $monto);
    oci_bind_by_name($stmt, ':metodo', $metodo);
    oci_bind_by_name($stmt, ':estado', $estado);

    if (oci_execute($stmt)) {
        oci_commit($conn);
        header("Location: /../Tablas/pagos.php?success=1");
        exit;
    } else {
        $e = oci_error($stmt);
        echo "Error al insertar: " . $e['message'];
    }
    oci_free_statement($stmt);
    oci_close($conn);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Pago</title>
</head>
<body>
    <h2>Agregar Pago</h2>
    <form method="post">
        <label>ID Pedido:</label>
        <input type="number" name="id_pedido" required><br><br>

        <label>Monto:</label>
        <input type="number" step="0.01" name="monto" required><br><br>

        <label>Método de Pago:</label>
        <select name="metodo" required>
            <option value="TARJETA">TARJETA</option>
            <option value="EFECTIVO">EFECTIVO</option>
            <option value="TRANSFERENCIA">TRANSFERENCIA</option>
        </select><br><br>

        <label>Estado del Pago:</label>
        <select name="estado" required>
            <option value="PENDIENTE">PENDIENTE</option>
            <option value="CONFIRMADO">CONFIRMADO</option>
            <option value="CANCELADO">CANCELADO</option>
        </select><br><br>

        <button type="submit">Registrar Pago</button>
    </form>
</body>
</html>
