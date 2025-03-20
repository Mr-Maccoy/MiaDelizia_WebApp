<?php

$conn = include_once __DIR__ . '/../../libraries/Database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id_evento = $_POST['id_evento'];
    $nombre_evento = $_POST['nombre_evento'];
    $descripcion = $_POST['descripcion'];
    $fecha_evento = $_POST['fecha_evento'];

    $query = "UPDATE EVENTO 
              SET NOMBRE_EVENTO = :nombre_evento, 
                  DESCRIPCION = :descripcion, 
                  FECHA_EVENTO = TO_DATE(:fecha_evento, 'YYYY-MM-DD') 
              WHERE ID_EVENTO = :id_evento";

    $stmt = oci_parse($conn, $query);

    oci_bind_by_name($stmt, ':nombre_evento', $nombre_evento);
    oci_bind_by_name($stmt, ':descripcion', $descripcion);
    oci_bind_by_name($stmt, ':fecha_evento', $fecha_evento);
    oci_bind_by_name($stmt, ':id_evento', $id_evento);

   
    if (oci_execute($stmt)) {
        echo "Evento actualizado correctamente.";
    } else {
        $e = oci_error($stmt);
        echo "Error al actualizar el evento: " . $e['message'];
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

    <label for="descripcion">Descripción:</label>
    <input type="text" name="descripcion" required><br>

    <label for="fecha_evento">Fecha del Evento:</label>
    <input type="date" name="fecha_evento" required><br>

    <input type="submit" value="Actualizar Evento">
</form>
