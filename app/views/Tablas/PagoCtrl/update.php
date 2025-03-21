<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pago</title>
</head>
<body>
    <h1>Editar Pago</h1>

    <?php
    $conn = include_once __DIR__ . '/../../libraries/Database.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT ID_PEDIDO, FECHA_PAGO, MONTO, DIRECCION, METODO_PAGO, ESTADO_PAGO, PAGO_PEDIDO FROM PAGOS WHERE ID_PAGO = :id";
        $statement = oci_parse($conn, $query);
        oci_bind_by_name($statement, ':id', $id);

        if (!oci_execute($statement)) {
            $e = oci_error($statement);
            die("Error al obtener el pago: " . $e['message']);
        }

        $pago = oci_fetch_assoc($statement);
        oci_free_statement($statement);
   SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $pedido = $_POST['pedido'];
        $fecha_pago = $_POST['fecha_pago'];
        $monto = $_POST['monto'];
        $direccion = $_POST['direccion'];
        $metodo_pago = $_POST['metodo_pago'];
        $estado_pago = $_POST['estado_pago'];
        $pago_pedido = $_POST['pago_pedido'];

        $query = "UPDATE PAGOS SET ID_PEDIDO = :pedido, FECHA_PAGO = :fecha_pago, MONTO = :monto, DIRECCION = :direccion, METODO_PAGO = :metodo_pago, ESTADO_PAGO = :estado_pago, PAGO_PEDIDO = :pago_pedido WHERE ID_PAGO = :id";
        $statement = oci_parse($conn, $query);
        oci_bind_by_name($statement, ':id', $id);
        oci_bind_by_name($statement, ':pedido', $pedido);
        oci_bind_by_name($statement, ':fecha_pago', $fecha_pago);
        oci_bind_by_name($statement, ':monto', $monto);
        oci_bind_by_name($statement, ':direccion', $direccion);
        oci_bind_by_name($statement, ':metodo_pago', $metodo_pago);
        oci_bind_by_name($statement, ':estado_pago', $estado_pago);
        oci_bind_by_name($statement, ':pago_pedido', $pago_pedido);

        if (!oci_execute($statement)) {
            $e = oci_error($statement);
            die("Error al actualizar el pago: " . $e['message']);
        }

        echo "Pago actualizado exitosamente.";
        oci_free_statement($statement);
        oci_close($conn);
    }
    ?>

    <form action="EditarPago.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET['id']); ?>">
        <label for="pedido">Pedido:</label>
        <input type="text" id="pedido" name="pedido" value="<?php echo htmlspecialchars($pago['ID_PEDIDO']); ?>" required><br>
        <label for="fecha_pago">Fecha Pago:</label>
        <input type="date" id="fecha_pago" name="fecha_pago" value="<?php echo htmlspecialchars($pago['FECHA_PAGO']); ?>" required><br>
        <label for="monto">Monto:</label>
        <input type="number" id="monto" name="monto" value="<?php echo htmlspecialchars($pago['MONTO']); ?>" required><br>
        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" value="<?php echo htmlspecialchars($pago['DIRECCION']); ?>" required><br>
        <label for="metodo_pago">Método Pago:</label>
        <input type="text" id="metodo_pago" name="metodo_pago" value="<?php echo htmlspecialchars($pago['METODO_PAGO']); ?>" required><br>
        <label for="estado_pago">Estado Pago:</label>
        <input type="text" id="estado_pago" name="estado_pago" value="<?php echo htmlspecialchars($pago['ESTADO_PAGO']); ?>" required><br>
        <label for="pago_pedido">Pago Pedido:</label>
        <input type="text" id="pago_pedido" name="pago_pedido" value="<?php echo htmlspecialchars($pago['PAGO_PEDIDO']); ?>" required><br>
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>