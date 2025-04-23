<?php
$conn = include_once __DIR__ . '/../../libraries/Database.php';

$query = "BEGIN pkg_roles.obtener_roles(:cursor); END;";
$statement = oci_parse($conn, $query);
$cursor = oci_new_cursor($conn);
oci_bind_by_name($statement, ':cursor', $cursor, -1, OCI_B_CURSOR);

oci_execute($statement);
oci_execute($cursor);
?>

<!DOCTYPE html>
<html lang="en">
<?php
include("head.php")
?>
<body>
<header>
        <?php include("menu.php") ?>
    </header>


    <div class="jumbotron jumbotron-flud text-center">
    <div class="container">
    <h1 class="display-3">Roles</h1>
    
    <table border="1">
        <thead>
            <tr>
                <th>ID Rol</th>
                <th>Nombre del Rol</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = oci_fetch_array($cursor, OCI_ASSOC + OCI_RETURN_NULLS)) {
                echo "<tr>
                    <td>{$row['ID_ROL']}</td>
                    <td>{$row['NOMBRE_ROL']}</td>
                    <td>
                        <form method='post' action='/Tablas/RolesCtrl/EditarRol.php'>
                            <input type='hidden' name='id_rol' value='{$row['ID_ROL']}'>
                            <button type='submit'>Editar</button>
                        </form>
                    </td>
                    <td>
                        <form method='post' action='/Tablas/RolesCtrl/delete.php' onsubmit=\"return confirm('¿Estás seguro de eliminar este rol?');\">
                            <input type='hidden' name='id_rol' value='{$row['ID_ROL']}'>
                            <button type='submit'>Eliminar</button>
                        </form>
                    </td>
                </tr>";
            }
            oci_free_statement($statement);
            oci_free_statement($cursor);
            oci_close($conn);
            ?>
        </tbody>
    </table>

    <br>
    <a href="/Tablas/RolesCtrl/AgregarRol.php">
        <button>Agregar Rol</button>
    </a>
    </div>
    </div>

    <footer>
<?php include("footer.php") ?>
</footer>
</body>
</html>