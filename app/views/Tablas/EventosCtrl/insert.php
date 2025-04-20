<?php
$conn = include_once __DIR__ . '/../../libraries/Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_evento = $_POST['nombre_evento'];
    $fecha_evento = $_POST['fecha_evento']; 
    $ubicacion = $_POST['ubicacion'];
    $descripcion = $_POST['descripcion'];

    $query = "BEGIN pkg_eventos.insertar_evento(:nombre, TO_DATE(:fecha, 'YYYY-MM-DD'), :ubicacion, :descripcion); END;";
    $stmt = oci_parse($conn, $query);

    oci_bind_by_name($stmt, ':nombre', $nombre_evento);
    oci_bind_by_name($stmt, ':fecha', $fecha_evento);
    oci_bind_by_name($stmt, ':ubicacion', $ubicacion);
    oci_bind_by_name($stmt, ':descripcion', $descripcion);

    if (oci_execute($stmt)) {
        echo "<script>alert('Evento agregado correctamente'); 
        window.location.href = 'listar_eventos.php';</script>";
    } else {
        $e = oci_error($stmt);
        echo "Error al agregar el evento: " . $e['message'];
    }

    oci_free_statement($stmt);
    oci_close($conn);
}
?>

<form action="insert_evento.php" method="POST">
    <label for="nombre_evento">Nombre del Evento:</label>
    <input type="text" name="nombre_evento" required><br>

    <label for="fecha_evento">Fecha del Evento:</label>
    <input type="date" name="fecha_evento" required><br>

    <label for="ubicacion">Ubicación:</label>
    <input type="text" name="ubicacion" required><br>

    <label for="descripcion">Descripción:</label>
    <input type="text" name="descripcion" required><br>

    <input type="submit" value="Agregar Evento">
</form>
