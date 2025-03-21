<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Pago</title>
</head>
<body>
    <h1>Agregar Pago</h1>
    <form action="AgregarPago.php" method="post">
        <label for="pedido">Pedido:</label>
        <input type="text" id="pedido" name="pedido" required>
        <br>
        <label for="fecha_pago">Fecha Pago:</label>
        <input type="date" id="fecha_pago" name="fecha_pago" required>
        <br>
        <label for="monto">Monto:</label>
        <input type="number" id="monto" name="monto" required>
        <br>
        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" required>
        <br>
        <label for="metodo_pago">Método Pago:</label>
        <input type="text" id="metodo_pago" name="metodo_pago" required>
        <br>
        <label for="estado_pago">Estado Pago:</label>
        <input type="text" id="estado_pago" name="estado_pago" required>
        <br>
        <label for="pago_pedido">Pago Pedido:</label>
        <input type="text" id="pago_pedido" name="pago_pedido" required>
        <br>
        <button type="submit">Agregar</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $conn = include_once __DIR__ . '/../../libraries/Database.php';
        $pedido = $_POST['pedido'];
        $fecha_pago = $_POST['fecha_pago'];
        $monto = $_POST['monto'];
        $direccion = $_POST['direccion'];
        $metodo_pago = $_POST['metodo_pago'];
        $estado_pago = $_POST['estado_pago'];
        $pago_pedido = $_POST['pago_pedido'];

        $query = "INSERT INTO PAGOS (ID_PEDIDO, FECHA_PAGO, MONTO, DIRECCION, METODO_PAGO, ESTADO_PAGO, PAGO_PEDIDO) VALUES (:pedido, :fecha_pago, :monto, :direccion, :metodo_pago, :estado_pago, :pago_pedido)";
        $statement = oci_parse($conn, $query);
        oci_bind_by_name($statement, ':pedido', $pedido);
        oci_bind_by_name($statement, ':fecha_pago', $fecha_pago);
        oci_bind_by_name($statement, ':monto', $monto);
        oci_bind_by_name($statement, ':direccion', $direccion);
        oci_bind_by_name($statement, ':metodo_pago', $metodo_pago);
        oci_bind_by_name($statement, ':estado_pago', $estado_pago);
        oci_bind_by_name($statement, ':pago_pedido', $pago_pedido);

        if (!oci_execute($statement)) {
            $e = oci_error($statement);
            die("Error al agregar el pago: " . $e['message']);
        }

        echo "Pago agregado exitosamente.";
        oci_free_statement($statement);
        oci_close($conn);
    }
    ?>
</body>
</html>