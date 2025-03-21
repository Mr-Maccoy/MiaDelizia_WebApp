<?php
$conn = include_once __DIR__ . '/../../../libraries/Database.php';
$id_inventario = (int)$_POST['id_inventario']; 

$query = "SELECT * FROM INVENTARIO WHERE ID_INVENTARIO = :id_inventario"; 
$stmt = oci_parse($conn, $query);
oci_bind_by_name($stmt, ':id_inventario', $id_inventario); 
oci_execute($stmt);
$row = oci_fetch_assoc($stmt);
oci_free_statement($stmt);
oci_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Inventario</title>
</head>

<body>
    <div class="Edit">
        <h2>Editar Inventario</h2>
        <form action="update_inventario.php" method="post"> 
            <input type="hidden" name="id_inventario" value="<?= $id_inventario ?>">

            <label>Producto:</label>
            <input type="text" name="id_producto" value="<?= $row['ID_PRODUCTO'] ?>" required><br><br>

            <label>Cantidad Disponible:</label>
            <input type="number" name="cantidad_disponible" value="<?= $row['CANTIDAD_DISPONIBLE'] ?>" required><br><br>

            <label>Fecha de Actualización:</label>
            <input type="date" name="fecha_actualizacion" value="<?= date('Y-m-d', strtotime($row['FECHA_ACTUALIZACION'])) ?>" required><br><br>

            <button type="submit">Guardar Cambios</button>
        </form>
    </div>
</body>

</html>
