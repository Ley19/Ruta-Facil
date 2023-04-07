<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ia_bbdd";

    $conexion = new mysqli($servername, $username, $password, $dbname);

    // Manejar la solicitud AJAX del formulario de agregar
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $latitud = $_POST['latitud'];
    $longitud = $_POST['longitud'];

    $stmt = $conexion->prepare("INSERT INTO destinos (nombre, latitud, longitud) VALUES (?, ?, ?)");
    $stmt->bind_param("sdd", $nombre, $latitud, $longitud);
    $stmt->execute();
    $stmt->close();
    }

    // Mostrar la tabla de destinos
    $resultado = $conexion->query("SELECT * FROM destinos");
    while ($fila = $resultado->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $fila['nombre'] . "</td>";
    echo "<td>" . $fila['latitud'] . "</td>";
    echo "<td>" . $fila['longitud'] . "</td>";
    echo "<td><button class='btn btn-eliminar' data-id='" . $fila['id'] . "'> <img src='../assets/img/boton-x.png' alt='Eliminar'></button></td>";
    echo "</tr>";
    }
    $resultado->close();
    $conexion->close();

?>
