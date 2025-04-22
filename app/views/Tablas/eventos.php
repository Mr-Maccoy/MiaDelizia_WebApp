<!DOCTYPE html>
<html lang="en">

<?php include("head.php"); ?>

<body>
<header>
    <?php include("menu.php"); ?>
</header>

<div class="jumbotron jumbotron-flud text-center">
    <div id="Eventos">
        <table border="1">
            <thead>
                <tr>
                    <th>Nombre del Evento</th>
                    <th>Fecha</th>
                    <th>Ubicación</th>
                    <th>Descripción</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conn = include_once __DIR__ . '/../../libraries/Database.php';

                $query = "BEGIN pkg_eventos.obtener_eventos(:cursor); END;";
                $statement = oci_parse($conn, $query);
                $cursor = oci_new_cursor($conn);
                oci_bind_by_name($statement, ':cursor', $cursor, -1, OCI_B_CURSOR);

                if (!oci_execute($statement)) {
                    $e = oci_error($statement);
                    die("Error al ejecutar el paquete: " . $e['message']);
                }

                oci_execute($cursor);

                $row_count = 0;
                while ($row = oci_fetch_array($cursor, OCI_ASSOC + OCI_RETURN_NULLS)) {
                    $row_count++;
                    echo "<tr>
                            <td>{$row['NOMBRE_EVENTO']}</td>
                            <td>{$row['FECHA_EVENTO']}</td>
                            <td>{$row['UBICACION']}</td>
                            <td>{$row['DESCRIPCION']}</td>
                            <td>
                                <form method=\"post\" action=\"/Tablas/EventosCtrl/EditarEvento.php\" onsubmit=\"return confirm('¿Estás seguro de editar este evento?');\">
                                    <input type=\"hidden\" name=\"id_evento\" value=\"{$row['ID_EVENTO']}\">
                                    <button type=\"submit\" class=\"btn-editar\">Editar</button>
                                </form>
                            </td>
                            <td>
                                <form method=\"post\" action=\"/Tablas/EventosCtrl/EliminarEvento.php\" onsubmit=\"return confirm('¿Estás seguro de eliminar este evento?');\">
                                    <input type=\"hidden\" name=\"id_evento\" value=\"{$row['ID_EVENTO']}\">
                                    <button type=\"submit\" class=\"btn-eliminar\">Eliminar</button>
                                </form>
                            </td>
                        </tr>";
                }

                if ($row_count === 0) {
                    echo "<tr><td colspan='6'>No hay eventos registrados</td></tr>";
                }

                oci_free_statement($statement);
                oci_free_statement($cursor);
                oci_close($conn);
                ?>
            </tbody>
        </table>

        <br>
        <a href="/Tablas/EventosCtrl/AgregarEvento.php">
            <button>Agregar Evento</button>
        </a>
    </div>
</div>

<footer>
    <?php include("footer.php"); ?>
</footer>

</body>
</html>
