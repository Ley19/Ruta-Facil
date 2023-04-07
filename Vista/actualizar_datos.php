<?php
    // Obtener los valores enviados desde la solicitud AJAX
    $longitud = $_POST["longitud"];
    $latitud = $_POST["latitud"];

    // Conectar a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ia_bbdd";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
    }

    session_start();
    if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
    } else {
    echo "Debes iniciar sesión primero.";
    }

    // Actualizar los valores en la base de datos
    $sql = "UPDATE usuarios SET longitud = '$longitud', latitud = '$latitud' WHERE usuario = '$username'";
    if ($conn->query($sql) === TRUE) {
    echo "Datos actualizados correctamente";
    } else {
    echo "Error al actualizar los datos: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
?>
