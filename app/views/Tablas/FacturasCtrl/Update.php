<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Factura</title>
</head>
<body>
    <h1>Editar Factura</h1>

    <?php
    $conn = include_once __DIR__ . '/../../libraries/Database.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT ID_PEDIDO, FECHA_FACTURA, TOTAL, ESTADO_FACTURA FROM FACTURA WHERE ID_FACTURA = :id";
        $statement = oci_parse($conn, $query);
        oci_bind_by_name($statement, ':id', $id);

        if (!oci_execute($statement)) {
            $e = oci_error($statement);
            die("Error al obtener la factura: " . $e['message']);
        }

        $factura = oci_fetch_assoc($statement);
        oci_free_statement($statement);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $pedido = $_POST['pedido'];
        $fecha_factura = $_POST['fecha_factura'];
        $total = $_POST['total'];
        $estado_factura = $_POST['estado_factura'];

        $query = "UPDATE FACTURA SET ID_PEDIDO = :pedido, FECHA_FACTURA = :fecha_factura, TOTAL = :total, ESTADO_FACTURA = :estado_factura WHERE ID_FACTURA = :id";
        $statement = oci_parse($conn, $query);
        oci_bind_by_name($statement, ':id', $id);
        oci_bind_by_name($statement, ':pedido', $pedido);
        oci_bind_by_name($statement, ':fecha_factura', $fecha_factura);
        oci_bind_by_name($statement, ':total', $total);
        oci_bind_by_name($statement, ':estado_factura', $estado_factura);

        if (!oci_execute($statement)) {
            $e = oci_error($statement);
            die("Error al actualizar la factura: " . $e['message']);
        }

        echo "Factura actualizada exitosamente.";
        oci_free_statement($statement);
        oci_close($conn);
    }
    ?>

    <form action="EditarFactura.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET['id']); ?>">
        <label for="pedido">Pedido:</label>
        <input type="text" id="pedido" name="pedido" value="<?php echo htmlspecialchars($factura['ID_PEDIDO']); ?>" required><br>
        <label for="fecha_factura">Fecha Factura:</label>
        <input type="date" id="fecha_factura" name="fecha_factura" value="<?php echo htmlspecialchars($factura['FECHA_FACTURA']); ?>" required><br>
        <label for="total">Total:</label>
        <input type="number" id="total" name="total" value="<?php echo htmlspecialchars($factura['TOTAL']); ?>" required><br>
        <label for="estado_factura">Estado Factura:</label>
        <input type="text" id="estado_factura" name="estado_factura" value="<?php echo htmlspecialchars($factura['ESTADO_FACTURA']); ?>" required><br>
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>