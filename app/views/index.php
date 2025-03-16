


<!DOCTYPE html>
<html lang="en">

    <?php
    include("inc/head.php")
    ?>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Mi Sitio</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="AgregarCliente.php">Agregar Clientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contacto</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <div id="Employees">
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Telefono</th>
                <th>Salario</th>
            </tr>
        </thead>
        <tbody>
            <?php

                $conn = include_once __DIR__ . '/../libraries/Database.php';

                $query = "SELECT FIRST_NAME, LAST_NAME, PHONE_NUMBER, SALARY FROM HR.EMPLOYEES"; //Esto se cambia a la sentncia sql que se quiera 
                $statement = oci_parse($conn, $query);

                if (!oci_execute($statement)) { 
                    $e = oci_error($statement);
                    die("Error al ejecutar la consulta: " . $e['message']);
                }

                $row_count = 0; 
                while ($row = oci_fetch_array($statement, OCI_ASSOC+OCI_RETURN_NULLS)) {
                $row_count++;
                echo "<tr>
                        <td>{$row['FIRST_NAME']}</td>
                        <td>{$row['LAST_NAME']}</td>
                        <td>{$row['PHONE_NUMBER']}</td>
                         <td>{$row['SALARY']}</td>
                      </tr>";
            }

            if ($row_count === 0) {
                echo "<tr><td colspan='3'>No hay usuarios registrados</td></tr>";
            }

            oci_free_statement($statement); 
            oci_close($conn); 

            ?>
        </tbody>



    </table>


    </div>
    
</body>
</html>