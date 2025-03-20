<?php
// Conexión a la base de datos
$conn = include_once __DIR__ . '/../../libraries/Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos enviados del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $disponibilidad = $_POST['disponibilidad'];
    $id_categoria = $_POST['id_categoria'];

    // Consulta para insertar el nuevo producto
    $query = "INSERT INTO PRODUCTOS (NOMBRE, DESCRIPCION, PRECIO, DISPONIBILIDAD, ID_CATEGORIA) 
              VALUES (:nombre, :descripcion, :precio, :disponibilidad, :id_categoria)";

    $stmt = oci_parse($conn, $query);

    // Vincular los valores
    oci_bind_by_name($stmt, ':nombre', $nombre);
    oci_bind_by_name($stmt, ':descripcion', $descripcion);
    oci_bind_by_name($stmt, ':precio', $precio);
    oci_bind_by_name($stmt, ':disponibilidad', $disponibilidad);
    oci_bind_by_name($stmt, ':id_categoria', $id_categoria);

    // Ejecutar la consulta
    if (oci_execute($stmt)) {
        echo "Producto insertado correctamente.";
    } else {
        $e = oci_error($stmt);
        echo "Error al insertar el producto: " . $e['message'];
    }

    // Liberar los recursos y cerrar la conexión
    oci_free_statement($stmt);
    oci_close($conn);
}
?>

<form action="insert.php" method="POST">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" required><br>
    <label for="descripcion">Descripción:</label>
    <input type="text" name="descripcion" required><br>
    <label for="precio">Precio:</label>
    <input type="text" name="precio" required><br>
    <label for="disponibilidad">Disponibilidad:</label>
    <select name="disponibilidad" required>
        <option value="S">Sí</option>
        <option value="N">No</option>
    </select><br>
    <label for="id_categoria">Categoría:</label>
    <input type="text" name="id_categoria" required><br>
    <input type="submit" value="Insertar Producto">
</form>