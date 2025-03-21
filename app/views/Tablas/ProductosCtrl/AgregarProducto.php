<?php
$conn = include_once __DIR__ . '/../../libraries/Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $disponibilidad = $_POST['disponibilidad'];
    $id_categoria = $_POST['id_categoria'];

   
    $query = "INSERT INTO PRODUCTOS (NOMBRE, DESCRIPCION, PRECIO, DISPONIBILIDAD, ID_CATEGORIA)
              VALUES (:nombre, :descripcion, :precio, :disponibilidad, :id_categoria)";
    $stmt = oci_parse($conn, $query);

    
    oci_bind_by_name($stmt, ':nombre', $nombre);
    oci_bind_by_name($stmt, ':descripcion', $descripcion);
    oci_bind_by_name($stmt, ':precio', $precio);
    oci_bind_by_name($stmt, ':disponibilidad', $disponibilidad);
    oci_bind_by_name($stmt, ':id_categoria', $id_categoria);

    
    if (oci_execute($stmt)) {
        echo "Producto agregado correctamente.";
    } else {
        $e = oci_error($stmt);
        echo "Error al agregar el producto: " . $e['message'];
    }

    
    oci_free_statement($stmt);
    oci_close($conn);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
</head>
<body>
    <div class="Insert">
        <h2>Agregar Producto</h2>
        <form action="insertProducto.php" method="post">

            <label for="nombre">Nombre del Producto:</label>
            <input type="text" name="nombre" id="nombre" required><br><br>

            <label for="descripcion">Descripción:</label>
            <input type="text" name="descripcion" id="descripcion" required><br><br>

            <label for="precio">Precio:</label>
            <input type="text" name="precio" id="precio" required><br><br>

            <label for="disponibilidad">Disponibilidad:</label>
            <select name="disponibilidad" id="disponibilidad" required>
                <option value="S">Sí</option>
                <option value="N">No</option>
            </select><br><br>

            <label for="id_categoria">Categoría:</label>
            <input type="number" name="id_categoria" id="id_categoria" required><br><br>

            <button type="submit">Agregar Producto</button>
        </form>
    </div>
</body>
</html>