<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Factura</title>
</head>
<body>
    <h1>Agregar Factura</h1>
    <form action="AgregarFactura.php" method="post">
        <label for="pedido">Pedido:</label>
        <input type="text" id="pedido" name="pedido" required>
        <br>
        <label for="fecha_factura">Fecha Factura:</label>
        <input type="date" id="fecha_factura" name="fecha_factura" required>
        <br>
        <label for="total">Total:</label>
        <input type="number" id="total" name="total" required>
        <br>
        <label for="estado_factura">Estado Factura:</label>
        <input type="text" id="estado_factura" name="estado_factura" required>
        <br>
        <button type="submit">Agregar</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $conn = include_once __DIR__ . '/../../libraries/Database.php';
        $pedido = $_POST['pedido'];
        $fecha_factura = $_POST['fecha_factura'];
        $total = $_POST['total'];
        $estado_factura = $_POST['estado_factura'];

        $query = "INSERT INTO FACTURA (ID_PEDIDO, FECHA_FACTURA, TOTAL, ESTADO_FACTURA) VALUES (:pedido, :fecha_factura, :total, :estado_factura)";
        $statement = oci_parse($conn, $query);
        oci_bind_by_name($statement, ':pedido', $pedido);
        oci_bind_by_name($statement, ':fecha_factura', $fecha_factura);
        oci_bind_by_name($statement, ':total', $total);
        oci_bind_by_name($statement, ':estado_factura', $estado_factura);

        if (!oci_execute($statement)) {
            $e = oci_error($statement);
            die("Error al agregar la factura: " . $e['message']);
        }

        echo "Factura agregada exitosamente.";
        oci_free_statement($statement);
        oci_close($conn);
    }
    ?>
</body>
</html>