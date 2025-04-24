<?php
$conn = include_once __DIR__ . '/../libraries/Database.php';
$resultado = null;
$nombre_funcion = null;

// Cargar datos para selects
$clientes = [];
$productos = [];
$pedidos = [];

$cstmt = oci_parse($conn, "SELECT id_cliente, nombre FROM clientes");
oci_execute($cstmt);
while ($row = oci_fetch_assoc($cstmt)) {
    $clientes[$row['ID_CLIENTE']] = $row['NOMBRE'];
}
oci_free_statement($cstmt);

$pstmt = oci_parse($conn, "SELECT id_producto, nombre FROM productos");
oci_execute($pstmt);
while ($row = oci_fetch_assoc($pstmt)) {
    $productos[$row['ID_PRODUCTO']] = $row['NOMBRE'];
}
oci_free_statement($pstmt);

$pedido_stmt = oci_parse($conn, "SELECT id_pedido FROM pedidos");
oci_execute($pedido_stmt);
while ($row = oci_fetch_assoc($pedido_stmt)) {
    $pedidos[] = $row['ID_PEDIDO'];
}
oci_free_statement($pedido_stmt);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['funcion'])) {
    $nombre_funcion = $_POST['funcion'];

    $query = "SELECT $nombre_funcion(";
    $params = [];
    $bindings = [];

    switch ($nombre_funcion) {
        case 'fn_calcular_edad':
            $query .= "TO_DATE(:fecha, 'YYYY-MM-DD')) AS resultado FROM dual";
            $params = ['fecha'];
            break;

        case 'fn_total_compras_cliente':
        case 'fn_obtener_descuento':
        case 'fn_cantidad_compras_cliente':
        case 'fn_promedio_gasto_cliente':
        case 'fn_ultima_compra_cliente':
        case 'fn_correo_cliente':
        case 'fn_nombre_completo_cliente':
            $query .= ":id_cliente) AS resultado FROM dual";
            $params = ['id_cliente'];
            break;

        case 'fn_verificar_disponibilidad':
            $query .= ":id_producto, :cantidad_solicitada) AS resultado FROM dual";
            $params = ['id_producto', 'cantidad_solicitada'];
            break;

        case 'fn_categoria_producto':
        case 'fn_nombre_producto':
            $query .= ":id_producto) AS resultado FROM dual";
            $params = ['id_producto'];
            break;

        case 'fn_calcular_iva':
            $query .= ":monto) AS resultado FROM dual";
            $params = ['monto'];
            break;

        case 'fn_validar_telefono':
            $query .= ":telefono) AS resultado FROM dual";
            $params = ['telefono'];
            break;

        case 'fn_estado_pedido':
            $query .= ":id_pedido) AS resultado FROM dual";
            $params = ['id_pedido'];
            break;

        case 'fn_cantidad_productos_en_stock':
            $query = "SELECT fn_cantidad_productos_en_stock AS resultado FROM dual";
            break;

        default:
            $resultado = 'Función no soportada';
            return;
    }

    $stmt = oci_parse($conn, $query);
    foreach ($params as $p) {
        oci_bind_by_name($stmt, ":$p", $_POST[$p]);
    }
    oci_execute($stmt);
    $row = oci_fetch_assoc($stmt);
    $resultado = $row['RESULTADO'];
}
?>

<!DOCTYPE html>
<html>
<?php
include("inc/head.php")
?>
<body class="bg-light">

<header>
        <?php include("menu.php") ?>
    </header>
<div class="container py-5">
    <h1 class="mb-4 text-center">Funciones</h1>

    <?php
    $funciones = [
        'fn_calcular_edad' => ['fecha' => 'date'],
        'fn_total_compras_cliente' => ['id_cliente' => 'select_cliente'],
        'fn_obtener_descuento' => ['id_cliente' => 'select_cliente'],
        'fn_verificar_disponibilidad' => ['id_producto' => 'select_producto', 'cantidad_solicitada' => 'number'],
        'fn_calcular_iva' => ['monto' => 'number'],
        'fn_nombre_completo_cliente' => ['id_cliente' => 'select_cliente'],
        'fn_categoria_producto' => ['id_producto' => 'select_producto'],
        'fn_estado_pedido' => ['id_pedido' => 'select_pedido'],
        'fn_cantidad_productos_en_stock' => [],
        'fn_ultima_compra_cliente' => ['id_cliente' => 'select_cliente'],
        'fn_cantidad_compras_cliente' => ['id_cliente' => 'select_cliente'],
        'fn_promedio_gasto_cliente' => ['id_cliente' => 'select_cliente'],
        'fn_nombre_producto' => ['id_producto' => 'select_producto'],
        'fn_correo_cliente' => ['id_cliente' => 'select_cliente'],
        'fn_validar_telefono' => ['telefono' => 'text']
    ];

    foreach ($funciones as $nombre => $inputs): ?>
        <div class="card mb-3">
            <div class="card-body">
                <form method="post">
                    <h5 class="card-title"><?= $nombre ?></h5>
                    <input type="hidden" name="funcion" value="<?= $nombre ?>">
                    <?php foreach ($inputs as $nombre_input => $tipo): ?>
                        <div class="form-group">
                            <label><?= ucfirst(str_replace('_', ' ', $nombre_input)) ?>:</label>
                            <?php if ($tipo === 'select_cliente'): ?>
                                <select name="<?= $nombre_input ?>" class="form-control" required>
                                    <?php foreach ($clientes as $id => $nombre_c): ?>
                                        <option value="<?= $id ?>" <?= (isset($_POST[$nombre_input]) && $_POST[$nombre_input] == $id && $nombre_funcion === $nombre) ? 'selected' : '' ?>><?= $id ?> - <?= htmlspecialchars($nombre_c) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            <?php elseif ($tipo === 'select_producto'): ?>
                                <select name="<?= $nombre_input ?>" class="form-control" required>
                                    <?php foreach ($productos as $id => $nombre_p): ?>
                                        <option value="<?= $id ?>" <?= (isset($_POST[$nombre_input]) && $_POST[$nombre_input] == $id && $nombre_funcion === $nombre) ? 'selected' : '' ?>><?= $id ?> - <?= htmlspecialchars($nombre_p) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            <?php elseif ($tipo === 'select_pedido'): ?>
                                <select name="<?= $nombre_input ?>" class="form-control" required>
                                    <?php foreach ($pedidos as $id): ?>
                                        <option value="<?= $id ?>" <?= (isset($_POST[$nombre_input]) && $_POST[$nombre_input] == $id && $nombre_funcion === $nombre) ? 'selected' : '' ?>><?= $id ?></option>
                                    <?php endforeach; ?>
                                </select>
                            <?php else: ?>
                                <input type="<?= $tipo ?>" class="form-control" name="<?= $nombre_input ?>" value="<?= ($nombre_funcion === $nombre && isset($_POST[$nombre_input])) ? htmlspecialchars($_POST[$nombre_input]) : '' ?>" required>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                    <button type="submit" class="btn btn-primary">Ejecutar</button>
                </form>
                <?php if ($resultado !== null && $nombre_funcion === $nombre): ?>
                    <div class="alert alert-success mt-3">
                        <strong>Resultado:</strong> <?= htmlspecialchars($resultado) ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<footer>
<?php include("inc/footer.php") ?>
</footer>
</body>
</html>
