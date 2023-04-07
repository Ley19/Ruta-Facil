<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ia_bbdd";

    $conexion = new mysqli($servername, $username, $password, $dbname);

    // Obtener el ID del registro a eliminar
    $id = $_POST['id'];

    // Eliminar el registro de la base de datos
    $stmt = $conexion->prepare("DELETE FROM destinos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    // Mostrar la tabla de destinos actualizada
    $resultado = $conexion->query("SELECT * FROM destinos");
    while ($fila = $resultado->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $fila['nombre'] . "</td>";
    echo "<td>" . $fila['latitud'] . "</td>";
    echo "<td>" . $fila['longitud'] . "</td>";
    echo "<td><button class='btn  btn-eliminar' data-id='" . $fila['id'] . "'> <img src='../assets/img/boton-x.png' alt='Eliminar'></button></td>";
    echo "</tr>";
    }
    $resultado->close();
    $conexion->close();

?>