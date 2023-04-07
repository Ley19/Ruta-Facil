<?php
// Conectar a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ia_bbdd";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    // Hacer la consulta a la base de datos
    $sql = "SELECT nombre, longitud, latitud, id FROM destinos";
    $result = $conn->query($sql);

    // Imprimir los resultados en la tabla
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
            <td style='width: 40px;'>" . $row["nombre"] . "</td>
            <td style='width: 40px;'>" . $row["longitud"] . "</td>
            <td style='width: 40px;'>" . $row["latitud"] . "</td>
            <td>
                <button class='btn btn-date add-point-button' 
                    data-longitud='" . $row["longitud"] . "' 
                    data-latitud='" . $row["latitud"] . "'>
                    <img style='width: 20px; vertical-align: middle;' src='../assets/img/mas.png' alt='Añadir'>
                </button>
            </td>
          </tr>";
    
        }
    } else {
        echo "<tr><td colspan='4'>No se encontraron destinos guardados.</td></tr>";
    }
    // Cerrar la conexión a la base de datos
    $conn->close();
?>
