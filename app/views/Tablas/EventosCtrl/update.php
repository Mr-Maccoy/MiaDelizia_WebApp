<?php

$conn = include_once __DIR__ . '/../../libraries/Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_evento = $_POST['id_evento'];
    $nombre_evento = $_POST['nombre_evento'];
    $descripcion = $_POST['descripcion'];
    $fecha_evento = $_POST['fecha_evento'];

    $query = "BEGIN 
                pkg_eventos.actualizar_evento(
                    :id_evento,
                    :nombre_evento,
                    TO_DATE(:fecha_evento, 'YYYY-MM-DD'),
                    :ubicacion,
                    :descripcion
                );
              END;";

    $stmt = oci_parse($conn, $query);

    $ubicacion = isset($_POST['ubicacion']) ? $_POST['ubicacion'] : '';

    oci_bind_by_name($stmt, ':id_evento', $id_evento);
    oci_bind_by_name($stmt, ':nombre_evento', $nombre_evento);
    oci_bind_by_name($stmt, ':fecha_evento', $fecha_evento);
    oci_bind_by_name($stmt, ':ubicacion', $ubicacion);
    oci_bind_by_name($stmt, ':descripcion', $descripcion);

    if (oci_execute($stmt)) {
        echo "<script>alert('Evento actualizado correctamente'); window.location.href = 'listar_eventos.php';</script>";
    } else {
        $e = oci_error($stmt);
        echo "Error al actualizar: " . $e['message'];
    }

    oci_free_statement($stmt);
    oci_close($conn);
}
?>

<form action="update_evento.php" method="POST">
    <label for="id_evento">ID del Evento:</label>
    <input type="number" name="id_evento" required><br>

    <label for="nombre_evento">Nombre del Evento:</label>
    <input type="text" name="nombre_evento" required><br>

    <label for="fecha_evento">Fecha del Evento:</label>
    <input type="date" name="fecha_evento" required><br>

    <label for="ubicacion">Ubicación:</label>
    <input type="text" name="ubicacion"><br>

    <label for="descripcion">Descripción:</label>
    <input type="text" name="descripcion" required><br>

    <input type="submit" value="Actualizar Evento">
</form>
