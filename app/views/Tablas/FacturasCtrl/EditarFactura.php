<?php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';
$id_cliente = (int)$_POST['id_cliente'];

$query = "BEGIN pkg_clientes.obtener_cliente_por_id(:id_cliente, :cursor); END;";
$stmt = oci_parse($conn, $query);
$cursor = oci_new_cursor($conn);
oci_bind_by_name($stmt, ':id_cliente', $id_cliente);
oci_bind_by_name($stmt, ':cursor', $cursor, -1, OCI_B_CURSOR);
oci_execute($stmt);
oci_execute($cursor);
$row = oci_fetch_assoc($cursor);
oci_free_statement($stmt);
oci_free_statement($cursor);
oci_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="Edit">
        <h2>Agregar Cliente</h2>
        <form action="update.php" method="post">
            <input type="hidden" name="id_cliente" value="<?= $id_cliente ?>">

            <label>Nombre:</label>
            <input type="text" name="nombre" value="<?= $row['NOMBRE'] ?>" required><br><br>

            <label>Teléfono:</label>
            <input type="text" name="telefono" value="<?= $row['TELEFONO'] ?>" required><br><br>

            <label>Correo:</label>
            <input type="email" name="correo" value="<?= $row['CORREO_ELECTRONICO'] ?>" required><br><br>

            <label>Dirección:</label>
            <input type="text" name="direccion" value="<?= $row['DIRECCION'] ?>" required><br><br>

            <label>Tipo:</label>
            <select name="tipo" id="tipo" required>
                <option value="nuevo" <?= $row['TIPO_CLIENTE'] == 'nuevo' ? 'selected' : '' ?>>Nuevo</option>
                <option value="recurrente" <?= $row['TIPO_CLIENTE'] == 'recurrente' ? 'selected' : '' ?>>Recurrente</option>
                <option value="VIP" <?= $row['TIPO_CLIENTE'] == 'VIP' ? 'selected' : '' ?>>VIP</option>
            </select><br><br>

            <label>Nacimiento:</label>
            <input type="date" name="nacimiento" value="<?= date('Y-m-d', strtotime($row['FECHA_NACIMIENTO'])) ?>" required><br><br>

            <button type="submit">Guardar Cambios</button>
        </form>






    </div>
</body>

</html>

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

<button type="submit">Actualizar</button></form></body></html>