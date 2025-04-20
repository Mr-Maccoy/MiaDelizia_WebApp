<!DOCTYPE html>
<html lang="en">

<?php
include("inc/head.php")
?>

<body>
    <header>
        <?php include("menu.php") ?>
    </header>
    
    <div class="jumbotron jumbotron-flud text-center">
    <div class="container">
    <h1 class="display-3">Bienvenidos a Mia Delizia</h1>
    

    <?php
$conn = include_once __DIR__ . '/../libraries/Database.php';

$vistas = [
    'v_facturas_pagadas'         => 'Facturas Pagadas',
    'v_pagos_por_metodo'         => 'Pagos por Método',
    'pedidos_estado_total'       => 'Pedidos por Estado',
    'ventas_diarias'             => 'Ventas Diarias',
    'usuarios_roles'             => 'Usuarios y Roles',
    'pedidos_recientes'          => 'Pedidos Recientes',
    'productos_categorias'       => 'Productos por Categoría',
    'productos_agotados'         => 'Productos Agotados',
    'v_historial_estado_pedidos' => 'Historial de Estado de Pedidos',
    'v_eventos_proximos'         => 'Eventos Próximos'
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resumen de Vistas</title>
    <style>
        .card {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 15px;
            margin: 15px;
            box-shadow: 2px 2px 5px rgba(0,0,0,0.1);
            overflow-x: auto;
        }
        .card h2 {
            margin-top: 0;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #999;
            padding: 5px;
            text-align: left;
        }
        body {
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body>

<?php
foreach ($vistas as $vista => $titulo) {
    echo "<div class='card'>";
    echo "<h2>$titulo</h2>";

    $query = "SELECT * FROM $vista";
    $stmt = oci_parse($conn, $query);

    if (oci_execute($stmt)) {
        echo "<table>";
        $ncols = oci_num_fields($stmt);

        // Header
        echo "<tr>";
        for ($i = 1; $i <= $ncols; $i++) {
            echo "<th>" . oci_field_name($stmt, $i) . "</th>";
        }
        echo "</tr>";

        // Rows
        while ($row = oci_fetch_array($stmt, OCI_ASSOC + OCI_RETURN_NULLS)) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>" . ($value !== null ? htmlspecialchars($value) : '&nbsp;') . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Error al consultar la vista <strong>$vista</strong>.</p>";
    }

    oci_free_statement($stmt);
    echo "</div>";
}

oci_close($conn);
?>






    </div>
</div>

<footer>
<?php include("inc/footer.php") ?>
</footer>
    
</body>

</html>